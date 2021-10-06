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
$market_property_preview = new market_property_preview();

// Run the page
$market_property_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$market_property_preview->Page_Render();
?>
<?php $market_property_preview->showPageHeader(); ?>
<?php if ($market_property_preview->TotalRecords > 0) { ?>
<div class="card ew-grid market_property"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$market_property_preview->renderListOptions();

// Render list options (header, left)
$market_property_preview->ListOptions->render("header", "left");
?>
<?php if ($market_property_preview->MarketItemNo->Visible) { // MarketItemNo ?>
	<?php if ($market_property->SortUrl($market_property_preview->MarketItemNo) == "") { ?>
		<th class="<?php echo $market_property_preview->MarketItemNo->headerCellClass() ?>"><?php echo $market_property_preview->MarketItemNo->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $market_property_preview->MarketItemNo->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($market_property_preview->MarketItemNo->Name) ?>" data-sort-order="<?php echo $market_property_preview->SortField == $market_property_preview->MarketItemNo->Name && $market_property_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $market_property_preview->MarketItemNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($market_property_preview->SortField == $market_property_preview->MarketItemNo->Name) { ?><?php if ($market_property_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($market_property_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($market_property_preview->MarketNo->Visible) { // MarketNo ?>
	<?php if ($market_property->SortUrl($market_property_preview->MarketNo) == "") { ?>
		<th class="<?php echo $market_property_preview->MarketNo->headerCellClass() ?>"><?php echo $market_property_preview->MarketNo->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $market_property_preview->MarketNo->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($market_property_preview->MarketNo->Name) ?>" data-sort-order="<?php echo $market_property_preview->SortField == $market_property_preview->MarketNo->Name && $market_property_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $market_property_preview->MarketNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($market_property_preview->SortField == $market_property_preview->MarketNo->Name) { ?><?php if ($market_property_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($market_property_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($market_property_preview->ItemName->Visible) { // ItemName ?>
	<?php if ($market_property->SortUrl($market_property_preview->ItemName) == "") { ?>
		<th class="<?php echo $market_property_preview->ItemName->headerCellClass() ?>"><?php echo $market_property_preview->ItemName->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $market_property_preview->ItemName->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($market_property_preview->ItemName->Name) ?>" data-sort-order="<?php echo $market_property_preview->SortField == $market_property_preview->ItemName->Name && $market_property_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $market_property_preview->ItemName->caption() ?></span><span class="ew-table-header-sort"><?php if ($market_property_preview->SortField == $market_property_preview->ItemName->Name) { ?><?php if ($market_property_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($market_property_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($market_property_preview->ItemRef->Visible) { // ItemRef ?>
	<?php if ($market_property->SortUrl($market_property_preview->ItemRef) == "") { ?>
		<th class="<?php echo $market_property_preview->ItemRef->headerCellClass() ?>"><?php echo $market_property_preview->ItemRef->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $market_property_preview->ItemRef->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($market_property_preview->ItemRef->Name) ?>" data-sort-order="<?php echo $market_property_preview->SortField == $market_property_preview->ItemRef->Name && $market_property_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $market_property_preview->ItemRef->caption() ?></span><span class="ew-table-header-sort"><?php if ($market_property_preview->SortField == $market_property_preview->ItemRef->Name) { ?><?php if ($market_property_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($market_property_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($market_property_preview->ItemLength->Visible) { // ItemLength ?>
	<?php if ($market_property->SortUrl($market_property_preview->ItemLength) == "") { ?>
		<th class="<?php echo $market_property_preview->ItemLength->headerCellClass() ?>"><?php echo $market_property_preview->ItemLength->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $market_property_preview->ItemLength->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($market_property_preview->ItemLength->Name) ?>" data-sort-order="<?php echo $market_property_preview->SortField == $market_property_preview->ItemLength->Name && $market_property_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $market_property_preview->ItemLength->caption() ?></span><span class="ew-table-header-sort"><?php if ($market_property_preview->SortField == $market_property_preview->ItemLength->Name) { ?><?php if ($market_property_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($market_property_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($market_property_preview->ItemWidth->Visible) { // ItemWidth ?>
	<?php if ($market_property->SortUrl($market_property_preview->ItemWidth) == "") { ?>
		<th class="<?php echo $market_property_preview->ItemWidth->headerCellClass() ?>"><?php echo $market_property_preview->ItemWidth->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $market_property_preview->ItemWidth->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($market_property_preview->ItemWidth->Name) ?>" data-sort-order="<?php echo $market_property_preview->SortField == $market_property_preview->ItemWidth->Name && $market_property_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $market_property_preview->ItemWidth->caption() ?></span><span class="ew-table-header-sort"><?php if ($market_property_preview->SortField == $market_property_preview->ItemWidth->Name) { ?><?php if ($market_property_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($market_property_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($market_property_preview->DefaultFees->Visible) { // DefaultFees ?>
	<?php if ($market_property->SortUrl($market_property_preview->DefaultFees) == "") { ?>
		<th class="<?php echo $market_property_preview->DefaultFees->headerCellClass() ?>"><?php echo $market_property_preview->DefaultFees->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $market_property_preview->DefaultFees->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($market_property_preview->DefaultFees->Name) ?>" data-sort-order="<?php echo $market_property_preview->SortField == $market_property_preview->DefaultFees->Name && $market_property_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $market_property_preview->DefaultFees->caption() ?></span><span class="ew-table-header-sort"><?php if ($market_property_preview->SortField == $market_property_preview->DefaultFees->Name) { ?><?php if ($market_property_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($market_property_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($market_property_preview->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
	<?php if ($market_property->SortUrl($market_property_preview->LastUpdatedBy) == "") { ?>
		<th class="<?php echo $market_property_preview->LastUpdatedBy->headerCellClass() ?>"><?php echo $market_property_preview->LastUpdatedBy->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $market_property_preview->LastUpdatedBy->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($market_property_preview->LastUpdatedBy->Name) ?>" data-sort-order="<?php echo $market_property_preview->SortField == $market_property_preview->LastUpdatedBy->Name && $market_property_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $market_property_preview->LastUpdatedBy->caption() ?></span><span class="ew-table-header-sort"><?php if ($market_property_preview->SortField == $market_property_preview->LastUpdatedBy->Name) { ?><?php if ($market_property_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($market_property_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($market_property_preview->LastUpdateDate->Visible) { // LastUpdateDate ?>
	<?php if ($market_property->SortUrl($market_property_preview->LastUpdateDate) == "") { ?>
		<th class="<?php echo $market_property_preview->LastUpdateDate->headerCellClass() ?>"><?php echo $market_property_preview->LastUpdateDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $market_property_preview->LastUpdateDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($market_property_preview->LastUpdateDate->Name) ?>" data-sort-order="<?php echo $market_property_preview->SortField == $market_property_preview->LastUpdateDate->Name && $market_property_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $market_property_preview->LastUpdateDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($market_property_preview->SortField == $market_property_preview->LastUpdateDate->Name) { ?><?php if ($market_property_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($market_property_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$market_property_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$market_property_preview->RecCount = 0;
$market_property_preview->RowCount = 0;
while ($market_property_preview->Recordset && !$market_property_preview->Recordset->EOF) {

	// Init row class and style
	$market_property_preview->RecCount++;
	$market_property_preview->RowCount++;
	$market_property_preview->CssStyle = "";
	$market_property_preview->loadListRowValues($market_property_preview->Recordset);

	// Render row
	$market_property->RowType = ROWTYPE_PREVIEW; // Preview record
	$market_property_preview->resetAttributes();
	$market_property_preview->renderListRow();

	// Render list options
	$market_property_preview->renderListOptions();
?>
	<tr <?php echo $market_property->rowAttributes() ?>>
<?php

// Render list options (body, left)
$market_property_preview->ListOptions->render("body", "left", $market_property_preview->RowCount);
?>
<?php if ($market_property_preview->MarketItemNo->Visible) { // MarketItemNo ?>
		<!-- MarketItemNo -->
		<td<?php echo $market_property_preview->MarketItemNo->cellAttributes() ?>>
<span<?php echo $market_property_preview->MarketItemNo->viewAttributes() ?>><?php echo $market_property_preview->MarketItemNo->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($market_property_preview->MarketNo->Visible) { // MarketNo ?>
		<!-- MarketNo -->
		<td<?php echo $market_property_preview->MarketNo->cellAttributes() ?>>
<span<?php echo $market_property_preview->MarketNo->viewAttributes() ?>><?php echo $market_property_preview->MarketNo->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($market_property_preview->ItemName->Visible) { // ItemName ?>
		<!-- ItemName -->
		<td<?php echo $market_property_preview->ItemName->cellAttributes() ?>>
<span<?php echo $market_property_preview->ItemName->viewAttributes() ?>><?php echo $market_property_preview->ItemName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($market_property_preview->ItemRef->Visible) { // ItemRef ?>
		<!-- ItemRef -->
		<td<?php echo $market_property_preview->ItemRef->cellAttributes() ?>>
<span<?php echo $market_property_preview->ItemRef->viewAttributes() ?>><?php echo $market_property_preview->ItemRef->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($market_property_preview->ItemLength->Visible) { // ItemLength ?>
		<!-- ItemLength -->
		<td<?php echo $market_property_preview->ItemLength->cellAttributes() ?>>
<span<?php echo $market_property_preview->ItemLength->viewAttributes() ?>><?php echo $market_property_preview->ItemLength->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($market_property_preview->ItemWidth->Visible) { // ItemWidth ?>
		<!-- ItemWidth -->
		<td<?php echo $market_property_preview->ItemWidth->cellAttributes() ?>>
<span<?php echo $market_property_preview->ItemWidth->viewAttributes() ?>><?php echo $market_property_preview->ItemWidth->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($market_property_preview->DefaultFees->Visible) { // DefaultFees ?>
		<!-- DefaultFees -->
		<td<?php echo $market_property_preview->DefaultFees->cellAttributes() ?>>
<span<?php echo $market_property_preview->DefaultFees->viewAttributes() ?>><?php echo $market_property_preview->DefaultFees->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($market_property_preview->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
		<!-- LastUpdatedBy -->
		<td<?php echo $market_property_preview->LastUpdatedBy->cellAttributes() ?>>
<span<?php echo $market_property_preview->LastUpdatedBy->viewAttributes() ?>><?php echo $market_property_preview->LastUpdatedBy->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($market_property_preview->LastUpdateDate->Visible) { // LastUpdateDate ?>
		<!-- LastUpdateDate -->
		<td<?php echo $market_property_preview->LastUpdateDate->cellAttributes() ?>>
<span<?php echo $market_property_preview->LastUpdateDate->viewAttributes() ?>><?php echo $market_property_preview->LastUpdateDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$market_property_preview->ListOptions->render("body", "right", $market_property_preview->RowCount);
?>
	</tr>
<?php
	$market_property_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $market_property_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($market_property_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($market_property_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$market_property_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($market_property_preview->Recordset)
	$market_property_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$market_property_preview->terminate();
?>