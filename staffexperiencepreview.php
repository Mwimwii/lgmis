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
$staffexperience_preview = new staffexperience_preview();

// Run the page
$staffexperience_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$staffexperience_preview->Page_Render();
?>
<?php $staffexperience_preview->showPageHeader(); ?>
<?php if ($staffexperience_preview->TotalRecords > 0) { ?>
<div class="card ew-grid staffexperience"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$staffexperience_preview->renderListOptions();

// Render list options (header, left)
$staffexperience_preview->ListOptions->render("header", "left");
?>
<?php if ($staffexperience_preview->ProvinceCode->Visible) { // ProvinceCode ?>
	<?php if ($staffexperience->SortUrl($staffexperience_preview->ProvinceCode) == "") { ?>
		<th class="<?php echo $staffexperience_preview->ProvinceCode->headerCellClass() ?>"><?php echo $staffexperience_preview->ProvinceCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $staffexperience_preview->ProvinceCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($staffexperience_preview->ProvinceCode->Name) ?>" data-sort-order="<?php echo $staffexperience_preview->SortField == $staffexperience_preview->ProvinceCode->Name && $staffexperience_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffexperience_preview->ProvinceCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffexperience_preview->SortField == $staffexperience_preview->ProvinceCode->Name) { ?><?php if ($staffexperience_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffexperience_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffexperience_preview->LAcode->Visible) { // LAcode ?>
	<?php if ($staffexperience->SortUrl($staffexperience_preview->LAcode) == "") { ?>
		<th class="<?php echo $staffexperience_preview->LAcode->headerCellClass() ?>"><?php echo $staffexperience_preview->LAcode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $staffexperience_preview->LAcode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($staffexperience_preview->LAcode->Name) ?>" data-sort-order="<?php echo $staffexperience_preview->SortField == $staffexperience_preview->LAcode->Name && $staffexperience_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffexperience_preview->LAcode->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffexperience_preview->SortField == $staffexperience_preview->LAcode->Name) { ?><?php if ($staffexperience_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffexperience_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffexperience_preview->PositionCode->Visible) { // PositionCode ?>
	<?php if ($staffexperience->SortUrl($staffexperience_preview->PositionCode) == "") { ?>
		<th class="<?php echo $staffexperience_preview->PositionCode->headerCellClass() ?>"><?php echo $staffexperience_preview->PositionCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $staffexperience_preview->PositionCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($staffexperience_preview->PositionCode->Name) ?>" data-sort-order="<?php echo $staffexperience_preview->SortField == $staffexperience_preview->PositionCode->Name && $staffexperience_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffexperience_preview->PositionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffexperience_preview->SortField == $staffexperience_preview->PositionCode->Name) { ?><?php if ($staffexperience_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffexperience_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffexperience_preview->FromDate->Visible) { // FromDate ?>
	<?php if ($staffexperience->SortUrl($staffexperience_preview->FromDate) == "") { ?>
		<th class="<?php echo $staffexperience_preview->FromDate->headerCellClass() ?>"><?php echo $staffexperience_preview->FromDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $staffexperience_preview->FromDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($staffexperience_preview->FromDate->Name) ?>" data-sort-order="<?php echo $staffexperience_preview->SortField == $staffexperience_preview->FromDate->Name && $staffexperience_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffexperience_preview->FromDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffexperience_preview->SortField == $staffexperience_preview->FromDate->Name) { ?><?php if ($staffexperience_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffexperience_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffexperience_preview->ExitDate->Visible) { // ExitDate ?>
	<?php if ($staffexperience->SortUrl($staffexperience_preview->ExitDate) == "") { ?>
		<th class="<?php echo $staffexperience_preview->ExitDate->headerCellClass() ?>"><?php echo $staffexperience_preview->ExitDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $staffexperience_preview->ExitDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($staffexperience_preview->ExitDate->Name) ?>" data-sort-order="<?php echo $staffexperience_preview->SortField == $staffexperience_preview->ExitDate->Name && $staffexperience_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffexperience_preview->ExitDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffexperience_preview->SortField == $staffexperience_preview->ExitDate->Name) { ?><?php if ($staffexperience_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffexperience_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffexperience_preview->ReasonForExit->Visible) { // ReasonForExit ?>
	<?php if ($staffexperience->SortUrl($staffexperience_preview->ReasonForExit) == "") { ?>
		<th class="<?php echo $staffexperience_preview->ReasonForExit->headerCellClass() ?>"><?php echo $staffexperience_preview->ReasonForExit->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $staffexperience_preview->ReasonForExit->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($staffexperience_preview->ReasonForExit->Name) ?>" data-sort-order="<?php echo $staffexperience_preview->SortField == $staffexperience_preview->ReasonForExit->Name && $staffexperience_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffexperience_preview->ReasonForExit->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffexperience_preview->SortField == $staffexperience_preview->ReasonForExit->Name) { ?><?php if ($staffexperience_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffexperience_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffexperience_preview->RetirementType->Visible) { // RetirementType ?>
	<?php if ($staffexperience->SortUrl($staffexperience_preview->RetirementType) == "") { ?>
		<th class="<?php echo $staffexperience_preview->RetirementType->headerCellClass() ?>"><?php echo $staffexperience_preview->RetirementType->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $staffexperience_preview->RetirementType->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($staffexperience_preview->RetirementType->Name) ?>" data-sort-order="<?php echo $staffexperience_preview->SortField == $staffexperience_preview->RetirementType->Name && $staffexperience_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffexperience_preview->RetirementType->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffexperience_preview->SortField == $staffexperience_preview->RetirementType->Name) { ?><?php if ($staffexperience_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffexperience_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$staffexperience_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$staffexperience_preview->RecCount = 0;
$staffexperience_preview->RowCount = 0;
while ($staffexperience_preview->Recordset && !$staffexperience_preview->Recordset->EOF) {

	// Init row class and style
	$staffexperience_preview->RecCount++;
	$staffexperience_preview->RowCount++;
	$staffexperience_preview->CssStyle = "";
	$staffexperience_preview->loadListRowValues($staffexperience_preview->Recordset);

	// Render row
	$staffexperience->RowType = ROWTYPE_PREVIEW; // Preview record
	$staffexperience_preview->resetAttributes();
	$staffexperience_preview->renderListRow();

	// Render list options
	$staffexperience_preview->renderListOptions();
?>
	<tr <?php echo $staffexperience->rowAttributes() ?>>
<?php

// Render list options (body, left)
$staffexperience_preview->ListOptions->render("body", "left", $staffexperience_preview->RowCount);
?>
<?php if ($staffexperience_preview->ProvinceCode->Visible) { // ProvinceCode ?>
		<!-- ProvinceCode -->
		<td<?php echo $staffexperience_preview->ProvinceCode->cellAttributes() ?>>
<span<?php echo $staffexperience_preview->ProvinceCode->viewAttributes() ?>><?php echo $staffexperience_preview->ProvinceCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($staffexperience_preview->LAcode->Visible) { // LAcode ?>
		<!-- LAcode -->
		<td<?php echo $staffexperience_preview->LAcode->cellAttributes() ?>>
<span<?php echo $staffexperience_preview->LAcode->viewAttributes() ?>><?php echo $staffexperience_preview->LAcode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($staffexperience_preview->PositionCode->Visible) { // PositionCode ?>
		<!-- PositionCode -->
		<td<?php echo $staffexperience_preview->PositionCode->cellAttributes() ?>>
<span<?php echo $staffexperience_preview->PositionCode->viewAttributes() ?>><?php echo $staffexperience_preview->PositionCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($staffexperience_preview->FromDate->Visible) { // FromDate ?>
		<!-- FromDate -->
		<td<?php echo $staffexperience_preview->FromDate->cellAttributes() ?>>
<span<?php echo $staffexperience_preview->FromDate->viewAttributes() ?>><?php echo $staffexperience_preview->FromDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($staffexperience_preview->ExitDate->Visible) { // ExitDate ?>
		<!-- ExitDate -->
		<td<?php echo $staffexperience_preview->ExitDate->cellAttributes() ?>>
<span<?php echo $staffexperience_preview->ExitDate->viewAttributes() ?>><?php echo $staffexperience_preview->ExitDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($staffexperience_preview->ReasonForExit->Visible) { // ReasonForExit ?>
		<!-- ReasonForExit -->
		<td<?php echo $staffexperience_preview->ReasonForExit->cellAttributes() ?>>
<span<?php echo $staffexperience_preview->ReasonForExit->viewAttributes() ?>><?php echo $staffexperience_preview->ReasonForExit->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($staffexperience_preview->RetirementType->Visible) { // RetirementType ?>
		<!-- RetirementType -->
		<td<?php echo $staffexperience_preview->RetirementType->cellAttributes() ?>>
<span<?php echo $staffexperience_preview->RetirementType->viewAttributes() ?>><?php echo $staffexperience_preview->RetirementType->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$staffexperience_preview->ListOptions->render("body", "right", $staffexperience_preview->RowCount);
?>
	</tr>
<?php
	$staffexperience_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $staffexperience_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($staffexperience_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($staffexperience_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$staffexperience_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($staffexperience_preview->Recordset)
	$staffexperience_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$staffexperience_preview->terminate();
?>