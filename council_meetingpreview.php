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
$council_meeting_preview = new council_meeting_preview();

// Run the page
$council_meeting_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$council_meeting_preview->Page_Render();
?>
<?php $council_meeting_preview->showPageHeader(); ?>
<?php if ($council_meeting_preview->TotalRecords > 0) { ?>
<div class="card ew-grid council_meeting"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$council_meeting_preview->renderListOptions();

// Render list options (header, left)
$council_meeting_preview->ListOptions->render("header", "left");
?>
<?php if ($council_meeting_preview->MeetingNo->Visible) { // MeetingNo ?>
	<?php if ($council_meeting->SortUrl($council_meeting_preview->MeetingNo) == "") { ?>
		<th class="<?php echo $council_meeting_preview->MeetingNo->headerCellClass() ?>"><?php echo $council_meeting_preview->MeetingNo->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $council_meeting_preview->MeetingNo->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($council_meeting_preview->MeetingNo->Name) ?>" data-sort-order="<?php echo $council_meeting_preview->SortField == $council_meeting_preview->MeetingNo->Name && $council_meeting_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $council_meeting_preview->MeetingNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($council_meeting_preview->SortField == $council_meeting_preview->MeetingNo->Name) { ?><?php if ($council_meeting_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($council_meeting_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($council_meeting_preview->MeetingRef->Visible) { // MeetingRef ?>
	<?php if ($council_meeting->SortUrl($council_meeting_preview->MeetingRef) == "") { ?>
		<th class="<?php echo $council_meeting_preview->MeetingRef->headerCellClass() ?>"><?php echo $council_meeting_preview->MeetingRef->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $council_meeting_preview->MeetingRef->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($council_meeting_preview->MeetingRef->Name) ?>" data-sort-order="<?php echo $council_meeting_preview->SortField == $council_meeting_preview->MeetingRef->Name && $council_meeting_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $council_meeting_preview->MeetingRef->caption() ?></span><span class="ew-table-header-sort"><?php if ($council_meeting_preview->SortField == $council_meeting_preview->MeetingRef->Name) { ?><?php if ($council_meeting_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($council_meeting_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($council_meeting_preview->MeetingType->Visible) { // MeetingType ?>
	<?php if ($council_meeting->SortUrl($council_meeting_preview->MeetingType) == "") { ?>
		<th class="<?php echo $council_meeting_preview->MeetingType->headerCellClass() ?>"><?php echo $council_meeting_preview->MeetingType->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $council_meeting_preview->MeetingType->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($council_meeting_preview->MeetingType->Name) ?>" data-sort-order="<?php echo $council_meeting_preview->SortField == $council_meeting_preview->MeetingType->Name && $council_meeting_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $council_meeting_preview->MeetingType->caption() ?></span><span class="ew-table-header-sort"><?php if ($council_meeting_preview->SortField == $council_meeting_preview->MeetingType->Name) { ?><?php if ($council_meeting_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($council_meeting_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($council_meeting_preview->LACode->Visible) { // LACode ?>
	<?php if ($council_meeting->SortUrl($council_meeting_preview->LACode) == "") { ?>
		<th class="<?php echo $council_meeting_preview->LACode->headerCellClass() ?>"><?php echo $council_meeting_preview->LACode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $council_meeting_preview->LACode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($council_meeting_preview->LACode->Name) ?>" data-sort-order="<?php echo $council_meeting_preview->SortField == $council_meeting_preview->LACode->Name && $council_meeting_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $council_meeting_preview->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($council_meeting_preview->SortField == $council_meeting_preview->LACode->Name) { ?><?php if ($council_meeting_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($council_meeting_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($council_meeting_preview->PlannedDate->Visible) { // PlannedDate ?>
	<?php if ($council_meeting->SortUrl($council_meeting_preview->PlannedDate) == "") { ?>
		<th class="<?php echo $council_meeting_preview->PlannedDate->headerCellClass() ?>"><?php echo $council_meeting_preview->PlannedDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $council_meeting_preview->PlannedDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($council_meeting_preview->PlannedDate->Name) ?>" data-sort-order="<?php echo $council_meeting_preview->SortField == $council_meeting_preview->PlannedDate->Name && $council_meeting_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $council_meeting_preview->PlannedDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($council_meeting_preview->SortField == $council_meeting_preview->PlannedDate->Name) { ?><?php if ($council_meeting_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($council_meeting_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($council_meeting_preview->ActualDate->Visible) { // ActualDate ?>
	<?php if ($council_meeting->SortUrl($council_meeting_preview->ActualDate) == "") { ?>
		<th class="<?php echo $council_meeting_preview->ActualDate->headerCellClass() ?>"><?php echo $council_meeting_preview->ActualDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $council_meeting_preview->ActualDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($council_meeting_preview->ActualDate->Name) ?>" data-sort-order="<?php echo $council_meeting_preview->SortField == $council_meeting_preview->ActualDate->Name && $council_meeting_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $council_meeting_preview->ActualDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($council_meeting_preview->SortField == $council_meeting_preview->ActualDate->Name) { ?><?php if ($council_meeting_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($council_meeting_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($council_meeting_preview->Attendance->Visible) { // Attendance ?>
	<?php if ($council_meeting->SortUrl($council_meeting_preview->Attendance) == "") { ?>
		<th class="<?php echo $council_meeting_preview->Attendance->headerCellClass() ?>"><?php echo $council_meeting_preview->Attendance->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $council_meeting_preview->Attendance->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($council_meeting_preview->Attendance->Name) ?>" data-sort-order="<?php echo $council_meeting_preview->SortField == $council_meeting_preview->Attendance->Name && $council_meeting_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $council_meeting_preview->Attendance->caption() ?></span><span class="ew-table-header-sort"><?php if ($council_meeting_preview->SortField == $council_meeting_preview->Attendance->Name) { ?><?php if ($council_meeting_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($council_meeting_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($council_meeting_preview->ChairedBy->Visible) { // ChairedBy ?>
	<?php if ($council_meeting->SortUrl($council_meeting_preview->ChairedBy) == "") { ?>
		<th class="<?php echo $council_meeting_preview->ChairedBy->headerCellClass() ?>"><?php echo $council_meeting_preview->ChairedBy->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $council_meeting_preview->ChairedBy->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($council_meeting_preview->ChairedBy->Name) ?>" data-sort-order="<?php echo $council_meeting_preview->SortField == $council_meeting_preview->ChairedBy->Name && $council_meeting_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $council_meeting_preview->ChairedBy->caption() ?></span><span class="ew-table-header-sort"><?php if ($council_meeting_preview->SortField == $council_meeting_preview->ChairedBy->Name) { ?><?php if ($council_meeting_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($council_meeting_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$council_meeting_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$council_meeting_preview->RecCount = 0;
$council_meeting_preview->RowCount = 0;
while ($council_meeting_preview->Recordset && !$council_meeting_preview->Recordset->EOF) {

	// Init row class and style
	$council_meeting_preview->RecCount++;
	$council_meeting_preview->RowCount++;
	$council_meeting_preview->CssStyle = "";
	$council_meeting_preview->loadListRowValues($council_meeting_preview->Recordset);

	// Render row
	$council_meeting->RowType = ROWTYPE_PREVIEW; // Preview record
	$council_meeting_preview->resetAttributes();
	$council_meeting_preview->renderListRow();

	// Render list options
	$council_meeting_preview->renderListOptions();
?>
	<tr <?php echo $council_meeting->rowAttributes() ?>>
<?php

// Render list options (body, left)
$council_meeting_preview->ListOptions->render("body", "left", $council_meeting_preview->RowCount);
?>
<?php if ($council_meeting_preview->MeetingNo->Visible) { // MeetingNo ?>
		<!-- MeetingNo -->
		<td<?php echo $council_meeting_preview->MeetingNo->cellAttributes() ?>>
<span<?php echo $council_meeting_preview->MeetingNo->viewAttributes() ?>><?php echo $council_meeting_preview->MeetingNo->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($council_meeting_preview->MeetingRef->Visible) { // MeetingRef ?>
		<!-- MeetingRef -->
		<td<?php echo $council_meeting_preview->MeetingRef->cellAttributes() ?>>
<span<?php echo $council_meeting_preview->MeetingRef->viewAttributes() ?>><?php echo $council_meeting_preview->MeetingRef->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($council_meeting_preview->MeetingType->Visible) { // MeetingType ?>
		<!-- MeetingType -->
		<td<?php echo $council_meeting_preview->MeetingType->cellAttributes() ?>>
<span<?php echo $council_meeting_preview->MeetingType->viewAttributes() ?>><?php echo $council_meeting_preview->MeetingType->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($council_meeting_preview->LACode->Visible) { // LACode ?>
		<!-- LACode -->
		<td<?php echo $council_meeting_preview->LACode->cellAttributes() ?>>
<span<?php echo $council_meeting_preview->LACode->viewAttributes() ?>><?php echo $council_meeting_preview->LACode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($council_meeting_preview->PlannedDate->Visible) { // PlannedDate ?>
		<!-- PlannedDate -->
		<td<?php echo $council_meeting_preview->PlannedDate->cellAttributes() ?>>
<span<?php echo $council_meeting_preview->PlannedDate->viewAttributes() ?>><?php echo $council_meeting_preview->PlannedDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($council_meeting_preview->ActualDate->Visible) { // ActualDate ?>
		<!-- ActualDate -->
		<td<?php echo $council_meeting_preview->ActualDate->cellAttributes() ?>>
<span<?php echo $council_meeting_preview->ActualDate->viewAttributes() ?>><?php echo $council_meeting_preview->ActualDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($council_meeting_preview->Attendance->Visible) { // Attendance ?>
		<!-- Attendance -->
		<td<?php echo $council_meeting_preview->Attendance->cellAttributes() ?>>
<span<?php echo $council_meeting_preview->Attendance->viewAttributes() ?>><?php echo $council_meeting_preview->Attendance->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($council_meeting_preview->ChairedBy->Visible) { // ChairedBy ?>
		<!-- ChairedBy -->
		<td<?php echo $council_meeting_preview->ChairedBy->cellAttributes() ?>>
<span<?php echo $council_meeting_preview->ChairedBy->viewAttributes() ?>><?php echo $council_meeting_preview->ChairedBy->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$council_meeting_preview->ListOptions->render("body", "right", $council_meeting_preview->RowCount);
?>
	</tr>
<?php
	$council_meeting_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $council_meeting_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($council_meeting_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($council_meeting_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$council_meeting_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($council_meeting_preview->Recordset)
	$council_meeting_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$council_meeting_preview->terminate();
?>