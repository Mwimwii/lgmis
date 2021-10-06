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
$council_resolution_preview = new council_resolution_preview();

// Run the page
$council_resolution_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$council_resolution_preview->Page_Render();
?>
<?php $council_resolution_preview->showPageHeader(); ?>
<?php if ($council_resolution_preview->TotalRecords > 0) { ?>
<div class="card ew-grid council_resolution"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$council_resolution_preview->renderListOptions();

// Render list options (header, left)
$council_resolution_preview->ListOptions->render("header", "left");
?>
<?php if ($council_resolution_preview->MeetingNo->Visible) { // MeetingNo ?>
	<?php if ($council_resolution->SortUrl($council_resolution_preview->MeetingNo) == "") { ?>
		<th class="<?php echo $council_resolution_preview->MeetingNo->headerCellClass() ?>"><?php echo $council_resolution_preview->MeetingNo->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $council_resolution_preview->MeetingNo->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($council_resolution_preview->MeetingNo->Name) ?>" data-sort-order="<?php echo $council_resolution_preview->SortField == $council_resolution_preview->MeetingNo->Name && $council_resolution_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $council_resolution_preview->MeetingNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($council_resolution_preview->SortField == $council_resolution_preview->MeetingNo->Name) { ?><?php if ($council_resolution_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($council_resolution_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($council_resolution_preview->MinuteNumber->Visible) { // MinuteNumber ?>
	<?php if ($council_resolution->SortUrl($council_resolution_preview->MinuteNumber) == "") { ?>
		<th class="<?php echo $council_resolution_preview->MinuteNumber->headerCellClass() ?>"><?php echo $council_resolution_preview->MinuteNumber->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $council_resolution_preview->MinuteNumber->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($council_resolution_preview->MinuteNumber->Name) ?>" data-sort-order="<?php echo $council_resolution_preview->SortField == $council_resolution_preview->MinuteNumber->Name && $council_resolution_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $council_resolution_preview->MinuteNumber->caption() ?></span><span class="ew-table-header-sort"><?php if ($council_resolution_preview->SortField == $council_resolution_preview->MinuteNumber->Name) { ?><?php if ($council_resolution_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($council_resolution_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($council_resolution_preview->Resolutionccategory->Visible) { // Resolutionccategory ?>
	<?php if ($council_resolution->SortUrl($council_resolution_preview->Resolutionccategory) == "") { ?>
		<th class="<?php echo $council_resolution_preview->Resolutionccategory->headerCellClass() ?>"><?php echo $council_resolution_preview->Resolutionccategory->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $council_resolution_preview->Resolutionccategory->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($council_resolution_preview->Resolutionccategory->Name) ?>" data-sort-order="<?php echo $council_resolution_preview->SortField == $council_resolution_preview->Resolutionccategory->Name && $council_resolution_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $council_resolution_preview->Resolutionccategory->caption() ?></span><span class="ew-table-header-sort"><?php if ($council_resolution_preview->SortField == $council_resolution_preview->Resolutionccategory->Name) { ?><?php if ($council_resolution_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($council_resolution_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($council_resolution_preview->LACode->Visible) { // LACode ?>
	<?php if ($council_resolution->SortUrl($council_resolution_preview->LACode) == "") { ?>
		<th class="<?php echo $council_resolution_preview->LACode->headerCellClass() ?>"><?php echo $council_resolution_preview->LACode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $council_resolution_preview->LACode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($council_resolution_preview->LACode->Name) ?>" data-sort-order="<?php echo $council_resolution_preview->SortField == $council_resolution_preview->LACode->Name && $council_resolution_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $council_resolution_preview->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($council_resolution_preview->SortField == $council_resolution_preview->LACode->Name) { ?><?php if ($council_resolution_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($council_resolution_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($council_resolution_preview->ResolutionNo->Visible) { // ResolutionNo ?>
	<?php if ($council_resolution->SortUrl($council_resolution_preview->ResolutionNo) == "") { ?>
		<th class="<?php echo $council_resolution_preview->ResolutionNo->headerCellClass() ?>"><?php echo $council_resolution_preview->ResolutionNo->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $council_resolution_preview->ResolutionNo->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($council_resolution_preview->ResolutionNo->Name) ?>" data-sort-order="<?php echo $council_resolution_preview->SortField == $council_resolution_preview->ResolutionNo->Name && $council_resolution_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $council_resolution_preview->ResolutionNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($council_resolution_preview->SortField == $council_resolution_preview->ResolutionNo->Name) { ?><?php if ($council_resolution_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($council_resolution_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($council_resolution_preview->Responsibility->Visible) { // Responsibility ?>
	<?php if ($council_resolution->SortUrl($council_resolution_preview->Responsibility) == "") { ?>
		<th class="<?php echo $council_resolution_preview->Responsibility->headerCellClass() ?>"><?php echo $council_resolution_preview->Responsibility->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $council_resolution_preview->Responsibility->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($council_resolution_preview->Responsibility->Name) ?>" data-sort-order="<?php echo $council_resolution_preview->SortField == $council_resolution_preview->Responsibility->Name && $council_resolution_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $council_resolution_preview->Responsibility->caption() ?></span><span class="ew-table-header-sort"><?php if ($council_resolution_preview->SortField == $council_resolution_preview->Responsibility->Name) { ?><?php if ($council_resolution_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($council_resolution_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($council_resolution_preview->ActionDate->Visible) { // ActionDate ?>
	<?php if ($council_resolution->SortUrl($council_resolution_preview->ActionDate) == "") { ?>
		<th class="<?php echo $council_resolution_preview->ActionDate->headerCellClass() ?>"><?php echo $council_resolution_preview->ActionDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $council_resolution_preview->ActionDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($council_resolution_preview->ActionDate->Name) ?>" data-sort-order="<?php echo $council_resolution_preview->SortField == $council_resolution_preview->ActionDate->Name && $council_resolution_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $council_resolution_preview->ActionDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($council_resolution_preview->SortField == $council_resolution_preview->ActionDate->Name) { ?><?php if ($council_resolution_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($council_resolution_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$council_resolution_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$council_resolution_preview->RecCount = 0;
$council_resolution_preview->RowCount = 0;
while ($council_resolution_preview->Recordset && !$council_resolution_preview->Recordset->EOF) {

	// Init row class and style
	$council_resolution_preview->RecCount++;
	$council_resolution_preview->RowCount++;
	$council_resolution_preview->CssStyle = "";
	$council_resolution_preview->loadListRowValues($council_resolution_preview->Recordset);

	// Render row
	$council_resolution->RowType = ROWTYPE_PREVIEW; // Preview record
	$council_resolution_preview->resetAttributes();
	$council_resolution_preview->renderListRow();

	// Render list options
	$council_resolution_preview->renderListOptions();
?>
	<tr <?php echo $council_resolution->rowAttributes() ?>>
<?php

// Render list options (body, left)
$council_resolution_preview->ListOptions->render("body", "left", $council_resolution_preview->RowCount);
?>
<?php if ($council_resolution_preview->MeetingNo->Visible) { // MeetingNo ?>
		<!-- MeetingNo -->
		<td<?php echo $council_resolution_preview->MeetingNo->cellAttributes() ?>>
<span<?php echo $council_resolution_preview->MeetingNo->viewAttributes() ?>><?php echo $council_resolution_preview->MeetingNo->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($council_resolution_preview->MinuteNumber->Visible) { // MinuteNumber ?>
		<!-- MinuteNumber -->
		<td<?php echo $council_resolution_preview->MinuteNumber->cellAttributes() ?>>
<span<?php echo $council_resolution_preview->MinuteNumber->viewAttributes() ?>><?php echo $council_resolution_preview->MinuteNumber->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($council_resolution_preview->Resolutionccategory->Visible) { // Resolutionccategory ?>
		<!-- Resolutionccategory -->
		<td<?php echo $council_resolution_preview->Resolutionccategory->cellAttributes() ?>>
<span<?php echo $council_resolution_preview->Resolutionccategory->viewAttributes() ?>><?php echo $council_resolution_preview->Resolutionccategory->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($council_resolution_preview->LACode->Visible) { // LACode ?>
		<!-- LACode -->
		<td<?php echo $council_resolution_preview->LACode->cellAttributes() ?>>
<span<?php echo $council_resolution_preview->LACode->viewAttributes() ?>><?php echo $council_resolution_preview->LACode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($council_resolution_preview->ResolutionNo->Visible) { // ResolutionNo ?>
		<!-- ResolutionNo -->
		<td<?php echo $council_resolution_preview->ResolutionNo->cellAttributes() ?>>
<span<?php echo $council_resolution_preview->ResolutionNo->viewAttributes() ?>><?php echo $council_resolution_preview->ResolutionNo->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($council_resolution_preview->Responsibility->Visible) { // Responsibility ?>
		<!-- Responsibility -->
		<td<?php echo $council_resolution_preview->Responsibility->cellAttributes() ?>>
<span<?php echo $council_resolution_preview->Responsibility->viewAttributes() ?>><?php echo $council_resolution_preview->Responsibility->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($council_resolution_preview->ActionDate->Visible) { // ActionDate ?>
		<!-- ActionDate -->
		<td<?php echo $council_resolution_preview->ActionDate->cellAttributes() ?>>
<span<?php echo $council_resolution_preview->ActionDate->viewAttributes() ?>><?php echo $council_resolution_preview->ActionDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$council_resolution_preview->ListOptions->render("body", "right", $council_resolution_preview->RowCount);
?>
	</tr>
<?php
	$council_resolution_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $council_resolution_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($council_resolution_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($council_resolution_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$council_resolution_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($council_resolution_preview->Recordset)
	$council_resolution_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$council_resolution_preview->terminate();
?>