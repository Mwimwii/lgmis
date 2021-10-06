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
$la_sub_program_preview = new la_sub_program_preview();

// Run the page
$la_sub_program_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$la_sub_program_preview->Page_Render();
?>
<?php $la_sub_program_preview->showPageHeader(); ?>
<?php if ($la_sub_program_preview->TotalRecords > 0) { ?>
<div class="card ew-grid la_sub_program"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$la_sub_program_preview->renderListOptions();

// Render list options (header, left)
$la_sub_program_preview->ListOptions->render("header", "left");
?>
<?php if ($la_sub_program_preview->ProgramCode->Visible) { // ProgramCode ?>
	<?php if ($la_sub_program->SortUrl($la_sub_program_preview->ProgramCode) == "") { ?>
		<th class="<?php echo $la_sub_program_preview->ProgramCode->headerCellClass() ?>"><?php echo $la_sub_program_preview->ProgramCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $la_sub_program_preview->ProgramCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($la_sub_program_preview->ProgramCode->Name) ?>" data-sort-order="<?php echo $la_sub_program_preview->SortField == $la_sub_program_preview->ProgramCode->Name && $la_sub_program_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $la_sub_program_preview->ProgramCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($la_sub_program_preview->SortField == $la_sub_program_preview->ProgramCode->Name) { ?><?php if ($la_sub_program_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($la_sub_program_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($la_sub_program_preview->SubProgramCode->Visible) { // SubProgramCode ?>
	<?php if ($la_sub_program->SortUrl($la_sub_program_preview->SubProgramCode) == "") { ?>
		<th class="<?php echo $la_sub_program_preview->SubProgramCode->headerCellClass() ?>"><?php echo $la_sub_program_preview->SubProgramCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $la_sub_program_preview->SubProgramCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($la_sub_program_preview->SubProgramCode->Name) ?>" data-sort-order="<?php echo $la_sub_program_preview->SortField == $la_sub_program_preview->SubProgramCode->Name && $la_sub_program_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $la_sub_program_preview->SubProgramCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($la_sub_program_preview->SortField == $la_sub_program_preview->SubProgramCode->Name) { ?><?php if ($la_sub_program_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($la_sub_program_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($la_sub_program_preview->SubProgramName->Visible) { // SubProgramName ?>
	<?php if ($la_sub_program->SortUrl($la_sub_program_preview->SubProgramName) == "") { ?>
		<th class="<?php echo $la_sub_program_preview->SubProgramName->headerCellClass() ?>"><?php echo $la_sub_program_preview->SubProgramName->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $la_sub_program_preview->SubProgramName->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($la_sub_program_preview->SubProgramName->Name) ?>" data-sort-order="<?php echo $la_sub_program_preview->SortField == $la_sub_program_preview->SubProgramName->Name && $la_sub_program_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $la_sub_program_preview->SubProgramName->caption() ?></span><span class="ew-table-header-sort"><?php if ($la_sub_program_preview->SortField == $la_sub_program_preview->SubProgramName->Name) { ?><?php if ($la_sub_program_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($la_sub_program_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($la_sub_program_preview->SubProgramPurpose->Visible) { // SubProgramPurpose ?>
	<?php if ($la_sub_program->SortUrl($la_sub_program_preview->SubProgramPurpose) == "") { ?>
		<th class="<?php echo $la_sub_program_preview->SubProgramPurpose->headerCellClass() ?>"><?php echo $la_sub_program_preview->SubProgramPurpose->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $la_sub_program_preview->SubProgramPurpose->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($la_sub_program_preview->SubProgramPurpose->Name) ?>" data-sort-order="<?php echo $la_sub_program_preview->SortField == $la_sub_program_preview->SubProgramPurpose->Name && $la_sub_program_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $la_sub_program_preview->SubProgramPurpose->caption() ?></span><span class="ew-table-header-sort"><?php if ($la_sub_program_preview->SortField == $la_sub_program_preview->SubProgramPurpose->Name) { ?><?php if ($la_sub_program_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($la_sub_program_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$la_sub_program_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$la_sub_program_preview->RecCount = 0;
$la_sub_program_preview->RowCount = 0;
while ($la_sub_program_preview->Recordset && !$la_sub_program_preview->Recordset->EOF) {

	// Init row class and style
	$la_sub_program_preview->RecCount++;
	$la_sub_program_preview->RowCount++;
	$la_sub_program_preview->CssStyle = "";
	$la_sub_program_preview->loadListRowValues($la_sub_program_preview->Recordset);

	// Render row
	$la_sub_program->RowType = ROWTYPE_PREVIEW; // Preview record
	$la_sub_program_preview->resetAttributes();
	$la_sub_program_preview->renderListRow();

	// Render list options
	$la_sub_program_preview->renderListOptions();
?>
	<tr <?php echo $la_sub_program->rowAttributes() ?>>
<?php

// Render list options (body, left)
$la_sub_program_preview->ListOptions->render("body", "left", $la_sub_program_preview->RowCount);
?>
<?php if ($la_sub_program_preview->ProgramCode->Visible) { // ProgramCode ?>
		<!-- ProgramCode -->
		<td<?php echo $la_sub_program_preview->ProgramCode->cellAttributes() ?>>
<span<?php echo $la_sub_program_preview->ProgramCode->viewAttributes() ?>><?php echo $la_sub_program_preview->ProgramCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($la_sub_program_preview->SubProgramCode->Visible) { // SubProgramCode ?>
		<!-- SubProgramCode -->
		<td<?php echo $la_sub_program_preview->SubProgramCode->cellAttributes() ?>>
<span<?php echo $la_sub_program_preview->SubProgramCode->viewAttributes() ?>><?php echo $la_sub_program_preview->SubProgramCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($la_sub_program_preview->SubProgramName->Visible) { // SubProgramName ?>
		<!-- SubProgramName -->
		<td<?php echo $la_sub_program_preview->SubProgramName->cellAttributes() ?>>
<span<?php echo $la_sub_program_preview->SubProgramName->viewAttributes() ?>><?php echo $la_sub_program_preview->SubProgramName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($la_sub_program_preview->SubProgramPurpose->Visible) { // SubProgramPurpose ?>
		<!-- SubProgramPurpose -->
		<td<?php echo $la_sub_program_preview->SubProgramPurpose->cellAttributes() ?>>
<span<?php echo $la_sub_program_preview->SubProgramPurpose->viewAttributes() ?>><?php echo $la_sub_program_preview->SubProgramPurpose->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$la_sub_program_preview->ListOptions->render("body", "right", $la_sub_program_preview->RowCount);
?>
	</tr>
<?php
	$la_sub_program_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $la_sub_program_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($la_sub_program_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($la_sub_program_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$la_sub_program_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($la_sub_program_preview->Recordset)
	$la_sub_program_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$la_sub_program_preview->terminate();
?>