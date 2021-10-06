<?php
namespace PHPMaker2020\lgmis20;
?>
<?php if ($bank->Visible) { ?>
<div id="t_bank" class="card <?php echo ResponsiveTableClass() ?>ew-grid ew-list-form ew-master-div">
<table id="tbl_bankmaster" class="table ew-table ew-master-table ew-horizontal">
	<thead>
		<tr class="ew-table-header">
<?php if ($bank->BankCode->Visible) { // BankCode ?>
			<th class="<?php echo $bank->BankCode->headerCellClass() ?>"><?php echo $bank->BankCode->caption() ?></th>
<?php } ?>
<?php if ($bank->BankShortName->Visible) { // BankShortName ?>
			<th class="<?php echo $bank->BankShortName->headerCellClass() ?>"><?php echo $bank->BankShortName->caption() ?></th>
<?php } ?>
<?php if ($bank->BankName->Visible) { // BankName ?>
			<th class="<?php echo $bank->BankName->headerCellClass() ?>"><?php echo $bank->BankName->caption() ?></th>
<?php } ?>
		</tr>
	</thead>
	<tbody>
		<tr>
<?php if ($bank->BankCode->Visible) { // BankCode ?>
			<td <?php echo $bank->BankCode->cellAttributes() ?>>
<span id="el_bank_BankCode">
<span<?php echo $bank->BankCode->viewAttributes() ?>><?php echo $bank->BankCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bank->BankShortName->Visible) { // BankShortName ?>
			<td <?php echo $bank->BankShortName->cellAttributes() ?>>
<span id="el_bank_BankShortName">
<span<?php echo $bank->BankShortName->viewAttributes() ?>><?php echo $bank->BankShortName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bank->BankName->Visible) { // BankName ?>
			<td <?php echo $bank->BankName->cellAttributes() ?>>
<span id="el_bank_BankName">
<span<?php echo $bank->BankName->viewAttributes() ?>><?php echo $bank->BankName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
		</tr>
	</tbody>
</table>
</div>
<?php } ?>