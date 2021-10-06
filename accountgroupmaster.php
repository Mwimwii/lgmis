<?php
namespace PHPMaker2020\lgmis20;
?>
<?php if ($accountgroup->Visible) { ?>
<div id="t_accountgroup" class="card <?php echo ResponsiveTableClass() ?>ew-grid ew-list-form ew-master-div">
<table id="tbl_accountgroupmaster" class="table ew-table ew-master-table ew-horizontal">
	<thead>
		<tr class="ew-table-header">
<?php if ($accountgroup->AccountGroupCode->Visible) { // AccountGroupCode ?>
			<th class="<?php echo $accountgroup->AccountGroupCode->headerCellClass() ?>"><?php echo $accountgroup->AccountGroupCode->caption() ?></th>
<?php } ?>
<?php if ($accountgroup->AccountGroupName->Visible) { // AccountGroupName ?>
			<th class="<?php echo $accountgroup->AccountGroupName->headerCellClass() ?>"><?php echo $accountgroup->AccountGroupName->caption() ?></th>
<?php } ?>
<?php if ($accountgroup->AccountType->Visible) { // AccountType ?>
			<th class="<?php echo $accountgroup->AccountType->headerCellClass() ?>"><?php echo $accountgroup->AccountType->caption() ?></th>
<?php } ?>
		</tr>
	</thead>
	<tbody>
		<tr>
<?php if ($accountgroup->AccountGroupCode->Visible) { // AccountGroupCode ?>
			<td <?php echo $accountgroup->AccountGroupCode->cellAttributes() ?>>
<span id="el_accountgroup_AccountGroupCode">
<span<?php echo $accountgroup->AccountGroupCode->viewAttributes() ?>><?php echo $accountgroup->AccountGroupCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($accountgroup->AccountGroupName->Visible) { // AccountGroupName ?>
			<td <?php echo $accountgroup->AccountGroupName->cellAttributes() ?>>
<span id="el_accountgroup_AccountGroupName">
<span<?php echo $accountgroup->AccountGroupName->viewAttributes() ?>><?php echo $accountgroup->AccountGroupName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($accountgroup->AccountType->Visible) { // AccountType ?>
			<td <?php echo $accountgroup->AccountType->cellAttributes() ?>>
<span id="el_accountgroup_AccountType">
<span<?php echo $accountgroup->AccountType->viewAttributes() ?>><?php echo $accountgroup->AccountType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
		</tr>
	</tbody>
</table>
</div>
<?php } ?>