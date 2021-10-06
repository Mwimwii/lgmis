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
$leave_taken_preview = new leave_taken_preview();

// Run the page
$leave_taken_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$leave_taken_preview->Page_Render();
?>
<?php $leave_taken_preview->showPageHeader(); ?>
<?php if ($leave_taken_preview->TotalRecords > 0) { ?>
<div class="card ew-grid leave_taken"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$leave_taken_preview->renderListOptions();

// Render list options (header, left)
$leave_taken_preview->ListOptions->render("header", "left");
?>
<?php if ($leave_taken_preview->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($leave_taken->SortUrl($leave_taken_preview->EmployeeID) == "") { ?>
		<th class="<?php echo $leave_taken_preview->EmployeeID->headerCellClass() ?>"><?php echo $leave_taken_preview->EmployeeID->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $leave_taken_preview->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($leave_taken_preview->EmployeeID->Name) ?>" data-sort-order="<?php echo $leave_taken_preview->SortField == $leave_taken_preview->EmployeeID->Name && $leave_taken_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_taken_preview->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($leave_taken_preview->SortField == $leave_taken_preview->EmployeeID->Name) { ?><?php if ($leave_taken_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_taken_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($leave_taken_preview->LeaveTypeCode->Visible) { // LeaveTypeCode ?>
	<?php if ($leave_taken->SortUrl($leave_taken_preview->LeaveTypeCode) == "") { ?>
		<th class="<?php echo $leave_taken_preview->LeaveTypeCode->headerCellClass() ?>"><?php echo $leave_taken_preview->LeaveTypeCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $leave_taken_preview->LeaveTypeCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($leave_taken_preview->LeaveTypeCode->Name) ?>" data-sort-order="<?php echo $leave_taken_preview->SortField == $leave_taken_preview->LeaveTypeCode->Name && $leave_taken_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_taken_preview->LeaveTypeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($leave_taken_preview->SortField == $leave_taken_preview->LeaveTypeCode->Name) { ?><?php if ($leave_taken_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_taken_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($leave_taken_preview->StartDate->Visible) { // StartDate ?>
	<?php if ($leave_taken->SortUrl($leave_taken_preview->StartDate) == "") { ?>
		<th class="<?php echo $leave_taken_preview->StartDate->headerCellClass() ?>"><?php echo $leave_taken_preview->StartDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $leave_taken_preview->StartDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($leave_taken_preview->StartDate->Name) ?>" data-sort-order="<?php echo $leave_taken_preview->SortField == $leave_taken_preview->StartDate->Name && $leave_taken_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_taken_preview->StartDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($leave_taken_preview->SortField == $leave_taken_preview->StartDate->Name) { ?><?php if ($leave_taken_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_taken_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($leave_taken_preview->EndDate->Visible) { // EndDate ?>
	<?php if ($leave_taken->SortUrl($leave_taken_preview->EndDate) == "") { ?>
		<th class="<?php echo $leave_taken_preview->EndDate->headerCellClass() ?>"><?php echo $leave_taken_preview->EndDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $leave_taken_preview->EndDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($leave_taken_preview->EndDate->Name) ?>" data-sort-order="<?php echo $leave_taken_preview->SortField == $leave_taken_preview->EndDate->Name && $leave_taken_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_taken_preview->EndDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($leave_taken_preview->SortField == $leave_taken_preview->EndDate->Name) { ?><?php if ($leave_taken_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_taken_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($leave_taken_preview->Commuted->Visible) { // Commuted ?>
	<?php if ($leave_taken->SortUrl($leave_taken_preview->Commuted) == "") { ?>
		<th class="<?php echo $leave_taken_preview->Commuted->headerCellClass() ?>"><?php echo $leave_taken_preview->Commuted->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $leave_taken_preview->Commuted->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($leave_taken_preview->Commuted->Name) ?>" data-sort-order="<?php echo $leave_taken_preview->SortField == $leave_taken_preview->Commuted->Name && $leave_taken_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_taken_preview->Commuted->caption() ?></span><span class="ew-table-header-sort"><?php if ($leave_taken_preview->SortField == $leave_taken_preview->Commuted->Name) { ?><?php if ($leave_taken_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_taken_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($leave_taken_preview->LeaveDays->Visible) { // LeaveDays ?>
	<?php if ($leave_taken->SortUrl($leave_taken_preview->LeaveDays) == "") { ?>
		<th class="<?php echo $leave_taken_preview->LeaveDays->headerCellClass() ?>"><?php echo $leave_taken_preview->LeaveDays->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $leave_taken_preview->LeaveDays->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($leave_taken_preview->LeaveDays->Name) ?>" data-sort-order="<?php echo $leave_taken_preview->SortField == $leave_taken_preview->LeaveDays->Name && $leave_taken_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_taken_preview->LeaveDays->caption() ?></span><span class="ew-table-header-sort"><?php if ($leave_taken_preview->SortField == $leave_taken_preview->LeaveDays->Name) { ?><?php if ($leave_taken_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_taken_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($leave_taken_preview->Location->Visible) { // Location ?>
	<?php if ($leave_taken->SortUrl($leave_taken_preview->Location) == "") { ?>
		<th class="<?php echo $leave_taken_preview->Location->headerCellClass() ?>"><?php echo $leave_taken_preview->Location->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $leave_taken_preview->Location->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($leave_taken_preview->Location->Name) ?>" data-sort-order="<?php echo $leave_taken_preview->SortField == $leave_taken_preview->Location->Name && $leave_taken_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_taken_preview->Location->caption() ?></span><span class="ew-table-header-sort"><?php if ($leave_taken_preview->SortField == $leave_taken_preview->Location->Name) { ?><?php if ($leave_taken_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_taken_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($leave_taken_preview->Remarks->Visible) { // Remarks ?>
	<?php if ($leave_taken->SortUrl($leave_taken_preview->Remarks) == "") { ?>
		<th class="<?php echo $leave_taken_preview->Remarks->headerCellClass() ?>"><?php echo $leave_taken_preview->Remarks->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $leave_taken_preview->Remarks->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($leave_taken_preview->Remarks->Name) ?>" data-sort-order="<?php echo $leave_taken_preview->SortField == $leave_taken_preview->Remarks->Name && $leave_taken_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_taken_preview->Remarks->caption() ?></span><span class="ew-table-header-sort"><?php if ($leave_taken_preview->SortField == $leave_taken_preview->Remarks->Name) { ?><?php if ($leave_taken_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_taken_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$leave_taken_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$leave_taken_preview->RecCount = 0;
$leave_taken_preview->RowCount = 0;
while ($leave_taken_preview->Recordset && !$leave_taken_preview->Recordset->EOF) {

	// Init row class and style
	$leave_taken_preview->RecCount++;
	$leave_taken_preview->RowCount++;
	$leave_taken_preview->CssStyle = "";
	$leave_taken_preview->loadListRowValues($leave_taken_preview->Recordset);

	// Render row
	$leave_taken->RowType = ROWTYPE_PREVIEW; // Preview record
	$leave_taken_preview->resetAttributes();
	$leave_taken_preview->renderListRow();

	// Render list options
	$leave_taken_preview->renderListOptions();
?>
	<tr <?php echo $leave_taken->rowAttributes() ?>>
<?php

// Render list options (body, left)
$leave_taken_preview->ListOptions->render("body", "left", $leave_taken_preview->RowCount);
?>
<?php if ($leave_taken_preview->EmployeeID->Visible) { // EmployeeID ?>
		<!-- EmployeeID -->
		<td<?php echo $leave_taken_preview->EmployeeID->cellAttributes() ?>>
<span<?php echo $leave_taken_preview->EmployeeID->viewAttributes() ?>><?php echo $leave_taken_preview->EmployeeID->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($leave_taken_preview->LeaveTypeCode->Visible) { // LeaveTypeCode ?>
		<!-- LeaveTypeCode -->
		<td<?php echo $leave_taken_preview->LeaveTypeCode->cellAttributes() ?>>
<span<?php echo $leave_taken_preview->LeaveTypeCode->viewAttributes() ?>><?php echo $leave_taken_preview->LeaveTypeCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($leave_taken_preview->StartDate->Visible) { // StartDate ?>
		<!-- StartDate -->
		<td<?php echo $leave_taken_preview->StartDate->cellAttributes() ?>>
<span<?php echo $leave_taken_preview->StartDate->viewAttributes() ?>><?php echo $leave_taken_preview->StartDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($leave_taken_preview->EndDate->Visible) { // EndDate ?>
		<!-- EndDate -->
		<td<?php echo $leave_taken_preview->EndDate->cellAttributes() ?>>
<span<?php echo $leave_taken_preview->EndDate->viewAttributes() ?>><?php echo $leave_taken_preview->EndDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($leave_taken_preview->Commuted->Visible) { // Commuted ?>
		<!-- Commuted -->
		<td<?php echo $leave_taken_preview->Commuted->cellAttributes() ?>>
<span<?php echo $leave_taken_preview->Commuted->viewAttributes() ?>><?php echo $leave_taken_preview->Commuted->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($leave_taken_preview->LeaveDays->Visible) { // LeaveDays ?>
		<!-- LeaveDays -->
		<td<?php echo $leave_taken_preview->LeaveDays->cellAttributes() ?>>
<span<?php echo $leave_taken_preview->LeaveDays->viewAttributes() ?>><?php echo $leave_taken_preview->LeaveDays->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($leave_taken_preview->Location->Visible) { // Location ?>
		<!-- Location -->
		<td<?php echo $leave_taken_preview->Location->cellAttributes() ?>>
<span<?php echo $leave_taken_preview->Location->viewAttributes() ?>><?php echo $leave_taken_preview->Location->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($leave_taken_preview->Remarks->Visible) { // Remarks ?>
		<!-- Remarks -->
		<td<?php echo $leave_taken_preview->Remarks->cellAttributes() ?>>
<span<?php echo $leave_taken_preview->Remarks->viewAttributes() ?>><?php echo $leave_taken_preview->Remarks->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$leave_taken_preview->ListOptions->render("body", "right", $leave_taken_preview->RowCount);
?>
	</tr>
<?php
	$leave_taken_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $leave_taken_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($leave_taken_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($leave_taken_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$leave_taken_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($leave_taken_preview->Recordset)
	$leave_taken_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$leave_taken_preview->terminate();
?>