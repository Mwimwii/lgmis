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
$staffchildren_preview = new staffchildren_preview();

// Run the page
$staffchildren_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$staffchildren_preview->Page_Render();
?>
<?php $staffchildren_preview->showPageHeader(); ?>
<?php if ($staffchildren_preview->TotalRecords > 0) { ?>
<div class="card ew-grid staffchildren"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$staffchildren_preview->renderListOptions();

// Render list options (header, left)
$staffchildren_preview->ListOptions->render("header", "left");
?>
<?php if ($staffchildren_preview->FirstName->Visible) { // FirstName ?>
	<?php if ($staffchildren->SortUrl($staffchildren_preview->FirstName) == "") { ?>
		<th class="<?php echo $staffchildren_preview->FirstName->headerCellClass() ?>"><?php echo $staffchildren_preview->FirstName->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $staffchildren_preview->FirstName->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($staffchildren_preview->FirstName->Name) ?>" data-sort-order="<?php echo $staffchildren_preview->SortField == $staffchildren_preview->FirstName->Name && $staffchildren_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffchildren_preview->FirstName->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffchildren_preview->SortField == $staffchildren_preview->FirstName->Name) { ?><?php if ($staffchildren_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffchildren_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffchildren_preview->MiddleName->Visible) { // MiddleName ?>
	<?php if ($staffchildren->SortUrl($staffchildren_preview->MiddleName) == "") { ?>
		<th class="<?php echo $staffchildren_preview->MiddleName->headerCellClass() ?>"><?php echo $staffchildren_preview->MiddleName->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $staffchildren_preview->MiddleName->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($staffchildren_preview->MiddleName->Name) ?>" data-sort-order="<?php echo $staffchildren_preview->SortField == $staffchildren_preview->MiddleName->Name && $staffchildren_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffchildren_preview->MiddleName->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffchildren_preview->SortField == $staffchildren_preview->MiddleName->Name) { ?><?php if ($staffchildren_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffchildren_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffchildren_preview->Surname->Visible) { // Surname ?>
	<?php if ($staffchildren->SortUrl($staffchildren_preview->Surname) == "") { ?>
		<th class="<?php echo $staffchildren_preview->Surname->headerCellClass() ?>"><?php echo $staffchildren_preview->Surname->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $staffchildren_preview->Surname->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($staffchildren_preview->Surname->Name) ?>" data-sort-order="<?php echo $staffchildren_preview->SortField == $staffchildren_preview->Surname->Name && $staffchildren_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffchildren_preview->Surname->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffchildren_preview->SortField == $staffchildren_preview->Surname->Name) { ?><?php if ($staffchildren_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffchildren_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffchildren_preview->DateOfBirth->Visible) { // DateOfBirth ?>
	<?php if ($staffchildren->SortUrl($staffchildren_preview->DateOfBirth) == "") { ?>
		<th class="<?php echo $staffchildren_preview->DateOfBirth->headerCellClass() ?>"><?php echo $staffchildren_preview->DateOfBirth->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $staffchildren_preview->DateOfBirth->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($staffchildren_preview->DateOfBirth->Name) ?>" data-sort-order="<?php echo $staffchildren_preview->SortField == $staffchildren_preview->DateOfBirth->Name && $staffchildren_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffchildren_preview->DateOfBirth->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffchildren_preview->SortField == $staffchildren_preview->DateOfBirth->Name) { ?><?php if ($staffchildren_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffchildren_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffchildren_preview->Sex->Visible) { // Sex ?>
	<?php if ($staffchildren->SortUrl($staffchildren_preview->Sex) == "") { ?>
		<th class="<?php echo $staffchildren_preview->Sex->headerCellClass() ?>"><?php echo $staffchildren_preview->Sex->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $staffchildren_preview->Sex->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($staffchildren_preview->Sex->Name) ?>" data-sort-order="<?php echo $staffchildren_preview->SortField == $staffchildren_preview->Sex->Name && $staffchildren_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffchildren_preview->Sex->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffchildren_preview->SortField == $staffchildren_preview->Sex->Name) { ?><?php if ($staffchildren_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffchildren_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$staffchildren_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$staffchildren_preview->RecCount = 0;
$staffchildren_preview->RowCount = 0;
while ($staffchildren_preview->Recordset && !$staffchildren_preview->Recordset->EOF) {

	// Init row class and style
	$staffchildren_preview->RecCount++;
	$staffchildren_preview->RowCount++;
	$staffchildren_preview->CssStyle = "";
	$staffchildren_preview->loadListRowValues($staffchildren_preview->Recordset);

	// Render row
	$staffchildren->RowType = ROWTYPE_PREVIEW; // Preview record
	$staffchildren_preview->resetAttributes();
	$staffchildren_preview->renderListRow();

	// Render list options
	$staffchildren_preview->renderListOptions();
?>
	<tr <?php echo $staffchildren->rowAttributes() ?>>
<?php

// Render list options (body, left)
$staffchildren_preview->ListOptions->render("body", "left", $staffchildren_preview->RowCount);
?>
<?php if ($staffchildren_preview->FirstName->Visible) { // FirstName ?>
		<!-- FirstName -->
		<td<?php echo $staffchildren_preview->FirstName->cellAttributes() ?>>
<span<?php echo $staffchildren_preview->FirstName->viewAttributes() ?>><?php echo $staffchildren_preview->FirstName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($staffchildren_preview->MiddleName->Visible) { // MiddleName ?>
		<!-- MiddleName -->
		<td<?php echo $staffchildren_preview->MiddleName->cellAttributes() ?>>
<span<?php echo $staffchildren_preview->MiddleName->viewAttributes() ?>><?php echo $staffchildren_preview->MiddleName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($staffchildren_preview->Surname->Visible) { // Surname ?>
		<!-- Surname -->
		<td<?php echo $staffchildren_preview->Surname->cellAttributes() ?>>
<span<?php echo $staffchildren_preview->Surname->viewAttributes() ?>><?php echo $staffchildren_preview->Surname->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($staffchildren_preview->DateOfBirth->Visible) { // DateOfBirth ?>
		<!-- DateOfBirth -->
		<td<?php echo $staffchildren_preview->DateOfBirth->cellAttributes() ?>>
<span<?php echo $staffchildren_preview->DateOfBirth->viewAttributes() ?>><?php echo $staffchildren_preview->DateOfBirth->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($staffchildren_preview->Sex->Visible) { // Sex ?>
		<!-- Sex -->
		<td<?php echo $staffchildren_preview->Sex->cellAttributes() ?>>
<span<?php echo $staffchildren_preview->Sex->viewAttributes() ?>><?php echo $staffchildren_preview->Sex->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$staffchildren_preview->ListOptions->render("body", "right", $staffchildren_preview->RowCount);
?>
	</tr>
<?php
	$staffchildren_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $staffchildren_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($staffchildren_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($staffchildren_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$staffchildren_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($staffchildren_preview->Recordset)
	$staffchildren_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$staffchildren_preview->terminate();
?>