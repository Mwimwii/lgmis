<?php
namespace PHPMaker2020\lgmis20;
?>
<?php if ($province->Visible) { ?>
<div id="t_province" class="card <?php echo ResponsiveTableClass() ?>ew-grid ew-list-form ew-master-div">
<table id="tbl_provincemaster" class="table ew-table ew-master-table ew-horizontal">
	<thead>
		<tr class="ew-table-header">
<?php if ($province->ProvinceCode->Visible) { // ProvinceCode ?>
			<th class="<?php echo $province->ProvinceCode->headerCellClass() ?>"><?php echo $province->ProvinceCode->caption() ?></th>
<?php } ?>
<?php if ($province->ProvinceName->Visible) { // ProvinceName ?>
			<th class="<?php echo $province->ProvinceName->headerCellClass() ?>"><?php echo $province->ProvinceName->caption() ?></th>
<?php } ?>
<?php if ($province->Comment->Visible) { // Comment ?>
			<th class="<?php echo $province->Comment->headerCellClass() ?>"><?php echo $province->Comment->caption() ?></th>
<?php } ?>
		</tr>
	</thead>
	<tbody>
		<tr>
<?php if ($province->ProvinceCode->Visible) { // ProvinceCode ?>
			<td <?php echo $province->ProvinceCode->cellAttributes() ?>>
<span id="el_province_ProvinceCode">
<span<?php echo $province->ProvinceCode->viewAttributes() ?>><?php echo $province->ProvinceCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($province->ProvinceName->Visible) { // ProvinceName ?>
			<td <?php echo $province->ProvinceName->cellAttributes() ?>>
<span id="el_province_ProvinceName">
<span<?php echo $province->ProvinceName->viewAttributes() ?>><?php echo $province->ProvinceName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($province->Comment->Visible) { // Comment ?>
			<td <?php echo $province->Comment->cellAttributes() ?>>
<span id="el_province_Comment">
<span<?php echo $province->Comment->viewAttributes() ?>><?php echo $province->Comment->getViewValue() ?></span>
</span>
</td>
<?php } ?>
		</tr>
	</tbody>
</table>
</div>
<?php } ?>