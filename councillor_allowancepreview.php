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
$councillor_allowance_preview = new councillor_allowance_preview();

// Run the page
$councillor_allowance_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$councillor_allowance_preview->Page_Render();
?>
<?php $councillor_allowance_preview->showPageHeader(); ?>
<?php if ($councillor_allowance_preview->TotalRecords > 0) { ?>
<div class="card ew-grid councillor_allowance"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$councillor_allowance_preview->renderListOptions();

// Render list options (header, left)
$councillor_allowance_preview->ListOptions->render("header", "left");
?>
<?php if ($councillor_allowance_preview->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($councillor_allowance->SortUrl($councillor_allowance_preview->EmployeeID) == "") { ?>
		<th class="<?php echo $councillor_allowance_preview->EmployeeID->headerCellClass() ?>"><?php echo $councillor_allowance_preview->EmployeeID->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $councillor_allowance_preview->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($councillor_allowance_preview->EmployeeID->Name) ?>" data-sort-order="<?php echo $councillor_allowance_preview->SortField == $councillor_allowance_preview->EmployeeID->Name && $councillor_allowance_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $councillor_allowance_preview->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($councillor_allowance_preview->SortField == $councillor_allowance_preview->EmployeeID->Name) { ?><?php if ($councillor_allowance_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($councillor_allowance_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($councillor_allowance_preview->AllowanceCode->Visible) { // AllowanceCode ?>
	<?php if ($councillor_allowance->SortUrl($councillor_allowance_preview->AllowanceCode) == "") { ?>
		<th class="<?php echo $councillor_allowance_preview->AllowanceCode->headerCellClass() ?>"><?php echo $councillor_allowance_preview->AllowanceCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $councillor_allowance_preview->AllowanceCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($councillor_allowance_preview->AllowanceCode->Name) ?>" data-sort-order="<?php echo $councillor_allowance_preview->SortField == $councillor_allowance_preview->AllowanceCode->Name && $councillor_allowance_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $councillor_allowance_preview->AllowanceCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($councillor_allowance_preview->SortField == $councillor_allowance_preview->AllowanceCode->Name) { ?><?php if ($councillor_allowance_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($councillor_allowance_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($councillor_allowance_preview->AllowanceAmount->Visible) { // AllowanceAmount ?>
	<?php if ($councillor_allowance->SortUrl($councillor_allowance_preview->AllowanceAmount) == "") { ?>
		<th class="<?php echo $councillor_allowance_preview->AllowanceAmount->headerCellClass() ?>"><?php echo $councillor_allowance_preview->AllowanceAmount->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $councillor_allowance_preview->AllowanceAmount->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($councillor_allowance_preview->AllowanceAmount->Name) ?>" data-sort-order="<?php echo $councillor_allowance_preview->SortField == $councillor_allowance_preview->AllowanceAmount->Name && $councillor_allowance_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $councillor_allowance_preview->AllowanceAmount->caption() ?></span><span class="ew-table-header-sort"><?php if ($councillor_allowance_preview->SortField == $councillor_allowance_preview->AllowanceAmount->Name) { ?><?php if ($councillor_allowance_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($councillor_allowance_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$councillor_allowance_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$councillor_allowance_preview->RecCount = 0;
$councillor_allowance_preview->RowCount = 0;
while ($councillor_allowance_preview->Recordset && !$councillor_allowance_preview->Recordset->EOF) {

	// Init row class and style
	$councillor_allowance_preview->RecCount++;
	$councillor_allowance_preview->RowCount++;
	$councillor_allowance_preview->CssStyle = "";
	$councillor_allowance_preview->loadListRowValues($councillor_allowance_preview->Recordset);

	// Render row
	$councillor_allowance->RowType = ROWTYPE_PREVIEW; // Preview record
	$councillor_allowance_preview->resetAttributes();
	$councillor_allowance_preview->renderListRow();

	// Render list options
	$councillor_allowance_preview->renderListOptions();
?>
	<tr <?php echo $councillor_allowance->rowAttributes() ?>>
<?php

// Render list options (body, left)
$councillor_allowance_preview->ListOptions->render("body", "left", $councillor_allowance_preview->RowCount);
?>
<?php if ($councillor_allowance_preview->EmployeeID->Visible) { // EmployeeID ?>
		<!-- EmployeeID -->
		<td<?php echo $councillor_allowance_preview->EmployeeID->cellAttributes() ?>>
<span<?php echo $councillor_allowance_preview->EmployeeID->viewAttributes() ?>><?php echo $councillor_allowance_preview->EmployeeID->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($councillor_allowance_preview->AllowanceCode->Visible) { // AllowanceCode ?>
		<!-- AllowanceCode -->
		<td<?php echo $councillor_allowance_preview->AllowanceCode->cellAttributes() ?>>
<span<?php echo $councillor_allowance_preview->AllowanceCode->viewAttributes() ?>><?php echo $councillor_allowance_preview->AllowanceCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($councillor_allowance_preview->AllowanceAmount->Visible) { // AllowanceAmount ?>
		<!-- AllowanceAmount -->
		<td<?php echo $councillor_allowance_preview->AllowanceAmount->cellAttributes() ?>>
<span<?php echo $councillor_allowance_preview->AllowanceAmount->viewAttributes() ?>><?php echo $councillor_allowance_preview->AllowanceAmount->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$councillor_allowance_preview->ListOptions->render("body", "right", $councillor_allowance_preview->RowCount);
?>
	</tr>
<?php
	$councillor_allowance_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $councillor_allowance_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($councillor_allowance_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($councillor_allowance_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$councillor_allowance_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($councillor_allowance_preview->Recordset)
	$councillor_allowance_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$councillor_allowance_preview->terminate();
?>