<?php
namespace PHPMaker2020\lgmis20;
?>
<?php if ($account_type->Visible) { ?>
<div id="t_account_type" class="card <?php echo ResponsiveTableClass() ?>ew-grid ew-list-form ew-master-div">
<table id="tbl_account_typemaster" class="table ew-table ew-master-table ew-horizontal">
	<thead>
		<tr class="ew-table-header">
<?php if ($account_type->AccountTypeCode->Visible) { // AccountTypeCode ?>
			<th class="<?php echo $account_type->AccountTypeCode->headerCellClass() ?>"><?php echo $account_type->AccountTypeCode->caption() ?></th>
<?php } ?>
<?php if ($account_type->AccountType->Visible) { // AccountType ?>
			<th class="<?php echo $account_type->AccountType->headerCellClass() ?>"><?php echo $account_type->AccountType->caption() ?></th>
<?php } ?>
		</tr>
	</thead>
	<tbody>
		<tr>
<?php if ($account_type->AccountTypeCode->Visible) { // AccountTypeCode ?>
			<td <?php echo $account_type->AccountTypeCode->cellAttributes() ?>>
<span id="el_account_type_AccountTypeCode">
<span<?php echo $account_type->AccountTypeCode->viewAttributes() ?>><?php echo $account_type->AccountTypeCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($account_type->AccountType->Visible) { // AccountType ?>
			<td <?php echo $account_type->AccountType->cellAttributes() ?>>
<span id="el_account_type_AccountType">
<span<?php echo $account_type->AccountType->viewAttributes() ?>><?php echo $account_type->AccountType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
		</tr>
	</tbody>
</table>
</div>
<?php } ?>