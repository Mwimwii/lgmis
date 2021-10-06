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
$staffdisciplinary_case_preview = new staffdisciplinary_case_preview();

// Run the page
$staffdisciplinary_case_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$staffdisciplinary_case_preview->Page_Render();
?>
<?php $staffdisciplinary_case_preview->showPageHeader(); ?>
<?php if ($staffdisciplinary_case_preview->TotalRecords > 0) { ?>
<div class="card ew-grid staffdisciplinary_case"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$staffdisciplinary_case_preview->renderListOptions();

// Render list options (header, left)
$staffdisciplinary_case_preview->ListOptions->render("header", "left");
?>
<?php if ($staffdisciplinary_case_preview->CaseNo->Visible) { // CaseNo ?>
	<?php if ($staffdisciplinary_case->SortUrl($staffdisciplinary_case_preview->CaseNo) == "") { ?>
		<th class="<?php echo $staffdisciplinary_case_preview->CaseNo->headerCellClass() ?>"><?php echo $staffdisciplinary_case_preview->CaseNo->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $staffdisciplinary_case_preview->CaseNo->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($staffdisciplinary_case_preview->CaseNo->Name) ?>" data-sort-order="<?php echo $staffdisciplinary_case_preview->SortField == $staffdisciplinary_case_preview->CaseNo->Name && $staffdisciplinary_case_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffdisciplinary_case_preview->CaseNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffdisciplinary_case_preview->SortField == $staffdisciplinary_case_preview->CaseNo->Name) { ?><?php if ($staffdisciplinary_case_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffdisciplinary_case_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffdisciplinary_case_preview->OffenseCode->Visible) { // OffenseCode ?>
	<?php if ($staffdisciplinary_case->SortUrl($staffdisciplinary_case_preview->OffenseCode) == "") { ?>
		<th class="<?php echo $staffdisciplinary_case_preview->OffenseCode->headerCellClass() ?>"><?php echo $staffdisciplinary_case_preview->OffenseCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $staffdisciplinary_case_preview->OffenseCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($staffdisciplinary_case_preview->OffenseCode->Name) ?>" data-sort-order="<?php echo $staffdisciplinary_case_preview->SortField == $staffdisciplinary_case_preview->OffenseCode->Name && $staffdisciplinary_case_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffdisciplinary_case_preview->OffenseCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffdisciplinary_case_preview->SortField == $staffdisciplinary_case_preview->OffenseCode->Name) { ?><?php if ($staffdisciplinary_case_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffdisciplinary_case_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffdisciplinary_case_preview->ActionTaken->Visible) { // ActionTaken ?>
	<?php if ($staffdisciplinary_case->SortUrl($staffdisciplinary_case_preview->ActionTaken) == "") { ?>
		<th class="<?php echo $staffdisciplinary_case_preview->ActionTaken->headerCellClass() ?>"><?php echo $staffdisciplinary_case_preview->ActionTaken->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $staffdisciplinary_case_preview->ActionTaken->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($staffdisciplinary_case_preview->ActionTaken->Name) ?>" data-sort-order="<?php echo $staffdisciplinary_case_preview->SortField == $staffdisciplinary_case_preview->ActionTaken->Name && $staffdisciplinary_case_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffdisciplinary_case_preview->ActionTaken->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffdisciplinary_case_preview->SortField == $staffdisciplinary_case_preview->ActionTaken->Name) { ?><?php if ($staffdisciplinary_case_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffdisciplinary_case_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffdisciplinary_case_preview->OffenseDate->Visible) { // OffenseDate ?>
	<?php if ($staffdisciplinary_case->SortUrl($staffdisciplinary_case_preview->OffenseDate) == "") { ?>
		<th class="<?php echo $staffdisciplinary_case_preview->OffenseDate->headerCellClass() ?>"><?php echo $staffdisciplinary_case_preview->OffenseDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $staffdisciplinary_case_preview->OffenseDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($staffdisciplinary_case_preview->OffenseDate->Name) ?>" data-sort-order="<?php echo $staffdisciplinary_case_preview->SortField == $staffdisciplinary_case_preview->OffenseDate->Name && $staffdisciplinary_case_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffdisciplinary_case_preview->OffenseDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffdisciplinary_case_preview->SortField == $staffdisciplinary_case_preview->OffenseDate->Name) { ?><?php if ($staffdisciplinary_case_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffdisciplinary_case_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffdisciplinary_case_preview->ActionDate->Visible) { // ActionDate ?>
	<?php if ($staffdisciplinary_case->SortUrl($staffdisciplinary_case_preview->ActionDate) == "") { ?>
		<th class="<?php echo $staffdisciplinary_case_preview->ActionDate->headerCellClass() ?>"><?php echo $staffdisciplinary_case_preview->ActionDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $staffdisciplinary_case_preview->ActionDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($staffdisciplinary_case_preview->ActionDate->Name) ?>" data-sort-order="<?php echo $staffdisciplinary_case_preview->SortField == $staffdisciplinary_case_preview->ActionDate->Name && $staffdisciplinary_case_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffdisciplinary_case_preview->ActionDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffdisciplinary_case_preview->SortField == $staffdisciplinary_case_preview->ActionDate->Name) { ?><?php if ($staffdisciplinary_case_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffdisciplinary_case_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffdisciplinary_case_preview->DateOfAppealLetter->Visible) { // DateOfAppealLetter ?>
	<?php if ($staffdisciplinary_case->SortUrl($staffdisciplinary_case_preview->DateOfAppealLetter) == "") { ?>
		<th class="<?php echo $staffdisciplinary_case_preview->DateOfAppealLetter->headerCellClass() ?>"><?php echo $staffdisciplinary_case_preview->DateOfAppealLetter->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $staffdisciplinary_case_preview->DateOfAppealLetter->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($staffdisciplinary_case_preview->DateOfAppealLetter->Name) ?>" data-sort-order="<?php echo $staffdisciplinary_case_preview->SortField == $staffdisciplinary_case_preview->DateOfAppealLetter->Name && $staffdisciplinary_case_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffdisciplinary_case_preview->DateOfAppealLetter->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffdisciplinary_case_preview->SortField == $staffdisciplinary_case_preview->DateOfAppealLetter->Name) { ?><?php if ($staffdisciplinary_case_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffdisciplinary_case_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffdisciplinary_case_preview->DateAppealReceived->Visible) { // DateAppealReceived ?>
	<?php if ($staffdisciplinary_case->SortUrl($staffdisciplinary_case_preview->DateAppealReceived) == "") { ?>
		<th class="<?php echo $staffdisciplinary_case_preview->DateAppealReceived->headerCellClass() ?>"><?php echo $staffdisciplinary_case_preview->DateAppealReceived->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $staffdisciplinary_case_preview->DateAppealReceived->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($staffdisciplinary_case_preview->DateAppealReceived->Name) ?>" data-sort-order="<?php echo $staffdisciplinary_case_preview->SortField == $staffdisciplinary_case_preview->DateAppealReceived->Name && $staffdisciplinary_case_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffdisciplinary_case_preview->DateAppealReceived->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffdisciplinary_case_preview->SortField == $staffdisciplinary_case_preview->DateAppealReceived->Name) { ?><?php if ($staffdisciplinary_case_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffdisciplinary_case_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffdisciplinary_case_preview->DateConcluded->Visible) { // DateConcluded ?>
	<?php if ($staffdisciplinary_case->SortUrl($staffdisciplinary_case_preview->DateConcluded) == "") { ?>
		<th class="<?php echo $staffdisciplinary_case_preview->DateConcluded->headerCellClass() ?>"><?php echo $staffdisciplinary_case_preview->DateConcluded->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $staffdisciplinary_case_preview->DateConcluded->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($staffdisciplinary_case_preview->DateConcluded->Name) ?>" data-sort-order="<?php echo $staffdisciplinary_case_preview->SortField == $staffdisciplinary_case_preview->DateConcluded->Name && $staffdisciplinary_case_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffdisciplinary_case_preview->DateConcluded->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffdisciplinary_case_preview->SortField == $staffdisciplinary_case_preview->DateConcluded->Name) { ?><?php if ($staffdisciplinary_case_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffdisciplinary_case_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffdisciplinary_case_preview->AppealStatus->Visible) { // AppealStatus ?>
	<?php if ($staffdisciplinary_case->SortUrl($staffdisciplinary_case_preview->AppealStatus) == "") { ?>
		<th class="<?php echo $staffdisciplinary_case_preview->AppealStatus->headerCellClass() ?>"><?php echo $staffdisciplinary_case_preview->AppealStatus->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $staffdisciplinary_case_preview->AppealStatus->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($staffdisciplinary_case_preview->AppealStatus->Name) ?>" data-sort-order="<?php echo $staffdisciplinary_case_preview->SortField == $staffdisciplinary_case_preview->AppealStatus->Name && $staffdisciplinary_case_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffdisciplinary_case_preview->AppealStatus->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffdisciplinary_case_preview->SortField == $staffdisciplinary_case_preview->AppealStatus->Name) { ?><?php if ($staffdisciplinary_case_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffdisciplinary_case_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$staffdisciplinary_case_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$staffdisciplinary_case_preview->RecCount = 0;
$staffdisciplinary_case_preview->RowCount = 0;
while ($staffdisciplinary_case_preview->Recordset && !$staffdisciplinary_case_preview->Recordset->EOF) {

	// Init row class and style
	$staffdisciplinary_case_preview->RecCount++;
	$staffdisciplinary_case_preview->RowCount++;
	$staffdisciplinary_case_preview->CssStyle = "";
	$staffdisciplinary_case_preview->loadListRowValues($staffdisciplinary_case_preview->Recordset);

	// Render row
	$staffdisciplinary_case->RowType = ROWTYPE_PREVIEW; // Preview record
	$staffdisciplinary_case_preview->resetAttributes();
	$staffdisciplinary_case_preview->renderListRow();

	// Render list options
	$staffdisciplinary_case_preview->renderListOptions();
?>
	<tr <?php echo $staffdisciplinary_case->rowAttributes() ?>>
<?php

// Render list options (body, left)
$staffdisciplinary_case_preview->ListOptions->render("body", "left", $staffdisciplinary_case_preview->RowCount);
?>
<?php if ($staffdisciplinary_case_preview->CaseNo->Visible) { // CaseNo ?>
		<!-- CaseNo -->
		<td<?php echo $staffdisciplinary_case_preview->CaseNo->cellAttributes() ?>>
<span<?php echo $staffdisciplinary_case_preview->CaseNo->viewAttributes() ?>><?php echo $staffdisciplinary_case_preview->CaseNo->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($staffdisciplinary_case_preview->OffenseCode->Visible) { // OffenseCode ?>
		<!-- OffenseCode -->
		<td<?php echo $staffdisciplinary_case_preview->OffenseCode->cellAttributes() ?>>
<span<?php echo $staffdisciplinary_case_preview->OffenseCode->viewAttributes() ?>><?php echo $staffdisciplinary_case_preview->OffenseCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($staffdisciplinary_case_preview->ActionTaken->Visible) { // ActionTaken ?>
		<!-- ActionTaken -->
		<td<?php echo $staffdisciplinary_case_preview->ActionTaken->cellAttributes() ?>>
<span<?php echo $staffdisciplinary_case_preview->ActionTaken->viewAttributes() ?>><?php echo $staffdisciplinary_case_preview->ActionTaken->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($staffdisciplinary_case_preview->OffenseDate->Visible) { // OffenseDate ?>
		<!-- OffenseDate -->
		<td<?php echo $staffdisciplinary_case_preview->OffenseDate->cellAttributes() ?>>
<span<?php echo $staffdisciplinary_case_preview->OffenseDate->viewAttributes() ?>><?php echo $staffdisciplinary_case_preview->OffenseDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($staffdisciplinary_case_preview->ActionDate->Visible) { // ActionDate ?>
		<!-- ActionDate -->
		<td<?php echo $staffdisciplinary_case_preview->ActionDate->cellAttributes() ?>>
<span<?php echo $staffdisciplinary_case_preview->ActionDate->viewAttributes() ?>><?php echo $staffdisciplinary_case_preview->ActionDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($staffdisciplinary_case_preview->DateOfAppealLetter->Visible) { // DateOfAppealLetter ?>
		<!-- DateOfAppealLetter -->
		<td<?php echo $staffdisciplinary_case_preview->DateOfAppealLetter->cellAttributes() ?>>
<span<?php echo $staffdisciplinary_case_preview->DateOfAppealLetter->viewAttributes() ?>><?php echo $staffdisciplinary_case_preview->DateOfAppealLetter->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($staffdisciplinary_case_preview->DateAppealReceived->Visible) { // DateAppealReceived ?>
		<!-- DateAppealReceived -->
		<td<?php echo $staffdisciplinary_case_preview->DateAppealReceived->cellAttributes() ?>>
<span<?php echo $staffdisciplinary_case_preview->DateAppealReceived->viewAttributes() ?>><?php echo $staffdisciplinary_case_preview->DateAppealReceived->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($staffdisciplinary_case_preview->DateConcluded->Visible) { // DateConcluded ?>
		<!-- DateConcluded -->
		<td<?php echo $staffdisciplinary_case_preview->DateConcluded->cellAttributes() ?>>
<span<?php echo $staffdisciplinary_case_preview->DateConcluded->viewAttributes() ?>><?php echo $staffdisciplinary_case_preview->DateConcluded->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($staffdisciplinary_case_preview->AppealStatus->Visible) { // AppealStatus ?>
		<!-- AppealStatus -->
		<td<?php echo $staffdisciplinary_case_preview->AppealStatus->cellAttributes() ?>>
<span<?php echo $staffdisciplinary_case_preview->AppealStatus->viewAttributes() ?>><?php echo $staffdisciplinary_case_preview->AppealStatus->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$staffdisciplinary_case_preview->ListOptions->render("body", "right", $staffdisciplinary_case_preview->RowCount);
?>
	</tr>
<?php
	$staffdisciplinary_case_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $staffdisciplinary_case_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($staffdisciplinary_case_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($staffdisciplinary_case_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$staffdisciplinary_case_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($staffdisciplinary_case_preview->Recordset)
	$staffdisciplinary_case_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$staffdisciplinary_case_preview->terminate();
?>