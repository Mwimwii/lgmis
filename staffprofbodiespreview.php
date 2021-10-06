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
$staffprofbodies_preview = new staffprofbodies_preview();

// Run the page
$staffprofbodies_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$staffprofbodies_preview->Page_Render();
?>
<?php $staffprofbodies_preview->showPageHeader(); ?>
<?php if ($staffprofbodies_preview->TotalRecords > 0) { ?>
<div class="card ew-grid staffprofbodies"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$staffprofbodies_preview->renderListOptions();

// Render list options (header, left)
$staffprofbodies_preview->ListOptions->render("header", "left");
?>
<?php if ($staffprofbodies_preview->ProfessionalBody->Visible) { // ProfessionalBody ?>
	<?php if ($staffprofbodies->SortUrl($staffprofbodies_preview->ProfessionalBody) == "") { ?>
		<th class="<?php echo $staffprofbodies_preview->ProfessionalBody->headerCellClass() ?>"><?php echo $staffprofbodies_preview->ProfessionalBody->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $staffprofbodies_preview->ProfessionalBody->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($staffprofbodies_preview->ProfessionalBody->Name) ?>" data-sort-order="<?php echo $staffprofbodies_preview->SortField == $staffprofbodies_preview->ProfessionalBody->Name && $staffprofbodies_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffprofbodies_preview->ProfessionalBody->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffprofbodies_preview->SortField == $staffprofbodies_preview->ProfessionalBody->Name) { ?><?php if ($staffprofbodies_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffprofbodies_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffprofbodies_preview->MembershipNo->Visible) { // MembershipNo ?>
	<?php if ($staffprofbodies->SortUrl($staffprofbodies_preview->MembershipNo) == "") { ?>
		<th class="<?php echo $staffprofbodies_preview->MembershipNo->headerCellClass() ?>"><?php echo $staffprofbodies_preview->MembershipNo->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $staffprofbodies_preview->MembershipNo->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($staffprofbodies_preview->MembershipNo->Name) ?>" data-sort-order="<?php echo $staffprofbodies_preview->SortField == $staffprofbodies_preview->MembershipNo->Name && $staffprofbodies_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffprofbodies_preview->MembershipNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffprofbodies_preview->SortField == $staffprofbodies_preview->MembershipNo->Name) { ?><?php if ($staffprofbodies_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffprofbodies_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffprofbodies_preview->DateJoined->Visible) { // DateJoined ?>
	<?php if ($staffprofbodies->SortUrl($staffprofbodies_preview->DateJoined) == "") { ?>
		<th class="<?php echo $staffprofbodies_preview->DateJoined->headerCellClass() ?>"><?php echo $staffprofbodies_preview->DateJoined->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $staffprofbodies_preview->DateJoined->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($staffprofbodies_preview->DateJoined->Name) ?>" data-sort-order="<?php echo $staffprofbodies_preview->SortField == $staffprofbodies_preview->DateJoined->Name && $staffprofbodies_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffprofbodies_preview->DateJoined->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffprofbodies_preview->SortField == $staffprofbodies_preview->DateJoined->Name) { ?><?php if ($staffprofbodies_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffprofbodies_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffprofbodies_preview->DateRenewed->Visible) { // DateRenewed ?>
	<?php if ($staffprofbodies->SortUrl($staffprofbodies_preview->DateRenewed) == "") { ?>
		<th class="<?php echo $staffprofbodies_preview->DateRenewed->headerCellClass() ?>"><?php echo $staffprofbodies_preview->DateRenewed->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $staffprofbodies_preview->DateRenewed->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($staffprofbodies_preview->DateRenewed->Name) ?>" data-sort-order="<?php echo $staffprofbodies_preview->SortField == $staffprofbodies_preview->DateRenewed->Name && $staffprofbodies_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffprofbodies_preview->DateRenewed->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffprofbodies_preview->SortField == $staffprofbodies_preview->DateRenewed->Name) { ?><?php if ($staffprofbodies_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffprofbodies_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffprofbodies_preview->ValidTo->Visible) { // ValidTo ?>
	<?php if ($staffprofbodies->SortUrl($staffprofbodies_preview->ValidTo) == "") { ?>
		<th class="<?php echo $staffprofbodies_preview->ValidTo->headerCellClass() ?>"><?php echo $staffprofbodies_preview->ValidTo->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $staffprofbodies_preview->ValidTo->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($staffprofbodies_preview->ValidTo->Name) ?>" data-sort-order="<?php echo $staffprofbodies_preview->SortField == $staffprofbodies_preview->ValidTo->Name && $staffprofbodies_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffprofbodies_preview->ValidTo->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffprofbodies_preview->SortField == $staffprofbodies_preview->ValidTo->Name) { ?><?php if ($staffprofbodies_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffprofbodies_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffprofbodies_preview->MemberStatus->Visible) { // MemberStatus ?>
	<?php if ($staffprofbodies->SortUrl($staffprofbodies_preview->MemberStatus) == "") { ?>
		<th class="<?php echo $staffprofbodies_preview->MemberStatus->headerCellClass() ?>"><?php echo $staffprofbodies_preview->MemberStatus->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $staffprofbodies_preview->MemberStatus->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($staffprofbodies_preview->MemberStatus->Name) ?>" data-sort-order="<?php echo $staffprofbodies_preview->SortField == $staffprofbodies_preview->MemberStatus->Name && $staffprofbodies_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffprofbodies_preview->MemberStatus->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffprofbodies_preview->SortField == $staffprofbodies_preview->MemberStatus->Name) { ?><?php if ($staffprofbodies_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffprofbodies_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$staffprofbodies_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$staffprofbodies_preview->RecCount = 0;
$staffprofbodies_preview->RowCount = 0;
while ($staffprofbodies_preview->Recordset && !$staffprofbodies_preview->Recordset->EOF) {

	// Init row class and style
	$staffprofbodies_preview->RecCount++;
	$staffprofbodies_preview->RowCount++;
	$staffprofbodies_preview->CssStyle = "";
	$staffprofbodies_preview->loadListRowValues($staffprofbodies_preview->Recordset);

	// Render row
	$staffprofbodies->RowType = ROWTYPE_PREVIEW; // Preview record
	$staffprofbodies_preview->resetAttributes();
	$staffprofbodies_preview->renderListRow();

	// Render list options
	$staffprofbodies_preview->renderListOptions();
?>
	<tr <?php echo $staffprofbodies->rowAttributes() ?>>
<?php

// Render list options (body, left)
$staffprofbodies_preview->ListOptions->render("body", "left", $staffprofbodies_preview->RowCount);
?>
<?php if ($staffprofbodies_preview->ProfessionalBody->Visible) { // ProfessionalBody ?>
		<!-- ProfessionalBody -->
		<td<?php echo $staffprofbodies_preview->ProfessionalBody->cellAttributes() ?>>
<span<?php echo $staffprofbodies_preview->ProfessionalBody->viewAttributes() ?>><?php echo $staffprofbodies_preview->ProfessionalBody->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($staffprofbodies_preview->MembershipNo->Visible) { // MembershipNo ?>
		<!-- MembershipNo -->
		<td<?php echo $staffprofbodies_preview->MembershipNo->cellAttributes() ?>>
<span<?php echo $staffprofbodies_preview->MembershipNo->viewAttributes() ?>><?php echo $staffprofbodies_preview->MembershipNo->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($staffprofbodies_preview->DateJoined->Visible) { // DateJoined ?>
		<!-- DateJoined -->
		<td<?php echo $staffprofbodies_preview->DateJoined->cellAttributes() ?>>
<span<?php echo $staffprofbodies_preview->DateJoined->viewAttributes() ?>><?php echo $staffprofbodies_preview->DateJoined->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($staffprofbodies_preview->DateRenewed->Visible) { // DateRenewed ?>
		<!-- DateRenewed -->
		<td<?php echo $staffprofbodies_preview->DateRenewed->cellAttributes() ?>>
<span<?php echo $staffprofbodies_preview->DateRenewed->viewAttributes() ?>><?php echo $staffprofbodies_preview->DateRenewed->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($staffprofbodies_preview->ValidTo->Visible) { // ValidTo ?>
		<!-- ValidTo -->
		<td<?php echo $staffprofbodies_preview->ValidTo->cellAttributes() ?>>
<span<?php echo $staffprofbodies_preview->ValidTo->viewAttributes() ?>><?php echo $staffprofbodies_preview->ValidTo->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($staffprofbodies_preview->MemberStatus->Visible) { // MemberStatus ?>
		<!-- MemberStatus -->
		<td<?php echo $staffprofbodies_preview->MemberStatus->cellAttributes() ?>>
<span<?php echo $staffprofbodies_preview->MemberStatus->viewAttributes() ?>><?php echo $staffprofbodies_preview->MemberStatus->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$staffprofbodies_preview->ListOptions->render("body", "right", $staffprofbodies_preview->RowCount);
?>
	</tr>
<?php
	$staffprofbodies_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $staffprofbodies_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($staffprofbodies_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($staffprofbodies_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$staffprofbodies_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($staffprofbodies_preview->Recordset)
	$staffprofbodies_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$staffprofbodies_preview->terminate();
?>