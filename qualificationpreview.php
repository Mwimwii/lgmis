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
$qualification_preview = new qualification_preview();

// Run the page
$qualification_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$qualification_preview->Page_Render();
?>
<?php $qualification_preview->showPageHeader(); ?>
<?php if ($qualification_preview->TotalRecords > 0) { ?>
<div class="card ew-grid qualification"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$qualification_preview->renderListOptions();

// Render list options (header, left)
$qualification_preview->ListOptions->render("header", "left");
?>
<?php if ($qualification_preview->QualificationCode->Visible) { // QualificationCode ?>
	<?php if ($qualification->SortUrl($qualification_preview->QualificationCode) == "") { ?>
		<th class="<?php echo $qualification_preview->QualificationCode->headerCellClass() ?>"><?php echo $qualification_preview->QualificationCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $qualification_preview->QualificationCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($qualification_preview->QualificationCode->Name) ?>" data-sort-order="<?php echo $qualification_preview->SortField == $qualification_preview->QualificationCode->Name && $qualification_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $qualification_preview->QualificationCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($qualification_preview->SortField == $qualification_preview->QualificationCode->Name) { ?><?php if ($qualification_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($qualification_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($qualification_preview->QualificationName->Visible) { // QualificationName ?>
	<?php if ($qualification->SortUrl($qualification_preview->QualificationName) == "") { ?>
		<th class="<?php echo $qualification_preview->QualificationName->headerCellClass() ?>"><?php echo $qualification_preview->QualificationName->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $qualification_preview->QualificationName->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($qualification_preview->QualificationName->Name) ?>" data-sort-order="<?php echo $qualification_preview->SortField == $qualification_preview->QualificationName->Name && $qualification_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $qualification_preview->QualificationName->caption() ?></span><span class="ew-table-header-sort"><?php if ($qualification_preview->SortField == $qualification_preview->QualificationName->Name) { ?><?php if ($qualification_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($qualification_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($qualification_preview->QualificationType->Visible) { // QualificationType ?>
	<?php if ($qualification->SortUrl($qualification_preview->QualificationType) == "") { ?>
		<th class="<?php echo $qualification_preview->QualificationType->headerCellClass() ?>"><?php echo $qualification_preview->QualificationType->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $qualification_preview->QualificationType->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($qualification_preview->QualificationType->Name) ?>" data-sort-order="<?php echo $qualification_preview->SortField == $qualification_preview->QualificationType->Name && $qualification_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $qualification_preview->QualificationType->caption() ?></span><span class="ew-table-header-sort"><?php if ($qualification_preview->SortField == $qualification_preview->QualificationType->Name) { ?><?php if ($qualification_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($qualification_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$qualification_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$qualification_preview->RecCount = 0;
$qualification_preview->RowCount = 0;
while ($qualification_preview->Recordset && !$qualification_preview->Recordset->EOF) {

	// Init row class and style
	$qualification_preview->RecCount++;
	$qualification_preview->RowCount++;
	$qualification_preview->CssStyle = "";
	$qualification_preview->loadListRowValues($qualification_preview->Recordset);

	// Render row
	$qualification->RowType = ROWTYPE_PREVIEW; // Preview record
	$qualification_preview->resetAttributes();
	$qualification_preview->renderListRow();

	// Render list options
	$qualification_preview->renderListOptions();
?>
	<tr <?php echo $qualification->rowAttributes() ?>>
<?php

// Render list options (body, left)
$qualification_preview->ListOptions->render("body", "left", $qualification_preview->RowCount);
?>
<?php if ($qualification_preview->QualificationCode->Visible) { // QualificationCode ?>
		<!-- QualificationCode -->
		<td<?php echo $qualification_preview->QualificationCode->cellAttributes() ?>>
<span<?php echo $qualification_preview->QualificationCode->viewAttributes() ?>><?php echo $qualification_preview->QualificationCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($qualification_preview->QualificationName->Visible) { // QualificationName ?>
		<!-- QualificationName -->
		<td<?php echo $qualification_preview->QualificationName->cellAttributes() ?>>
<span<?php echo $qualification_preview->QualificationName->viewAttributes() ?>><?php echo $qualification_preview->QualificationName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($qualification_preview->QualificationType->Visible) { // QualificationType ?>
		<!-- QualificationType -->
		<td<?php echo $qualification_preview->QualificationType->cellAttributes() ?>>
<span<?php echo $qualification_preview->QualificationType->viewAttributes() ?>><?php echo $qualification_preview->QualificationType->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$qualification_preview->ListOptions->render("body", "right", $qualification_preview->RowCount);
?>
	</tr>
<?php
	$qualification_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $qualification_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($qualification_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($qualification_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$qualification_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($qualification_preview->Recordset)
	$qualification_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$qualification_preview->terminate();
?>