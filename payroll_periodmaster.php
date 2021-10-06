<?php
namespace PHPMaker2020\lgmis20;
?>
<?php if ($payroll_period->Visible) { ?>
<div id="t_payroll_period" class="card <?php echo ResponsiveTableClass() ?>ew-grid ew-list-form ew-master-div">
<table id="tbl_payroll_periodmaster" class="table ew-table ew-master-table ew-horizontal">
	<thead>
		<tr class="ew-table-header">
<?php if ($payroll_period->PeriodCode->Visible) { // PeriodCode ?>
			<th class="<?php echo $payroll_period->PeriodCode->headerCellClass() ?>"><?php echo $payroll_period->PeriodCode->caption() ?></th>
<?php } ?>
<?php if ($payroll_period->FiscalYear->Visible) { // FiscalYear ?>
			<th class="<?php echo $payroll_period->FiscalYear->headerCellClass() ?>"><?php echo $payroll_period->FiscalYear->caption() ?></th>
<?php } ?>
<?php if ($payroll_period->RunMonth->Visible) { // RunMonth ?>
			<th class="<?php echo $payroll_period->RunMonth->headerCellClass() ?>"><?php echo $payroll_period->RunMonth->caption() ?></th>
<?php } ?>
<?php if ($payroll_period->RunDescription->Visible) { // RunDescription ?>
			<th class="<?php echo $payroll_period->RunDescription->headerCellClass() ?>"><?php echo $payroll_period->RunDescription->caption() ?></th>
<?php } ?>
<?php if ($payroll_period->CurrentPeriod->Visible) { // CurrentPeriod ?>
			<th class="<?php echo $payroll_period->CurrentPeriod->headerCellClass() ?>"><?php echo $payroll_period->CurrentPeriod->caption() ?></th>
<?php } ?>
		</tr>
	</thead>
	<tbody>
		<tr>
<?php if ($payroll_period->PeriodCode->Visible) { // PeriodCode ?>
			<td <?php echo $payroll_period->PeriodCode->cellAttributes() ?>>
<span id="el_payroll_period_PeriodCode">
<span<?php echo $payroll_period->PeriodCode->viewAttributes() ?>><?php echo $payroll_period->PeriodCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($payroll_period->FiscalYear->Visible) { // FiscalYear ?>
			<td <?php echo $payroll_period->FiscalYear->cellAttributes() ?>>
<span id="el_payroll_period_FiscalYear">
<span<?php echo $payroll_period->FiscalYear->viewAttributes() ?>><?php echo $payroll_period->FiscalYear->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($payroll_period->RunMonth->Visible) { // RunMonth ?>
			<td <?php echo $payroll_period->RunMonth->cellAttributes() ?>>
<span id="el_payroll_period_RunMonth">
<span<?php echo $payroll_period->RunMonth->viewAttributes() ?>><?php echo $payroll_period->RunMonth->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($payroll_period->RunDescription->Visible) { // RunDescription ?>
			<td <?php echo $payroll_period->RunDescription->cellAttributes() ?>>
<span id="el_payroll_period_RunDescription">
<span<?php echo $payroll_period->RunDescription->viewAttributes() ?>><?php echo $payroll_period->RunDescription->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($payroll_period->CurrentPeriod->Visible) { // CurrentPeriod ?>
			<td <?php echo $payroll_period->CurrentPeriod->cellAttributes() ?>>
<span id="el_payroll_period_CurrentPeriod">
<span<?php echo $payroll_period->CurrentPeriod->viewAttributes() ?>><?php echo $payroll_period->CurrentPeriod->getViewValue() ?></span>
</span>
</td>
<?php } ?>
		</tr>
	</tbody>
</table>
</div>
<?php } ?>