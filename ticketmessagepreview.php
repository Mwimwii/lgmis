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
$ticketmessage_preview = new ticketmessage_preview();

// Run the page
$ticketmessage_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ticketmessage_preview->Page_Render();
?>
<?php $ticketmessage_preview->showPageHeader(); ?>
<?php if ($ticketmessage_preview->TotalRecords > 0) { ?>
<div class="card ew-grid ticketmessage"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$ticketmessage_preview->renderListOptions();

// Render list options (header, left)
$ticketmessage_preview->ListOptions->render("header", "left");
?>
<?php if ($ticketmessage_preview->TicketNumber->Visible) { // TicketNumber ?>
	<?php if ($ticketmessage->SortUrl($ticketmessage_preview->TicketNumber) == "") { ?>
		<th class="<?php echo $ticketmessage_preview->TicketNumber->headerCellClass() ?>"><?php echo $ticketmessage_preview->TicketNumber->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $ticketmessage_preview->TicketNumber->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($ticketmessage_preview->TicketNumber->Name) ?>" data-sort-order="<?php echo $ticketmessage_preview->SortField == $ticketmessage_preview->TicketNumber->Name && $ticketmessage_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ticketmessage_preview->TicketNumber->caption() ?></span><span class="ew-table-header-sort"><?php if ($ticketmessage_preview->SortField == $ticketmessage_preview->TicketNumber->Name) { ?><?php if ($ticketmessage_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ticketmessage_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ticketmessage_preview->MessageNumber->Visible) { // MessageNumber ?>
	<?php if ($ticketmessage->SortUrl($ticketmessage_preview->MessageNumber) == "") { ?>
		<th class="<?php echo $ticketmessage_preview->MessageNumber->headerCellClass() ?>"><?php echo $ticketmessage_preview->MessageNumber->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $ticketmessage_preview->MessageNumber->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($ticketmessage_preview->MessageNumber->Name) ?>" data-sort-order="<?php echo $ticketmessage_preview->SortField == $ticketmessage_preview->MessageNumber->Name && $ticketmessage_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ticketmessage_preview->MessageNumber->caption() ?></span><span class="ew-table-header-sort"><?php if ($ticketmessage_preview->SortField == $ticketmessage_preview->MessageNumber->Name) { ?><?php if ($ticketmessage_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ticketmessage_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ticketmessage_preview->MessageBy->Visible) { // MessageBy ?>
	<?php if ($ticketmessage->SortUrl($ticketmessage_preview->MessageBy) == "") { ?>
		<th class="<?php echo $ticketmessage_preview->MessageBy->headerCellClass() ?>"><?php echo $ticketmessage_preview->MessageBy->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $ticketmessage_preview->MessageBy->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($ticketmessage_preview->MessageBy->Name) ?>" data-sort-order="<?php echo $ticketmessage_preview->SortField == $ticketmessage_preview->MessageBy->Name && $ticketmessage_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ticketmessage_preview->MessageBy->caption() ?></span><span class="ew-table-header-sort"><?php if ($ticketmessage_preview->SortField == $ticketmessage_preview->MessageBy->Name) { ?><?php if ($ticketmessage_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ticketmessage_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ticketmessage_preview->Subject->Visible) { // Subject ?>
	<?php if ($ticketmessage->SortUrl($ticketmessage_preview->Subject) == "") { ?>
		<th class="<?php echo $ticketmessage_preview->Subject->headerCellClass() ?>"><?php echo $ticketmessage_preview->Subject->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $ticketmessage_preview->Subject->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($ticketmessage_preview->Subject->Name) ?>" data-sort-order="<?php echo $ticketmessage_preview->SortField == $ticketmessage_preview->Subject->Name && $ticketmessage_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ticketmessage_preview->Subject->caption() ?></span><span class="ew-table-header-sort"><?php if ($ticketmessage_preview->SortField == $ticketmessage_preview->Subject->Name) { ?><?php if ($ticketmessage_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ticketmessage_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ticketmessage_preview->Message->Visible) { // Message ?>
	<?php if ($ticketmessage->SortUrl($ticketmessage_preview->Message) == "") { ?>
		<th class="<?php echo $ticketmessage_preview->Message->headerCellClass() ?>"><?php echo $ticketmessage_preview->Message->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $ticketmessage_preview->Message->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($ticketmessage_preview->Message->Name) ?>" data-sort-order="<?php echo $ticketmessage_preview->SortField == $ticketmessage_preview->Message->Name && $ticketmessage_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ticketmessage_preview->Message->caption() ?></span><span class="ew-table-header-sort"><?php if ($ticketmessage_preview->SortField == $ticketmessage_preview->Message->Name) { ?><?php if ($ticketmessage_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ticketmessage_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ticketmessage_preview->MessageDate->Visible) { // MessageDate ?>
	<?php if ($ticketmessage->SortUrl($ticketmessage_preview->MessageDate) == "") { ?>
		<th class="<?php echo $ticketmessage_preview->MessageDate->headerCellClass() ?>"><?php echo $ticketmessage_preview->MessageDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $ticketmessage_preview->MessageDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($ticketmessage_preview->MessageDate->Name) ?>" data-sort-order="<?php echo $ticketmessage_preview->SortField == $ticketmessage_preview->MessageDate->Name && $ticketmessage_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ticketmessage_preview->MessageDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($ticketmessage_preview->SortField == $ticketmessage_preview->MessageDate->Name) { ?><?php if ($ticketmessage_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ticketmessage_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$ticketmessage_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$ticketmessage_preview->RecCount = 0;
$ticketmessage_preview->RowCount = 0;
while ($ticketmessage_preview->Recordset && !$ticketmessage_preview->Recordset->EOF) {

	// Init row class and style
	$ticketmessage_preview->RecCount++;
	$ticketmessage_preview->RowCount++;
	$ticketmessage_preview->CssStyle = "";
	$ticketmessage_preview->loadListRowValues($ticketmessage_preview->Recordset);

	// Render row
	$ticketmessage->RowType = ROWTYPE_PREVIEW; // Preview record
	$ticketmessage_preview->resetAttributes();
	$ticketmessage_preview->renderListRow();

	// Render list options
	$ticketmessage_preview->renderListOptions();
?>
	<tr <?php echo $ticketmessage->rowAttributes() ?>>
<?php

// Render list options (body, left)
$ticketmessage_preview->ListOptions->render("body", "left", $ticketmessage_preview->RowCount);
?>
<?php if ($ticketmessage_preview->TicketNumber->Visible) { // TicketNumber ?>
		<!-- TicketNumber -->
		<td<?php echo $ticketmessage_preview->TicketNumber->cellAttributes() ?>>
<span<?php echo $ticketmessage_preview->TicketNumber->viewAttributes() ?>><?php echo $ticketmessage_preview->TicketNumber->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($ticketmessage_preview->MessageNumber->Visible) { // MessageNumber ?>
		<!-- MessageNumber -->
		<td<?php echo $ticketmessage_preview->MessageNumber->cellAttributes() ?>>
<span<?php echo $ticketmessage_preview->MessageNumber->viewAttributes() ?>><?php echo $ticketmessage_preview->MessageNumber->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($ticketmessage_preview->MessageBy->Visible) { // MessageBy ?>
		<!-- MessageBy -->
		<td<?php echo $ticketmessage_preview->MessageBy->cellAttributes() ?>>
<span<?php echo $ticketmessage_preview->MessageBy->viewAttributes() ?>><?php echo $ticketmessage_preview->MessageBy->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($ticketmessage_preview->Subject->Visible) { // Subject ?>
		<!-- Subject -->
		<td<?php echo $ticketmessage_preview->Subject->cellAttributes() ?>>
<span<?php echo $ticketmessage_preview->Subject->viewAttributes() ?>><?php echo $ticketmessage_preview->Subject->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($ticketmessage_preview->Message->Visible) { // Message ?>
		<!-- Message -->
		<td<?php echo $ticketmessage_preview->Message->cellAttributes() ?>>
<span<?php echo $ticketmessage_preview->Message->viewAttributes() ?>><?php echo $ticketmessage_preview->Message->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($ticketmessage_preview->MessageDate->Visible) { // MessageDate ?>
		<!-- MessageDate -->
		<td<?php echo $ticketmessage_preview->MessageDate->cellAttributes() ?>>
<span<?php echo $ticketmessage_preview->MessageDate->viewAttributes() ?>><?php echo $ticketmessage_preview->MessageDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$ticketmessage_preview->ListOptions->render("body", "right", $ticketmessage_preview->RowCount);
?>
	</tr>
<?php
	$ticketmessage_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $ticketmessage_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($ticketmessage_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($ticketmessage_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$ticketmessage_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($ticketmessage_preview->Recordset)
	$ticketmessage_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$ticketmessage_preview->terminate();
?>