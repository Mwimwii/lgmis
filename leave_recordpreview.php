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
$leave_record_preview = new leave_record_preview();

// Run the page
$leave_record_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$leave_record_preview->Page_Render();
?>
<?php $leave_record_preview->showPageHeader(); ?>
<?php if ($leave_record_preview->TotalRecords > 0) { ?>
<div class="card ew-grid leave_record"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$leave_record_preview->renderListOptions();

// Render list options (header, left)
$leave_record_preview->ListOptions->render("header", "left");
?>
<?php if ($leave_record_preview->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($leave_record->SortUrl($leave_record_preview->EmployeeID) == "") { ?>
		<th class="<?php echo $leave_record_preview->EmployeeID->headerCellClass() ?>"><?php echo $leave_record_preview->EmployeeID->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $leave_record_preview->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($leave_record_preview->EmployeeID->Name) ?>" data-sort-order="<?php echo $leave_record_preview->SortField == $leave_record_preview->EmployeeID->Name && $leave_record_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_record_preview->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($leave_record_preview->SortField == $leave_record_preview->EmployeeID->Name) { ?><?php if ($leave_record_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_record_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($leave_record_preview->LeaveTypeCode->Visible) { // LeaveTypeCode ?>
	<?php if ($leave_record->SortUrl($leave_record_preview->LeaveTypeCode) == "") { ?>
		<th class="<?php echo $leave_record_preview->LeaveTypeCode->headerCellClass() ?>"><?php echo $leave_record_preview->LeaveTypeCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $leave_record_preview->LeaveTypeCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($leave_record_preview->LeaveTypeCode->Name) ?>" data-sort-order="<?php echo $leave_record_preview->SortField == $leave_record_preview->LeaveTypeCode->Name && $leave_record_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_record_preview->LeaveTypeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($leave_record_preview->SortField == $leave_record_preview->LeaveTypeCode->Name) { ?><?php if ($leave_record_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_record_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($leave_record_preview->EffectiveDate->Visible) { // EffectiveDate ?>
	<?php if ($leave_record->SortUrl($leave_record_preview->EffectiveDate) == "") { ?>
		<th class="<?php echo $leave_record_preview->EffectiveDate->headerCellClass() ?>"><?php echo $leave_record_preview->EffectiveDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $leave_record_preview->EffectiveDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($leave_record_preview->EffectiveDate->Name) ?>" data-sort-order="<?php echo $leave_record_preview->SortField == $leave_record_preview->EffectiveDate->Name && $leave_record_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_record_preview->EffectiveDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($leave_record_preview->SortField == $leave_record_preview->EffectiveDate->Name) { ?><?php if ($leave_record_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_record_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($leave_record_preview->OpeningBalance->Visible) { // OpeningBalance ?>
	<?php if ($leave_record->SortUrl($leave_record_preview->OpeningBalance) == "") { ?>
		<th class="<?php echo $leave_record_preview->OpeningBalance->headerCellClass() ?>"><?php echo $leave_record_preview->OpeningBalance->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $leave_record_preview->OpeningBalance->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($leave_record_preview->OpeningBalance->Name) ?>" data-sort-order="<?php echo $leave_record_preview->SortField == $leave_record_preview->OpeningBalance->Name && $leave_record_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_record_preview->OpeningBalance->caption() ?></span><span class="ew-table-header-sort"><?php if ($leave_record_preview->SortField == $leave_record_preview->OpeningBalance->Name) { ?><?php if ($leave_record_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_record_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($leave_record_preview->LeaveAccrued->Visible) { // LeaveAccrued ?>
	<?php if ($leave_record->SortUrl($leave_record_preview->LeaveAccrued) == "") { ?>
		<th class="<?php echo $leave_record_preview->LeaveAccrued->headerCellClass() ?>"><?php echo $leave_record_preview->LeaveAccrued->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $leave_record_preview->LeaveAccrued->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($leave_record_preview->LeaveAccrued->Name) ?>" data-sort-order="<?php echo $leave_record_preview->SortField == $leave_record_preview->LeaveAccrued->Name && $leave_record_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_record_preview->LeaveAccrued->caption() ?></span><span class="ew-table-header-sort"><?php if ($leave_record_preview->SortField == $leave_record_preview->LeaveAccrued->Name) { ?><?php if ($leave_record_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_record_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($leave_record_preview->LastAccrualDate->Visible) { // LastAccrualDate ?>
	<?php if ($leave_record->SortUrl($leave_record_preview->LastAccrualDate) == "") { ?>
		<th class="<?php echo $leave_record_preview->LastAccrualDate->headerCellClass() ?>"><?php echo $leave_record_preview->LastAccrualDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $leave_record_preview->LastAccrualDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($leave_record_preview->LastAccrualDate->Name) ?>" data-sort-order="<?php echo $leave_record_preview->SortField == $leave_record_preview->LastAccrualDate->Name && $leave_record_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_record_preview->LastAccrualDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($leave_record_preview->SortField == $leave_record_preview->LastAccrualDate->Name) { ?><?php if ($leave_record_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_record_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($leave_record_preview->LeaveTaken->Visible) { // LeaveTaken ?>
	<?php if ($leave_record->SortUrl($leave_record_preview->LeaveTaken) == "") { ?>
		<th class="<?php echo $leave_record_preview->LeaveTaken->headerCellClass() ?>"><?php echo $leave_record_preview->LeaveTaken->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $leave_record_preview->LeaveTaken->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($leave_record_preview->LeaveTaken->Name) ?>" data-sort-order="<?php echo $leave_record_preview->SortField == $leave_record_preview->LeaveTaken->Name && $leave_record_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_record_preview->LeaveTaken->caption() ?></span><span class="ew-table-header-sort"><?php if ($leave_record_preview->SortField == $leave_record_preview->LeaveTaken->Name) { ?><?php if ($leave_record_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_record_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($leave_record_preview->LeaveCommuted->Visible) { // LeaveCommuted ?>
	<?php if ($leave_record->SortUrl($leave_record_preview->LeaveCommuted) == "") { ?>
		<th class="<?php echo $leave_record_preview->LeaveCommuted->headerCellClass() ?>"><?php echo $leave_record_preview->LeaveCommuted->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $leave_record_preview->LeaveCommuted->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($leave_record_preview->LeaveCommuted->Name) ?>" data-sort-order="<?php echo $leave_record_preview->SortField == $leave_record_preview->LeaveCommuted->Name && $leave_record_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_record_preview->LeaveCommuted->caption() ?></span><span class="ew-table-header-sort"><?php if ($leave_record_preview->SortField == $leave_record_preview->LeaveCommuted->Name) { ?><?php if ($leave_record_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_record_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$leave_record_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$leave_record_preview->RecCount = 0;
$leave_record_preview->RowCount = 0;
while ($leave_record_preview->Recordset && !$leave_record_preview->Recordset->EOF) {

	// Init row class and style
	$leave_record_preview->RecCount++;
	$leave_record_preview->RowCount++;
	$leave_record_preview->CssStyle = "";
	$leave_record_preview->loadListRowValues($leave_record_preview->Recordset);

	// Render row
	$leave_record->RowType = ROWTYPE_PREVIEW; // Preview record
	$leave_record_preview->resetAttributes();
	$leave_record_preview->renderListRow();

	// Render list options
	$leave_record_preview->renderListOptions();
?>
	<tr <?php echo $leave_record->rowAttributes() ?>>
<?php

// Render list options (body, left)
$leave_record_preview->ListOptions->render("body", "left", $leave_record_preview->RowCount);
?>
<?php if ($leave_record_preview->EmployeeID->Visible) { // EmployeeID ?>
		<!-- EmployeeID -->
		<td<?php echo $leave_record_preview->EmployeeID->cellAttributes() ?>>
<span<?php echo $leave_record_preview->EmployeeID->viewAttributes() ?>><?php echo $leave_record_preview->EmployeeID->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($leave_record_preview->LeaveTypeCode->Visible) { // LeaveTypeCode ?>
		<!-- LeaveTypeCode -->
		<td<?php echo $leave_record_preview->LeaveTypeCode->cellAttributes() ?>>
<span<?php echo $leave_record_preview->LeaveTypeCode->viewAttributes() ?>><?php echo $leave_record_preview->LeaveTypeCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($leave_record_preview->EffectiveDate->Visible) { // EffectiveDate ?>
		<!-- EffectiveDate -->
		<td<?php echo $leave_record_preview->EffectiveDate->cellAttributes() ?>>
<span<?php echo $leave_record_preview->EffectiveDate->viewAttributes() ?>><?php echo $leave_record_preview->EffectiveDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($leave_record_preview->OpeningBalance->Visible) { // OpeningBalance ?>
		<!-- OpeningBalance -->
		<td<?php echo $leave_record_preview->OpeningBalance->cellAttributes() ?>>
<span<?php echo $leave_record_preview->OpeningBalance->viewAttributes() ?>><?php echo $leave_record_preview->OpeningBalance->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($leave_record_preview->LeaveAccrued->Visible) { // LeaveAccrued ?>
		<!-- LeaveAccrued -->
		<td<?php echo $leave_record_preview->LeaveAccrued->cellAttributes() ?>>
<span<?php echo $leave_record_preview->LeaveAccrued->viewAttributes() ?>><?php echo $leave_record_preview->LeaveAccrued->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($leave_record_preview->LastAccrualDate->Visible) { // LastAccrualDate ?>
		<!-- LastAccrualDate -->
		<td<?php echo $leave_record_preview->LastAccrualDate->cellAttributes() ?>>
<span<?php echo $leave_record_preview->LastAccrualDate->viewAttributes() ?>><?php echo $leave_record_preview->LastAccrualDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($leave_record_preview->LeaveTaken->Visible) { // LeaveTaken ?>
		<!-- LeaveTaken -->
		<td<?php echo $leave_record_preview->LeaveTaken->cellAttributes() ?>>
<span<?php echo $leave_record_preview->LeaveTaken->viewAttributes() ?>><?php echo $leave_record_preview->LeaveTaken->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($leave_record_preview->LeaveCommuted->Visible) { // LeaveCommuted ?>
		<!-- LeaveCommuted -->
		<td<?php echo $leave_record_preview->LeaveCommuted->cellAttributes() ?>>
<span<?php echo $leave_record_preview->LeaveCommuted->viewAttributes() ?>><?php echo $leave_record_preview->LeaveCommuted->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$leave_record_preview->ListOptions->render("body", "right", $leave_record_preview->RowCount);
?>
	</tr>
<?php
	$leave_record_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $leave_record_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($leave_record_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($leave_record_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$leave_record_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($leave_record_preview->Recordset)
	$leave_record_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$leave_record_preview->terminate();
?>