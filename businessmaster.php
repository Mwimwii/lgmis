<?php
namespace PHPMaker2020\lgmis20;
?>
<?php if ($business->Visible) { ?>
<div id="t_business" class="card <?php echo ResponsiveTableClass() ?>ew-grid ew-list-form ew-master-div">
<table id="tbl_businessmaster" class="table ew-table ew-master-table ew-horizontal">
	<thead>
		<tr class="ew-table-header">
<?php if ($business->BusinessID->Visible) { // BusinessID ?>
			<th class="<?php echo $business->BusinessID->headerCellClass() ?>"><?php echo $business->BusinessID->caption() ?></th>
<?php } ?>
<?php if ($business->PACRANo->Visible) { // PACRANo ?>
			<th class="<?php echo $business->PACRANo->headerCellClass() ?>"><?php echo $business->PACRANo->caption() ?></th>
<?php } ?>
<?php if ($business->TPIN->Visible) { // TPIN ?>
			<th class="<?php echo $business->TPIN->headerCellClass() ?>"><?php echo $business->TPIN->caption() ?></th>
<?php } ?>
<?php if ($business->BusinessName->Visible) { // BusinessName ?>
			<th class="<?php echo $business->BusinessName->headerCellClass() ?>"><?php echo $business->BusinessName->caption() ?></th>
<?php } ?>
<?php if ($business->ClientID->Visible) { // ClientID ?>
			<th class="<?php echo $business->ClientID->headerCellClass() ?>"><?php echo $business->ClientID->caption() ?></th>
<?php } ?>
<?php if ($business->BusinessSector->Visible) { // BusinessSector ?>
			<th class="<?php echo $business->BusinessSector->headerCellClass() ?>"><?php echo $business->BusinessSector->caption() ?></th>
<?php } ?>
<?php if ($business->BusinessType->Visible) { // BusinessType ?>
			<th class="<?php echo $business->BusinessType->headerCellClass() ?>"><?php echo $business->BusinessType->caption() ?></th>
<?php } ?>
<?php if ($business->Location->Visible) { // Location ?>
			<th class="<?php echo $business->Location->headerCellClass() ?>"><?php echo $business->Location->caption() ?></th>
<?php } ?>
<?php if ($business->Turnover->Visible) { // Turnover ?>
			<th class="<?php echo $business->Turnover->headerCellClass() ?>"><?php echo $business->Turnover->caption() ?></th>
<?php } ?>
<?php if ($business->Branches->Visible) { // Branches ?>
			<th class="<?php echo $business->Branches->headerCellClass() ?>"><?php echo $business->Branches->caption() ?></th>
<?php } ?>
<?php if ($business->NewImprovements->Visible) { // NewImprovements ?>
			<th class="<?php echo $business->NewImprovements->headerCellClass() ?>"><?php echo $business->NewImprovements->caption() ?></th>
<?php } ?>
<?php if ($business->Longitude->Visible) { // Longitude ?>
			<th class="<?php echo $business->Longitude->headerCellClass() ?>"><?php echo $business->Longitude->caption() ?></th>
<?php } ?>
<?php if ($business->Latitude->Visible) { // Latitude ?>
			<th class="<?php echo $business->Latitude->headerCellClass() ?>"><?php echo $business->Latitude->caption() ?></th>
<?php } ?>
<?php if ($business->DateOpened->Visible) { // DateOpened ?>
			<th class="<?php echo $business->DateOpened->headerCellClass() ?>"><?php echo $business->DateOpened->caption() ?></th>
<?php } ?>
<?php if ($business->BusinessDesc->Visible) { // BusinessDesc ?>
			<th class="<?php echo $business->BusinessDesc->headerCellClass() ?>"><?php echo $business->BusinessDesc->caption() ?></th>
<?php } ?>
<?php if ($business->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
			<th class="<?php echo $business->LastUpdatedBy->headerCellClass() ?>"><?php echo $business->LastUpdatedBy->caption() ?></th>
<?php } ?>
<?php if ($business->LastUpdateDate->Visible) { // LastUpdateDate ?>
			<th class="<?php echo $business->LastUpdateDate->headerCellClass() ?>"><?php echo $business->LastUpdateDate->caption() ?></th>
<?php } ?>
		</tr>
	</thead>
	<tbody>
		<tr>
<?php if ($business->BusinessID->Visible) { // BusinessID ?>
			<td <?php echo $business->BusinessID->cellAttributes() ?>>
<span id="el_business_BusinessID">
<span<?php echo $business->BusinessID->viewAttributes() ?>><?php echo $business->BusinessID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($business->PACRANo->Visible) { // PACRANo ?>
			<td <?php echo $business->PACRANo->cellAttributes() ?>>
<span id="el_business_PACRANo">
<span<?php echo $business->PACRANo->viewAttributes() ?>><?php echo $business->PACRANo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($business->TPIN->Visible) { // TPIN ?>
			<td <?php echo $business->TPIN->cellAttributes() ?>>
<span id="el_business_TPIN">
<span<?php echo $business->TPIN->viewAttributes() ?>><?php echo $business->TPIN->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($business->BusinessName->Visible) { // BusinessName ?>
			<td <?php echo $business->BusinessName->cellAttributes() ?>>
<span id="el_business_BusinessName">
<span<?php echo $business->BusinessName->viewAttributes() ?>><?php echo $business->BusinessName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($business->ClientID->Visible) { // ClientID ?>
			<td <?php echo $business->ClientID->cellAttributes() ?>>
<span id="el_business_ClientID">
<span<?php echo $business->ClientID->viewAttributes() ?>><?php echo $business->ClientID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($business->BusinessSector->Visible) { // BusinessSector ?>
			<td <?php echo $business->BusinessSector->cellAttributes() ?>>
<span id="el_business_BusinessSector">
<span<?php echo $business->BusinessSector->viewAttributes() ?>><?php echo $business->BusinessSector->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($business->BusinessType->Visible) { // BusinessType ?>
			<td <?php echo $business->BusinessType->cellAttributes() ?>>
<span id="el_business_BusinessType">
<span<?php echo $business->BusinessType->viewAttributes() ?>><?php echo $business->BusinessType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($business->Location->Visible) { // Location ?>
			<td <?php echo $business->Location->cellAttributes() ?>>
<span id="el_business_Location">
<span<?php echo $business->Location->viewAttributes() ?>><?php echo $business->Location->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($business->Turnover->Visible) { // Turnover ?>
			<td <?php echo $business->Turnover->cellAttributes() ?>>
<span id="el_business_Turnover">
<span<?php echo $business->Turnover->viewAttributes() ?>><?php echo $business->Turnover->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($business->Branches->Visible) { // Branches ?>
			<td <?php echo $business->Branches->cellAttributes() ?>>
<span id="el_business_Branches">
<span<?php echo $business->Branches->viewAttributes() ?>><?php echo $business->Branches->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($business->NewImprovements->Visible) { // NewImprovements ?>
			<td <?php echo $business->NewImprovements->cellAttributes() ?>>
<span id="el_business_NewImprovements">
<span<?php echo $business->NewImprovements->viewAttributes() ?>><?php echo $business->NewImprovements->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($business->Longitude->Visible) { // Longitude ?>
			<td <?php echo $business->Longitude->cellAttributes() ?>>
<span id="el_business_Longitude">
<span<?php echo $business->Longitude->viewAttributes() ?>><?php echo $business->Longitude->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($business->Latitude->Visible) { // Latitude ?>
			<td <?php echo $business->Latitude->cellAttributes() ?>>
<span id="el_business_Latitude">
<span<?php echo $business->Latitude->viewAttributes() ?>><?php echo $business->Latitude->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($business->DateOpened->Visible) { // DateOpened ?>
			<td <?php echo $business->DateOpened->cellAttributes() ?>>
<span id="el_business_DateOpened">
<span<?php echo $business->DateOpened->viewAttributes() ?>><?php echo $business->DateOpened->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($business->BusinessDesc->Visible) { // BusinessDesc ?>
			<td <?php echo $business->BusinessDesc->cellAttributes() ?>>
<span id="el_business_BusinessDesc">
<span<?php echo $business->BusinessDesc->viewAttributes() ?>><?php echo $business->BusinessDesc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($business->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
			<td <?php echo $business->LastUpdatedBy->cellAttributes() ?>>
<span id="el_business_LastUpdatedBy">
<span<?php echo $business->LastUpdatedBy->viewAttributes() ?>><?php echo $business->LastUpdatedBy->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($business->LastUpdateDate->Visible) { // LastUpdateDate ?>
			<td <?php echo $business->LastUpdateDate->cellAttributes() ?>>
<span id="el_business_LastUpdateDate">
<span<?php echo $business->LastUpdateDate->viewAttributes() ?>><?php echo $business->LastUpdateDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
		</tr>
	</tbody>
</table>
</div>
<?php } ?>