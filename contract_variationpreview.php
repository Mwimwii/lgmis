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
$contract_variation_preview = new contract_variation_preview();

// Run the page
$contract_variation_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$contract_variation_preview->Page_Render();
?>
<?php $contract_variation_preview->showPageHeader(); ?>
<?php if ($contract_variation_preview->TotalRecords > 0) { ?>
<div class="card ew-grid contract_variation"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$contract_variation_preview->renderListOptions();

// Render list options (header, left)
$contract_variation_preview->ListOptions->render("header", "left");
?>
<?php if ($contract_variation_preview->LACode->Visible) { // LACode ?>
	<?php if ($contract_variation->SortUrl($contract_variation_preview->LACode) == "") { ?>
		<th class="<?php echo $contract_variation_preview->LACode->headerCellClass() ?>"><?php echo $contract_variation_preview->LACode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $contract_variation_preview->LACode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($contract_variation_preview->LACode->Name) ?>" data-sort-order="<?php echo $contract_variation_preview->SortField == $contract_variation_preview->LACode->Name && $contract_variation_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contract_variation_preview->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($contract_variation_preview->SortField == $contract_variation_preview->LACode->Name) { ?><?php if ($contract_variation_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contract_variation_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contract_variation_preview->DepartmentCode->Visible) { // DepartmentCode ?>
	<?php if ($contract_variation->SortUrl($contract_variation_preview->DepartmentCode) == "") { ?>
		<th class="<?php echo $contract_variation_preview->DepartmentCode->headerCellClass() ?>"><?php echo $contract_variation_preview->DepartmentCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $contract_variation_preview->DepartmentCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($contract_variation_preview->DepartmentCode->Name) ?>" data-sort-order="<?php echo $contract_variation_preview->SortField == $contract_variation_preview->DepartmentCode->Name && $contract_variation_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contract_variation_preview->DepartmentCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($contract_variation_preview->SortField == $contract_variation_preview->DepartmentCode->Name) { ?><?php if ($contract_variation_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contract_variation_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contract_variation_preview->SectionCode->Visible) { // SectionCode ?>
	<?php if ($contract_variation->SortUrl($contract_variation_preview->SectionCode) == "") { ?>
		<th class="<?php echo $contract_variation_preview->SectionCode->headerCellClass() ?>"><?php echo $contract_variation_preview->SectionCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $contract_variation_preview->SectionCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($contract_variation_preview->SectionCode->Name) ?>" data-sort-order="<?php echo $contract_variation_preview->SortField == $contract_variation_preview->SectionCode->Name && $contract_variation_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contract_variation_preview->SectionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($contract_variation_preview->SortField == $contract_variation_preview->SectionCode->Name) { ?><?php if ($contract_variation_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contract_variation_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contract_variation_preview->ContractNo->Visible) { // ContractNo ?>
	<?php if ($contract_variation->SortUrl($contract_variation_preview->ContractNo) == "") { ?>
		<th class="<?php echo $contract_variation_preview->ContractNo->headerCellClass() ?>"><?php echo $contract_variation_preview->ContractNo->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $contract_variation_preview->ContractNo->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($contract_variation_preview->ContractNo->Name) ?>" data-sort-order="<?php echo $contract_variation_preview->SortField == $contract_variation_preview->ContractNo->Name && $contract_variation_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contract_variation_preview->ContractNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($contract_variation_preview->SortField == $contract_variation_preview->ContractNo->Name) { ?><?php if ($contract_variation_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contract_variation_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contract_variation_preview->VariationAmount->Visible) { // VariationAmount ?>
	<?php if ($contract_variation->SortUrl($contract_variation_preview->VariationAmount) == "") { ?>
		<th class="<?php echo $contract_variation_preview->VariationAmount->headerCellClass() ?>"><?php echo $contract_variation_preview->VariationAmount->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $contract_variation_preview->VariationAmount->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($contract_variation_preview->VariationAmount->Name) ?>" data-sort-order="<?php echo $contract_variation_preview->SortField == $contract_variation_preview->VariationAmount->Name && $contract_variation_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contract_variation_preview->VariationAmount->caption() ?></span><span class="ew-table-header-sort"><?php if ($contract_variation_preview->SortField == $contract_variation_preview->VariationAmount->Name) { ?><?php if ($contract_variation_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contract_variation_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contract_variation_preview->VariationNo->Visible) { // VariationNo ?>
	<?php if ($contract_variation->SortUrl($contract_variation_preview->VariationNo) == "") { ?>
		<th class="<?php echo $contract_variation_preview->VariationNo->headerCellClass() ?>"><?php echo $contract_variation_preview->VariationNo->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $contract_variation_preview->VariationNo->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($contract_variation_preview->VariationNo->Name) ?>" data-sort-order="<?php echo $contract_variation_preview->SortField == $contract_variation_preview->VariationNo->Name && $contract_variation_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contract_variation_preview->VariationNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($contract_variation_preview->SortField == $contract_variation_preview->VariationNo->Name) { ?><?php if ($contract_variation_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contract_variation_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contract_variation_preview->VariationDate->Visible) { // VariationDate ?>
	<?php if ($contract_variation->SortUrl($contract_variation_preview->VariationDate) == "") { ?>
		<th class="<?php echo $contract_variation_preview->VariationDate->headerCellClass() ?>"><?php echo $contract_variation_preview->VariationDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $contract_variation_preview->VariationDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($contract_variation_preview->VariationDate->Name) ?>" data-sort-order="<?php echo $contract_variation_preview->SortField == $contract_variation_preview->VariationDate->Name && $contract_variation_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contract_variation_preview->VariationDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($contract_variation_preview->SortField == $contract_variation_preview->VariationDate->Name) { ?><?php if ($contract_variation_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contract_variation_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contract_variation_preview->VariationJustification->Visible) { // VariationJustification ?>
	<?php if ($contract_variation->SortUrl($contract_variation_preview->VariationJustification) == "") { ?>
		<th class="<?php echo $contract_variation_preview->VariationJustification->headerCellClass() ?>"><?php echo $contract_variation_preview->VariationJustification->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $contract_variation_preview->VariationJustification->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($contract_variation_preview->VariationJustification->Name) ?>" data-sort-order="<?php echo $contract_variation_preview->SortField == $contract_variation_preview->VariationJustification->Name && $contract_variation_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contract_variation_preview->VariationJustification->caption() ?></span><span class="ew-table-header-sort"><?php if ($contract_variation_preview->SortField == $contract_variation_preview->VariationJustification->Name) { ?><?php if ($contract_variation_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contract_variation_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$contract_variation_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$contract_variation_preview->RecCount = 0;
$contract_variation_preview->RowCount = 0;
while ($contract_variation_preview->Recordset && !$contract_variation_preview->Recordset->EOF) {

	// Init row class and style
	$contract_variation_preview->RecCount++;
	$contract_variation_preview->RowCount++;
	$contract_variation_preview->CssStyle = "";
	$contract_variation_preview->loadListRowValues($contract_variation_preview->Recordset);

	// Render row
	$contract_variation->RowType = ROWTYPE_PREVIEW; // Preview record
	$contract_variation_preview->resetAttributes();
	$contract_variation_preview->renderListRow();

	// Render list options
	$contract_variation_preview->renderListOptions();
?>
	<tr <?php echo $contract_variation->rowAttributes() ?>>
<?php

// Render list options (body, left)
$contract_variation_preview->ListOptions->render("body", "left", $contract_variation_preview->RowCount);
?>
<?php if ($contract_variation_preview->LACode->Visible) { // LACode ?>
		<!-- LACode -->
		<td<?php echo $contract_variation_preview->LACode->cellAttributes() ?>>
<span<?php echo $contract_variation_preview->LACode->viewAttributes() ?>><?php echo $contract_variation_preview->LACode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($contract_variation_preview->DepartmentCode->Visible) { // DepartmentCode ?>
		<!-- DepartmentCode -->
		<td<?php echo $contract_variation_preview->DepartmentCode->cellAttributes() ?>>
<span<?php echo $contract_variation_preview->DepartmentCode->viewAttributes() ?>><?php echo $contract_variation_preview->DepartmentCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($contract_variation_preview->SectionCode->Visible) { // SectionCode ?>
		<!-- SectionCode -->
		<td<?php echo $contract_variation_preview->SectionCode->cellAttributes() ?>>
<span<?php echo $contract_variation_preview->SectionCode->viewAttributes() ?>><?php echo $contract_variation_preview->SectionCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($contract_variation_preview->ContractNo->Visible) { // ContractNo ?>
		<!-- ContractNo -->
		<td<?php echo $contract_variation_preview->ContractNo->cellAttributes() ?>>
<span<?php echo $contract_variation_preview->ContractNo->viewAttributes() ?>><?php echo $contract_variation_preview->ContractNo->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($contract_variation_preview->VariationAmount->Visible) { // VariationAmount ?>
		<!-- VariationAmount -->
		<td<?php echo $contract_variation_preview->VariationAmount->cellAttributes() ?>>
<span<?php echo $contract_variation_preview->VariationAmount->viewAttributes() ?>><?php echo $contract_variation_preview->VariationAmount->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($contract_variation_preview->VariationNo->Visible) { // VariationNo ?>
		<!-- VariationNo -->
		<td<?php echo $contract_variation_preview->VariationNo->cellAttributes() ?>>
<span<?php echo $contract_variation_preview->VariationNo->viewAttributes() ?>><?php echo $contract_variation_preview->VariationNo->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($contract_variation_preview->VariationDate->Visible) { // VariationDate ?>
		<!-- VariationDate -->
		<td<?php echo $contract_variation_preview->VariationDate->cellAttributes() ?>>
<span<?php echo $contract_variation_preview->VariationDate->viewAttributes() ?>><?php echo $contract_variation_preview->VariationDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($contract_variation_preview->VariationJustification->Visible) { // VariationJustification ?>
		<!-- VariationJustification -->
		<td<?php echo $contract_variation_preview->VariationJustification->cellAttributes() ?>>
<span<?php echo $contract_variation_preview->VariationJustification->viewAttributes() ?>><?php echo $contract_variation_preview->VariationJustification->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$contract_variation_preview->ListOptions->render("body", "right", $contract_variation_preview->RowCount);
?>
	</tr>
<?php
	$contract_variation_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $contract_variation_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($contract_variation_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($contract_variation_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$contract_variation_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($contract_variation_preview->Recordset)
	$contract_variation_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$contract_variation_preview->terminate();
?>