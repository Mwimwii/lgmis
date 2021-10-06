<?php
namespace PHPMaker2020\lgmis20;
?>
<?php if ($account_sub_group->Visible) { ?>
<div id="t_account_sub_group" class="card <?php echo ResponsiveTableClass() ?>ew-grid ew-list-form ew-master-div">
<table id="tbl_account_sub_groupmaster" class="table ew-table ew-master-table ew-horizontal">
	<thead>
		<tr class="ew-table-header">
<?php if ($account_sub_group->AccountType->Visible) { // AccountType ?>
			<th class="<?php echo $account_sub_group->AccountType->headerCellClass() ?>"><?php echo $account_sub_group->AccountType->caption() ?></th>
<?php } ?>
<?php if ($account_sub_group->AccountGroupCode->Visible) { // AccountGroupCode ?>
			<th class="<?php echo $account_sub_group->AccountGroupCode->headerCellClass() ?>"><?php echo $account_sub_group->AccountGroupCode->caption() ?></th>
<?php } ?>
<?php if ($account_sub_group->AccountSubGroupCode->Visible) { // AccountSubGroupCode ?>
			<th class="<?php echo $account_sub_group->AccountSubGroupCode->headerCellClass() ?>"><?php echo $account_sub_group->AccountSubGroupCode->caption() ?></th>
<?php } ?>
<?php if ($account_sub_group->AccountSubGroupName->Visible) { // AccountSubGroupName ?>
			<th class="<?php echo $account_sub_group->AccountSubGroupName->headerCellClass() ?>"><?php echo $account_sub_group->AccountSubGroupName->caption() ?></th>
<?php } ?>
		</tr>
	</thead>
	<tbody>
		<tr>
<?php if ($account_sub_group->AccountType->Visible) { // AccountType ?>
			<td <?php echo $account_sub_group->AccountType->cellAttributes() ?>>
<span id="el_account_sub_group_AccountType">
<span<?php echo $account_sub_group->AccountType->viewAttributes() ?>><?php echo $account_sub_group->AccountType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($account_sub_group->AccountGroupCode->Visible) { // AccountGroupCode ?>
			<td <?php echo $account_sub_group->AccountGroupCode->cellAttributes() ?>>
<span id="el_account_sub_group_AccountGroupCode">
<span<?php echo $account_sub_group->AccountGroupCode->viewAttributes() ?>><?php echo $account_sub_group->AccountGroupCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($account_sub_group->AccountSubGroupCode->Visible) { // AccountSubGroupCode ?>
			<td <?php echo $account_sub_group->AccountSubGroupCode->cellAttributes() ?>>
<span id="el_account_sub_group_AccountSubGroupCode">
<span<?php echo $account_sub_group->AccountSubGroupCode->viewAttributes() ?>><?php echo $account_sub_group->AccountSubGroupCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($account_sub_group->AccountSubGroupName->Visible) { // AccountSubGroupName ?>
			<td <?php echo $account_sub_group->AccountSubGroupName->cellAttributes() ?>>
<span id="el_account_sub_group_AccountSubGroupName">
<span<?php echo $account_sub_group->AccountSubGroupName->viewAttributes() ?>><?php echo $account_sub_group->AccountSubGroupName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
		</tr>
	</tbody>
</table>
</div>
<?php } ?>