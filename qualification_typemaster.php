<?php
namespace PHPMaker2020\lgmis20;
?>
<?php if ($qualification_type->Visible) { ?>
<div id="t_qualification_type" class="card <?php echo ResponsiveTableClass() ?>ew-grid ew-list-form ew-master-div">
<table id="tbl_qualification_typemaster" class="table ew-table ew-master-table ew-horizontal">
	<thead>
		<tr class="ew-table-header">
<?php if ($qualification_type->QualificationType->Visible) { // QualificationType ?>
			<th class="<?php echo $qualification_type->QualificationType->headerCellClass() ?>"><?php echo $qualification_type->QualificationType->caption() ?></th>
<?php } ?>
<?php if ($qualification_type->QualificationTYpeName->Visible) { // QualificationTYpeName ?>
			<th class="<?php echo $qualification_type->QualificationTYpeName->headerCellClass() ?>"><?php echo $qualification_type->QualificationTYpeName->caption() ?></th>
<?php } ?>
		</tr>
	</thead>
	<tbody>
		<tr>
<?php if ($qualification_type->QualificationType->Visible) { // QualificationType ?>
			<td <?php echo $qualification_type->QualificationType->cellAttributes() ?>>
<span id="el_qualification_type_QualificationType">
<span<?php echo $qualification_type->QualificationType->viewAttributes() ?>><?php echo $qualification_type->QualificationType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($qualification_type->QualificationTYpeName->Visible) { // QualificationTYpeName ?>
			<td <?php echo $qualification_type->QualificationTYpeName->cellAttributes() ?>>
<span id="el_qualification_type_QualificationTYpeName">
<span<?php echo $qualification_type->QualificationTYpeName->viewAttributes() ?>><?php echo $qualification_type->QualificationTYpeName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
		</tr>
	</tbody>
</table>
</div>
<?php } ?>