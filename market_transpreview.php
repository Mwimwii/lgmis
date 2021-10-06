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
$market_trans_preview = new market_trans_preview();

// Run the page
$market_trans_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$market_trans_preview->Page_Render();
?>
<?php $market_trans_preview->showPageHeader(); ?>
<?php if ($market_trans_preview->TotalRecords > 0) { ?>
<div class="card ew-grid market_trans"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$market_trans_preview->renderListOptions();

// Render list options (header, left)
$market_trans_preview->ListOptions->render("header", "left");
?>
<?php if ($market_trans_preview->TransNo->Visible) { // TransNo ?>
	<?php if ($market_trans->SortUrl($market_trans_preview->TransNo) == "") { ?>
		<th class="<?php echo $market_trans_preview->TransNo->headerCellClass() ?>"><?php echo $market_trans_preview->TransNo->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $market_trans_preview->TransNo->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($market_trans_preview->TransNo->Name) ?>" data-sort-order="<?php echo $market_trans_preview->SortField == $market_trans_preview->TransNo->Name && $market_trans_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $market_trans_preview->TransNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($market_trans_preview->SortField == $market_trans_preview->TransNo->Name) { ?><?php if ($market_trans_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($market_trans_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($market_trans_preview->MarketItemNo->Visible) { // MarketItemNo ?>
	<?php if ($market_trans->SortUrl($market_trans_preview->MarketItemNo) == "") { ?>
		<th class="<?php echo $market_trans_preview->MarketItemNo->headerCellClass() ?>"><?php echo $market_trans_preview->MarketItemNo->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $market_trans_preview->MarketItemNo->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($market_trans_preview->MarketItemNo->Name) ?>" data-sort-order="<?php echo $market_trans_preview->SortField == $market_trans_preview->MarketItemNo->Name && $market_trans_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $market_trans_preview->MarketItemNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($market_trans_preview->SortField == $market_trans_preview->MarketItemNo->Name) { ?><?php if ($market_trans_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($market_trans_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($market_trans_preview->DateHired->Visible) { // DateHired ?>
	<?php if ($market_trans->SortUrl($market_trans_preview->DateHired) == "") { ?>
		<th class="<?php echo $market_trans_preview->DateHired->headerCellClass() ?>"><?php echo $market_trans_preview->DateHired->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $market_trans_preview->DateHired->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($market_trans_preview->DateHired->Name) ?>" data-sort-order="<?php echo $market_trans_preview->SortField == $market_trans_preview->DateHired->Name && $market_trans_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $market_trans_preview->DateHired->caption() ?></span><span class="ew-table-header-sort"><?php if ($market_trans_preview->SortField == $market_trans_preview->DateHired->Name) { ?><?php if ($market_trans_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($market_trans_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($market_trans_preview->MartketeerName->Visible) { // MartketeerName ?>
	<?php if ($market_trans->SortUrl($market_trans_preview->MartketeerName) == "") { ?>
		<th class="<?php echo $market_trans_preview->MartketeerName->headerCellClass() ?>"><?php echo $market_trans_preview->MartketeerName->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $market_trans_preview->MartketeerName->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($market_trans_preview->MartketeerName->Name) ?>" data-sort-order="<?php echo $market_trans_preview->SortField == $market_trans_preview->MartketeerName->Name && $market_trans_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $market_trans_preview->MartketeerName->caption() ?></span><span class="ew-table-header-sort"><?php if ($market_trans_preview->SortField == $market_trans_preview->MartketeerName->Name) { ?><?php if ($market_trans_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($market_trans_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($market_trans_preview->MartketeerID->Visible) { // MartketeerID ?>
	<?php if ($market_trans->SortUrl($market_trans_preview->MartketeerID) == "") { ?>
		<th class="<?php echo $market_trans_preview->MartketeerID->headerCellClass() ?>"><?php echo $market_trans_preview->MartketeerID->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $market_trans_preview->MartketeerID->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($market_trans_preview->MartketeerID->Name) ?>" data-sort-order="<?php echo $market_trans_preview->SortField == $market_trans_preview->MartketeerID->Name && $market_trans_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $market_trans_preview->MartketeerID->caption() ?></span><span class="ew-table-header-sort"><?php if ($market_trans_preview->SortField == $market_trans_preview->MartketeerID->Name) { ?><?php if ($market_trans_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($market_trans_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($market_trans_preview->AmountDue->Visible) { // AmountDue ?>
	<?php if ($market_trans->SortUrl($market_trans_preview->AmountDue) == "") { ?>
		<th class="<?php echo $market_trans_preview->AmountDue->headerCellClass() ?>"><?php echo $market_trans_preview->AmountDue->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $market_trans_preview->AmountDue->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($market_trans_preview->AmountDue->Name) ?>" data-sort-order="<?php echo $market_trans_preview->SortField == $market_trans_preview->AmountDue->Name && $market_trans_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $market_trans_preview->AmountDue->caption() ?></span><span class="ew-table-header-sort"><?php if ($market_trans_preview->SortField == $market_trans_preview->AmountDue->Name) { ?><?php if ($market_trans_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($market_trans_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($market_trans_preview->AmountPaid->Visible) { // AmountPaid ?>
	<?php if ($market_trans->SortUrl($market_trans_preview->AmountPaid) == "") { ?>
		<th class="<?php echo $market_trans_preview->AmountPaid->headerCellClass() ?>"><?php echo $market_trans_preview->AmountPaid->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $market_trans_preview->AmountPaid->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($market_trans_preview->AmountPaid->Name) ?>" data-sort-order="<?php echo $market_trans_preview->SortField == $market_trans_preview->AmountPaid->Name && $market_trans_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $market_trans_preview->AmountPaid->caption() ?></span><span class="ew-table-header-sort"><?php if ($market_trans_preview->SortField == $market_trans_preview->AmountPaid->Name) { ?><?php if ($market_trans_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($market_trans_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($market_trans_preview->ReceiptNo->Visible) { // ReceiptNo ?>
	<?php if ($market_trans->SortUrl($market_trans_preview->ReceiptNo) == "") { ?>
		<th class="<?php echo $market_trans_preview->ReceiptNo->headerCellClass() ?>"><?php echo $market_trans_preview->ReceiptNo->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $market_trans_preview->ReceiptNo->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($market_trans_preview->ReceiptNo->Name) ?>" data-sort-order="<?php echo $market_trans_preview->SortField == $market_trans_preview->ReceiptNo->Name && $market_trans_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $market_trans_preview->ReceiptNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($market_trans_preview->SortField == $market_trans_preview->ReceiptNo->Name) { ?><?php if ($market_trans_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($market_trans_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($market_trans_preview->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
	<?php if ($market_trans->SortUrl($market_trans_preview->LastUpdatedBy) == "") { ?>
		<th class="<?php echo $market_trans_preview->LastUpdatedBy->headerCellClass() ?>"><?php echo $market_trans_preview->LastUpdatedBy->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $market_trans_preview->LastUpdatedBy->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($market_trans_preview->LastUpdatedBy->Name) ?>" data-sort-order="<?php echo $market_trans_preview->SortField == $market_trans_preview->LastUpdatedBy->Name && $market_trans_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $market_trans_preview->LastUpdatedBy->caption() ?></span><span class="ew-table-header-sort"><?php if ($market_trans_preview->SortField == $market_trans_preview->LastUpdatedBy->Name) { ?><?php if ($market_trans_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($market_trans_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($market_trans_preview->LastUpdateDate->Visible) { // LastUpdateDate ?>
	<?php if ($market_trans->SortUrl($market_trans_preview->LastUpdateDate) == "") { ?>
		<th class="<?php echo $market_trans_preview->LastUpdateDate->headerCellClass() ?>"><?php echo $market_trans_preview->LastUpdateDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $market_trans_preview->LastUpdateDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($market_trans_preview->LastUpdateDate->Name) ?>" data-sort-order="<?php echo $market_trans_preview->SortField == $market_trans_preview->LastUpdateDate->Name && $market_trans_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $market_trans_preview->LastUpdateDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($market_trans_preview->SortField == $market_trans_preview->LastUpdateDate->Name) { ?><?php if ($market_trans_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($market_trans_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$market_trans_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$market_trans_preview->RecCount = 0;
$market_trans_preview->RowCount = 0;
while ($market_trans_preview->Recordset && !$market_trans_preview->Recordset->EOF) {

	// Init row class and style
	$market_trans_preview->RecCount++;
	$market_trans_preview->RowCount++;
	$market_trans_preview->CssStyle = "";
	$market_trans_preview->loadListRowValues($market_trans_preview->Recordset);

	// Render row
	$market_trans->RowType = ROWTYPE_PREVIEW; // Preview record
	$market_trans_preview->resetAttributes();
	$market_trans_preview->renderListRow();

	// Render list options
	$market_trans_preview->renderListOptions();
?>
	<tr <?php echo $market_trans->rowAttributes() ?>>
<?php

// Render list options (body, left)
$market_trans_preview->ListOptions->render("body", "left", $market_trans_preview->RowCount);
?>
<?php if ($market_trans_preview->TransNo->Visible) { // TransNo ?>
		<!-- TransNo -->
		<td<?php echo $market_trans_preview->TransNo->cellAttributes() ?>>
<span<?php echo $market_trans_preview->TransNo->viewAttributes() ?>><?php echo $market_trans_preview->TransNo->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($market_trans_preview->MarketItemNo->Visible) { // MarketItemNo ?>
		<!-- MarketItemNo -->
		<td<?php echo $market_trans_preview->MarketItemNo->cellAttributes() ?>>
<span<?php echo $market_trans_preview->MarketItemNo->viewAttributes() ?>><?php echo $market_trans_preview->MarketItemNo->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($market_trans_preview->DateHired->Visible) { // DateHired ?>
		<!-- DateHired -->
		<td<?php echo $market_trans_preview->DateHired->cellAttributes() ?>>
<span<?php echo $market_trans_preview->DateHired->viewAttributes() ?>><?php echo $market_trans_preview->DateHired->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($market_trans_preview->MartketeerName->Visible) { // MartketeerName ?>
		<!-- MartketeerName -->
		<td<?php echo $market_trans_preview->MartketeerName->cellAttributes() ?>>
<span<?php echo $market_trans_preview->MartketeerName->viewAttributes() ?>><?php echo $market_trans_preview->MartketeerName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($market_trans_preview->MartketeerID->Visible) { // MartketeerID ?>
		<!-- MartketeerID -->
		<td<?php echo $market_trans_preview->MartketeerID->cellAttributes() ?>>
<span<?php echo $market_trans_preview->MartketeerID->viewAttributes() ?>><?php echo $market_trans_preview->MartketeerID->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($market_trans_preview->AmountDue->Visible) { // AmountDue ?>
		<!-- AmountDue -->
		<td<?php echo $market_trans_preview->AmountDue->cellAttributes() ?>>
<span<?php echo $market_trans_preview->AmountDue->viewAttributes() ?>><?php echo $market_trans_preview->AmountDue->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($market_trans_preview->AmountPaid->Visible) { // AmountPaid ?>
		<!-- AmountPaid -->
		<td<?php echo $market_trans_preview->AmountPaid->cellAttributes() ?>>
<span<?php echo $market_trans_preview->AmountPaid->viewAttributes() ?>><?php echo $market_trans_preview->AmountPaid->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($market_trans_preview->ReceiptNo->Visible) { // ReceiptNo ?>
		<!-- ReceiptNo -->
		<td<?php echo $market_trans_preview->ReceiptNo->cellAttributes() ?>>
<span<?php echo $market_trans_preview->ReceiptNo->viewAttributes() ?>><?php echo $market_trans_preview->ReceiptNo->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($market_trans_preview->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
		<!-- LastUpdatedBy -->
		<td<?php echo $market_trans_preview->LastUpdatedBy->cellAttributes() ?>>
<span<?php echo $market_trans_preview->LastUpdatedBy->viewAttributes() ?>><?php echo $market_trans_preview->LastUpdatedBy->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($market_trans_preview->LastUpdateDate->Visible) { // LastUpdateDate ?>
		<!-- LastUpdateDate -->
		<td<?php echo $market_trans_preview->LastUpdateDate->cellAttributes() ?>>
<span<?php echo $market_trans_preview->LastUpdateDate->viewAttributes() ?>><?php echo $market_trans_preview->LastUpdateDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$market_trans_preview->ListOptions->render("body", "right", $market_trans_preview->RowCount);
?>
	</tr>
<?php
	$market_trans_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $market_trans_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($market_trans_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($market_trans_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$market_trans_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($market_trans_preview->Recordset)
	$market_trans_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$market_trans_preview->terminate();
?>