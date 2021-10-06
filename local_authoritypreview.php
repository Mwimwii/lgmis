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
$local_authority_preview = new local_authority_preview();

// Run the page
$local_authority_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$local_authority_preview->Page_Render();
?>
<?php $local_authority_preview->showPageHeader(); ?>
<?php if ($local_authority_preview->TotalRecords > 0) { ?>
<div class="card ew-grid local_authority"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$local_authority_preview->renderListOptions();

// Render list options (header, left)
$local_authority_preview->ListOptions->render("header", "left");
?>
<?php if ($local_authority_preview->LAName->Visible) { // LAName ?>
	<?php if ($local_authority->SortUrl($local_authority_preview->LAName) == "") { ?>
		<th class="<?php echo $local_authority_preview->LAName->headerCellClass() ?>"><?php echo $local_authority_preview->LAName->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $local_authority_preview->LAName->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($local_authority_preview->LAName->Name) ?>" data-sort-order="<?php echo $local_authority_preview->SortField == $local_authority_preview->LAName->Name && $local_authority_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $local_authority_preview->LAName->caption() ?></span><span class="ew-table-header-sort"><?php if ($local_authority_preview->SortField == $local_authority_preview->LAName->Name) { ?><?php if ($local_authority_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($local_authority_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($local_authority_preview->CouncilType->Visible) { // CouncilType ?>
	<?php if ($local_authority->SortUrl($local_authority_preview->CouncilType) == "") { ?>
		<th class="<?php echo $local_authority_preview->CouncilType->headerCellClass() ?>"><?php echo $local_authority_preview->CouncilType->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $local_authority_preview->CouncilType->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($local_authority_preview->CouncilType->Name) ?>" data-sort-order="<?php echo $local_authority_preview->SortField == $local_authority_preview->CouncilType->Name && $local_authority_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $local_authority_preview->CouncilType->caption() ?></span><span class="ew-table-header-sort"><?php if ($local_authority_preview->SortField == $local_authority_preview->CouncilType->Name) { ?><?php if ($local_authority_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($local_authority_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($local_authority_preview->ProvinceCode->Visible) { // ProvinceCode ?>
	<?php if ($local_authority->SortUrl($local_authority_preview->ProvinceCode) == "") { ?>
		<th class="<?php echo $local_authority_preview->ProvinceCode->headerCellClass() ?>"><?php echo $local_authority_preview->ProvinceCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $local_authority_preview->ProvinceCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($local_authority_preview->ProvinceCode->Name) ?>" data-sort-order="<?php echo $local_authority_preview->SortField == $local_authority_preview->ProvinceCode->Name && $local_authority_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $local_authority_preview->ProvinceCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($local_authority_preview->SortField == $local_authority_preview->ProvinceCode->Name) { ?><?php if ($local_authority_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($local_authority_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($local_authority_preview->Clients->Visible) { // Clients ?>
	<?php if ($local_authority->SortUrl($local_authority_preview->Clients) == "") { ?>
		<th class="<?php echo $local_authority_preview->Clients->headerCellClass() ?>"><?php echo $local_authority_preview->Clients->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $local_authority_preview->Clients->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($local_authority_preview->Clients->Name) ?>" data-sort-order="<?php echo $local_authority_preview->SortField == $local_authority_preview->Clients->Name && $local_authority_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $local_authority_preview->Clients->caption() ?></span><span class="ew-table-header-sort"><?php if ($local_authority_preview->SortField == $local_authority_preview->Clients->Name) { ?><?php if ($local_authority_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($local_authority_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($local_authority_preview->Beneficiaries->Visible) { // Beneficiaries ?>
	<?php if ($local_authority->SortUrl($local_authority_preview->Beneficiaries) == "") { ?>
		<th class="<?php echo $local_authority_preview->Beneficiaries->headerCellClass() ?>"><?php echo $local_authority_preview->Beneficiaries->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $local_authority_preview->Beneficiaries->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($local_authority_preview->Beneficiaries->Name) ?>" data-sort-order="<?php echo $local_authority_preview->SortField == $local_authority_preview->Beneficiaries->Name && $local_authority_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $local_authority_preview->Beneficiaries->caption() ?></span><span class="ew-table-header-sort"><?php if ($local_authority_preview->SortField == $local_authority_preview->Beneficiaries->Name) { ?><?php if ($local_authority_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($local_authority_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($local_authority_preview->ExecutiveAuthority->Visible) { // ExecutiveAuthority ?>
	<?php if ($local_authority->SortUrl($local_authority_preview->ExecutiveAuthority) == "") { ?>
		<th class="<?php echo $local_authority_preview->ExecutiveAuthority->headerCellClass() ?>"><?php echo $local_authority_preview->ExecutiveAuthority->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $local_authority_preview->ExecutiveAuthority->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($local_authority_preview->ExecutiveAuthority->Name) ?>" data-sort-order="<?php echo $local_authority_preview->SortField == $local_authority_preview->ExecutiveAuthority->Name && $local_authority_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $local_authority_preview->ExecutiveAuthority->caption() ?></span><span class="ew-table-header-sort"><?php if ($local_authority_preview->SortField == $local_authority_preview->ExecutiveAuthority->Name) { ?><?php if ($local_authority_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($local_authority_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($local_authority_preview->ControllingOfficer->Visible) { // ControllingOfficer ?>
	<?php if ($local_authority->SortUrl($local_authority_preview->ControllingOfficer) == "") { ?>
		<th class="<?php echo $local_authority_preview->ControllingOfficer->headerCellClass() ?>"><?php echo $local_authority_preview->ControllingOfficer->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $local_authority_preview->ControllingOfficer->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($local_authority_preview->ControllingOfficer->Name) ?>" data-sort-order="<?php echo $local_authority_preview->SortField == $local_authority_preview->ControllingOfficer->Name && $local_authority_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $local_authority_preview->ControllingOfficer->caption() ?></span><span class="ew-table-header-sort"><?php if ($local_authority_preview->SortField == $local_authority_preview->ControllingOfficer->Name) { ?><?php if ($local_authority_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($local_authority_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($local_authority_preview->Comment->Visible) { // Comment ?>
	<?php if ($local_authority->SortUrl($local_authority_preview->Comment) == "") { ?>
		<th class="<?php echo $local_authority_preview->Comment->headerCellClass() ?>"><?php echo $local_authority_preview->Comment->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $local_authority_preview->Comment->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($local_authority_preview->Comment->Name) ?>" data-sort-order="<?php echo $local_authority_preview->SortField == $local_authority_preview->Comment->Name && $local_authority_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $local_authority_preview->Comment->caption() ?></span><span class="ew-table-header-sort"><?php if ($local_authority_preview->SortField == $local_authority_preview->Comment->Name) { ?><?php if ($local_authority_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($local_authority_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$local_authority_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$local_authority_preview->RecCount = 0;
$local_authority_preview->RowCount = 0;
while ($local_authority_preview->Recordset && !$local_authority_preview->Recordset->EOF) {

	// Init row class and style
	$local_authority_preview->RecCount++;
	$local_authority_preview->RowCount++;
	$local_authority_preview->CssStyle = "";
	$local_authority_preview->loadListRowValues($local_authority_preview->Recordset);

	// Render row
	$local_authority->RowType = ROWTYPE_PREVIEW; // Preview record
	$local_authority_preview->resetAttributes();
	$local_authority_preview->renderListRow();

	// Render list options
	$local_authority_preview->renderListOptions();
?>
	<tr <?php echo $local_authority->rowAttributes() ?>>
<?php

// Render list options (body, left)
$local_authority_preview->ListOptions->render("body", "left", $local_authority_preview->RowCount);
?>
<?php if ($local_authority_preview->LAName->Visible) { // LAName ?>
		<!-- LAName -->
		<td<?php echo $local_authority_preview->LAName->cellAttributes() ?>>
<span<?php echo $local_authority_preview->LAName->viewAttributes() ?>><?php echo $local_authority_preview->LAName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($local_authority_preview->CouncilType->Visible) { // CouncilType ?>
		<!-- CouncilType -->
		<td<?php echo $local_authority_preview->CouncilType->cellAttributes() ?>>
<span<?php echo $local_authority_preview->CouncilType->viewAttributes() ?>><?php echo $local_authority_preview->CouncilType->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($local_authority_preview->ProvinceCode->Visible) { // ProvinceCode ?>
		<!-- ProvinceCode -->
		<td<?php echo $local_authority_preview->ProvinceCode->cellAttributes() ?>>
<span<?php echo $local_authority_preview->ProvinceCode->viewAttributes() ?>><?php echo $local_authority_preview->ProvinceCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($local_authority_preview->Clients->Visible) { // Clients ?>
		<!-- Clients -->
		<td<?php echo $local_authority_preview->Clients->cellAttributes() ?>>
<span<?php echo $local_authority_preview->Clients->viewAttributes() ?>><?php echo $local_authority_preview->Clients->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($local_authority_preview->Beneficiaries->Visible) { // Beneficiaries ?>
		<!-- Beneficiaries -->
		<td<?php echo $local_authority_preview->Beneficiaries->cellAttributes() ?>>
<span<?php echo $local_authority_preview->Beneficiaries->viewAttributes() ?>><?php echo $local_authority_preview->Beneficiaries->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($local_authority_preview->ExecutiveAuthority->Visible) { // ExecutiveAuthority ?>
		<!-- ExecutiveAuthority -->
		<td<?php echo $local_authority_preview->ExecutiveAuthority->cellAttributes() ?>>
<span<?php echo $local_authority_preview->ExecutiveAuthority->viewAttributes() ?>><?php echo $local_authority_preview->ExecutiveAuthority->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($local_authority_preview->ControllingOfficer->Visible) { // ControllingOfficer ?>
		<!-- ControllingOfficer -->
		<td<?php echo $local_authority_preview->ControllingOfficer->cellAttributes() ?>>
<span<?php echo $local_authority_preview->ControllingOfficer->viewAttributes() ?>><?php echo $local_authority_preview->ControllingOfficer->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($local_authority_preview->Comment->Visible) { // Comment ?>
		<!-- Comment -->
		<td<?php echo $local_authority_preview->Comment->cellAttributes() ?>>
<span<?php echo $local_authority_preview->Comment->viewAttributes() ?>><?php echo $local_authority_preview->Comment->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$local_authority_preview->ListOptions->render("body", "right", $local_authority_preview->RowCount);
?>
	</tr>
<?php
	$local_authority_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $local_authority_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($local_authority_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($local_authority_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$local_authority_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($local_authority_preview->Recordset)
	$local_authority_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$local_authority_preview->terminate();
?>