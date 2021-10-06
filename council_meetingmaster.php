<?php
namespace PHPMaker2020\lgmis20;
?>
<?php if ($council_meeting->Visible) { ?>
<div id="t_council_meeting" class="card <?php echo ResponsiveTableClass() ?>ew-grid ew-list-form ew-master-div">
<table id="tbl_council_meetingmaster" class="table ew-table ew-master-table ew-horizontal">
	<thead>
		<tr class="ew-table-header">
<?php if ($council_meeting->MeetingNo->Visible) { // MeetingNo ?>
			<th class="<?php echo $council_meeting->MeetingNo->headerCellClass() ?>"><?php echo $council_meeting->MeetingNo->caption() ?></th>
<?php } ?>
<?php if ($council_meeting->MeetingRef->Visible) { // MeetingRef ?>
			<th class="<?php echo $council_meeting->MeetingRef->headerCellClass() ?>"><?php echo $council_meeting->MeetingRef->caption() ?></th>
<?php } ?>
<?php if ($council_meeting->MeetingType->Visible) { // MeetingType ?>
			<th class="<?php echo $council_meeting->MeetingType->headerCellClass() ?>"><?php echo $council_meeting->MeetingType->caption() ?></th>
<?php } ?>
<?php if ($council_meeting->LACode->Visible) { // LACode ?>
			<th class="<?php echo $council_meeting->LACode->headerCellClass() ?>"><?php echo $council_meeting->LACode->caption() ?></th>
<?php } ?>
<?php if ($council_meeting->PlannedDate->Visible) { // PlannedDate ?>
			<th class="<?php echo $council_meeting->PlannedDate->headerCellClass() ?>"><?php echo $council_meeting->PlannedDate->caption() ?></th>
<?php } ?>
<?php if ($council_meeting->ActualDate->Visible) { // ActualDate ?>
			<th class="<?php echo $council_meeting->ActualDate->headerCellClass() ?>"><?php echo $council_meeting->ActualDate->caption() ?></th>
<?php } ?>
<?php if ($council_meeting->Attendance->Visible) { // Attendance ?>
			<th class="<?php echo $council_meeting->Attendance->headerCellClass() ?>"><?php echo $council_meeting->Attendance->caption() ?></th>
<?php } ?>
<?php if ($council_meeting->ChairedBy->Visible) { // ChairedBy ?>
			<th class="<?php echo $council_meeting->ChairedBy->headerCellClass() ?>"><?php echo $council_meeting->ChairedBy->caption() ?></th>
<?php } ?>
		</tr>
	</thead>
	<tbody>
		<tr>
<?php if ($council_meeting->MeetingNo->Visible) { // MeetingNo ?>
			<td <?php echo $council_meeting->MeetingNo->cellAttributes() ?>>
<span id="el_council_meeting_MeetingNo">
<span<?php echo $council_meeting->MeetingNo->viewAttributes() ?>><?php echo $council_meeting->MeetingNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($council_meeting->MeetingRef->Visible) { // MeetingRef ?>
			<td <?php echo $council_meeting->MeetingRef->cellAttributes() ?>>
<span id="el_council_meeting_MeetingRef">
<span<?php echo $council_meeting->MeetingRef->viewAttributes() ?>><?php echo $council_meeting->MeetingRef->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($council_meeting->MeetingType->Visible) { // MeetingType ?>
			<td <?php echo $council_meeting->MeetingType->cellAttributes() ?>>
<span id="el_council_meeting_MeetingType">
<span<?php echo $council_meeting->MeetingType->viewAttributes() ?>><?php echo $council_meeting->MeetingType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($council_meeting->LACode->Visible) { // LACode ?>
			<td <?php echo $council_meeting->LACode->cellAttributes() ?>>
<span id="el_council_meeting_LACode">
<span<?php echo $council_meeting->LACode->viewAttributes() ?>><?php echo $council_meeting->LACode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($council_meeting->PlannedDate->Visible) { // PlannedDate ?>
			<td <?php echo $council_meeting->PlannedDate->cellAttributes() ?>>
<span id="el_council_meeting_PlannedDate">
<span<?php echo $council_meeting->PlannedDate->viewAttributes() ?>><?php echo $council_meeting->PlannedDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($council_meeting->ActualDate->Visible) { // ActualDate ?>
			<td <?php echo $council_meeting->ActualDate->cellAttributes() ?>>
<span id="el_council_meeting_ActualDate">
<span<?php echo $council_meeting->ActualDate->viewAttributes() ?>><?php echo $council_meeting->ActualDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($council_meeting->Attendance->Visible) { // Attendance ?>
			<td <?php echo $council_meeting->Attendance->cellAttributes() ?>>
<span id="el_council_meeting_Attendance">
<span<?php echo $council_meeting->Attendance->viewAttributes() ?>><?php echo $council_meeting->Attendance->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($council_meeting->ChairedBy->Visible) { // ChairedBy ?>
			<td <?php echo $council_meeting->ChairedBy->cellAttributes() ?>>
<span id="el_council_meeting_ChairedBy">
<span<?php echo $council_meeting->ChairedBy->viewAttributes() ?>><?php echo $council_meeting->ChairedBy->getViewValue() ?></span>
</span>
</td>
<?php } ?>
		</tr>
	</tbody>
</table>
</div>
<?php } ?>