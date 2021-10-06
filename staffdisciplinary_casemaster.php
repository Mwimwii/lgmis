<?php
namespace PHPMaker2020\lgmis20;
?>
<?php if ($staffdisciplinary_case->Visible) { ?>
<div id="t_staffdisciplinary_case" class="card <?php echo ResponsiveTableClass() ?>ew-grid ew-list-form ew-master-div">
<table id="tbl_staffdisciplinary_casemaster" class="table ew-table ew-master-table ew-horizontal">
	<thead>
		<tr class="ew-table-header">
<?php if ($staffdisciplinary_case->CaseNo->Visible) { // CaseNo ?>
			<th class="<?php echo $staffdisciplinary_case->CaseNo->headerCellClass() ?>"><?php echo $staffdisciplinary_case->CaseNo->caption() ?></th>
<?php } ?>
<?php if ($staffdisciplinary_case->OffenseCode->Visible) { // OffenseCode ?>
			<th class="<?php echo $staffdisciplinary_case->OffenseCode->headerCellClass() ?>"><?php echo $staffdisciplinary_case->OffenseCode->caption() ?></th>
<?php } ?>
<?php if ($staffdisciplinary_case->ActionTaken->Visible) { // ActionTaken ?>
			<th class="<?php echo $staffdisciplinary_case->ActionTaken->headerCellClass() ?>"><?php echo $staffdisciplinary_case->ActionTaken->caption() ?></th>
<?php } ?>
<?php if ($staffdisciplinary_case->OffenseDate->Visible) { // OffenseDate ?>
			<th class="<?php echo $staffdisciplinary_case->OffenseDate->headerCellClass() ?>"><?php echo $staffdisciplinary_case->OffenseDate->caption() ?></th>
<?php } ?>
<?php if ($staffdisciplinary_case->ActionDate->Visible) { // ActionDate ?>
			<th class="<?php echo $staffdisciplinary_case->ActionDate->headerCellClass() ?>"><?php echo $staffdisciplinary_case->ActionDate->caption() ?></th>
<?php } ?>
<?php if ($staffdisciplinary_case->DateOfAppealLetter->Visible) { // DateOfAppealLetter ?>
			<th class="<?php echo $staffdisciplinary_case->DateOfAppealLetter->headerCellClass() ?>"><?php echo $staffdisciplinary_case->DateOfAppealLetter->caption() ?></th>
<?php } ?>
<?php if ($staffdisciplinary_case->DateAppealReceived->Visible) { // DateAppealReceived ?>
			<th class="<?php echo $staffdisciplinary_case->DateAppealReceived->headerCellClass() ?>"><?php echo $staffdisciplinary_case->DateAppealReceived->caption() ?></th>
<?php } ?>
<?php if ($staffdisciplinary_case->DateConcluded->Visible) { // DateConcluded ?>
			<th class="<?php echo $staffdisciplinary_case->DateConcluded->headerCellClass() ?>"><?php echo $staffdisciplinary_case->DateConcluded->caption() ?></th>
<?php } ?>
<?php if ($staffdisciplinary_case->AppealStatus->Visible) { // AppealStatus ?>
			<th class="<?php echo $staffdisciplinary_case->AppealStatus->headerCellClass() ?>"><?php echo $staffdisciplinary_case->AppealStatus->caption() ?></th>
<?php } ?>
		</tr>
	</thead>
	<tbody>
		<tr>
<?php if ($staffdisciplinary_case->CaseNo->Visible) { // CaseNo ?>
			<td <?php echo $staffdisciplinary_case->CaseNo->cellAttributes() ?>>
<span id="el_staffdisciplinary_case_CaseNo">
<span<?php echo $staffdisciplinary_case->CaseNo->viewAttributes() ?>><?php echo $staffdisciplinary_case->CaseNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staffdisciplinary_case->OffenseCode->Visible) { // OffenseCode ?>
			<td <?php echo $staffdisciplinary_case->OffenseCode->cellAttributes() ?>>
<span id="el_staffdisciplinary_case_OffenseCode">
<span<?php echo $staffdisciplinary_case->OffenseCode->viewAttributes() ?>><?php echo $staffdisciplinary_case->OffenseCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staffdisciplinary_case->ActionTaken->Visible) { // ActionTaken ?>
			<td <?php echo $staffdisciplinary_case->ActionTaken->cellAttributes() ?>>
<span id="el_staffdisciplinary_case_ActionTaken">
<span<?php echo $staffdisciplinary_case->ActionTaken->viewAttributes() ?>><?php echo $staffdisciplinary_case->ActionTaken->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staffdisciplinary_case->OffenseDate->Visible) { // OffenseDate ?>
			<td <?php echo $staffdisciplinary_case->OffenseDate->cellAttributes() ?>>
<span id="el_staffdisciplinary_case_OffenseDate">
<span<?php echo $staffdisciplinary_case->OffenseDate->viewAttributes() ?>><?php echo $staffdisciplinary_case->OffenseDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staffdisciplinary_case->ActionDate->Visible) { // ActionDate ?>
			<td <?php echo $staffdisciplinary_case->ActionDate->cellAttributes() ?>>
<span id="el_staffdisciplinary_case_ActionDate">
<span<?php echo $staffdisciplinary_case->ActionDate->viewAttributes() ?>><?php echo $staffdisciplinary_case->ActionDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staffdisciplinary_case->DateOfAppealLetter->Visible) { // DateOfAppealLetter ?>
			<td <?php echo $staffdisciplinary_case->DateOfAppealLetter->cellAttributes() ?>>
<span id="el_staffdisciplinary_case_DateOfAppealLetter">
<span<?php echo $staffdisciplinary_case->DateOfAppealLetter->viewAttributes() ?>><?php echo $staffdisciplinary_case->DateOfAppealLetter->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staffdisciplinary_case->DateAppealReceived->Visible) { // DateAppealReceived ?>
			<td <?php echo $staffdisciplinary_case->DateAppealReceived->cellAttributes() ?>>
<span id="el_staffdisciplinary_case_DateAppealReceived">
<span<?php echo $staffdisciplinary_case->DateAppealReceived->viewAttributes() ?>><?php echo $staffdisciplinary_case->DateAppealReceived->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staffdisciplinary_case->DateConcluded->Visible) { // DateConcluded ?>
			<td <?php echo $staffdisciplinary_case->DateConcluded->cellAttributes() ?>>
<span id="el_staffdisciplinary_case_DateConcluded">
<span<?php echo $staffdisciplinary_case->DateConcluded->viewAttributes() ?>><?php echo $staffdisciplinary_case->DateConcluded->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staffdisciplinary_case->AppealStatus->Visible) { // AppealStatus ?>
			<td <?php echo $staffdisciplinary_case->AppealStatus->cellAttributes() ?>>
<span id="el_staffdisciplinary_case_AppealStatus">
<span<?php echo $staffdisciplinary_case->AppealStatus->viewAttributes() ?>><?php echo $staffdisciplinary_case->AppealStatus->getViewValue() ?></span>
</span>
</td>
<?php } ?>
		</tr>
	</tbody>
</table>
</div>
<?php } ?>