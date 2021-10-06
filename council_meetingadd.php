<?php
namespace PHPMaker2020\lgmis20;

// Autoload
include_once "autoload.php";

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	\Delight\Cookie\Session::start(Config("COOKIE_SAMESITE")); // Init session data

// Output buffering
ob_start();
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$council_meeting_add = new council_meeting_add();

// Run the page
$council_meeting_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$council_meeting_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcouncil_meetingadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fcouncil_meetingadd = currentForm = new ew.Form("fcouncil_meetingadd", "add");

	// Validate form
	fcouncil_meetingadd.validate = function() {
		if (!this.validateRequired)
			return true; // Ignore validation
		var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
		if ($fobj.find("#confirm").val() == "confirm")
			return true;
		var elm, felm, uelm, addcnt = 0;
		var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
		var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
		var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
		var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
		for (var i = startcnt; i <= rowcnt; i++) {
			var infix = ($k[0]) ? String(i) : "";
			$fobj.data("rowindex", infix);
			<?php if ($council_meeting_add->MeetingRef->Required) { ?>
				elm = this.getElements("x" + infix + "_MeetingRef");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $council_meeting_add->MeetingRef->caption(), $council_meeting_add->MeetingRef->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($council_meeting_add->MeetingType->Required) { ?>
				elm = this.getElements("x" + infix + "_MeetingType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $council_meeting_add->MeetingType->caption(), $council_meeting_add->MeetingType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($council_meeting_add->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $council_meeting_add->LACode->caption(), $council_meeting_add->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($council_meeting_add->PlannedDate->Required) { ?>
				elm = this.getElements("x" + infix + "_PlannedDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $council_meeting_add->PlannedDate->caption(), $council_meeting_add->PlannedDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PlannedDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($council_meeting_add->PlannedDate->errorMessage()) ?>");
			<?php if ($council_meeting_add->ActualDate->Required) { ?>
				elm = this.getElements("x" + infix + "_ActualDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $council_meeting_add->ActualDate->caption(), $council_meeting_add->ActualDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ActualDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($council_meeting_add->ActualDate->errorMessage()) ?>");
			<?php if ($council_meeting_add->Attendance->Required) { ?>
				elm = this.getElements("x" + infix + "_Attendance");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $council_meeting_add->Attendance->caption(), $council_meeting_add->Attendance->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($council_meeting_add->ChairedBy->Required) { ?>
				elm = this.getElements("x" + infix + "_ChairedBy");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $council_meeting_add->ChairedBy->caption(), $council_meeting_add->ChairedBy->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($council_meeting_add->Minutes->Required) { ?>
				elm = this.getElements("x" + infix + "_Minutes");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $council_meeting_add->Minutes->caption(), $council_meeting_add->Minutes->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($council_meeting_add->MinutesUploaded->Required) { ?>
				felm = this.getElements("x" + infix + "_MinutesUploaded");
				elm = this.getElements("fn_x" + infix + "_MinutesUploaded");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $council_meeting_add->MinutesUploaded->caption(), $council_meeting_add->MinutesUploaded->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}

		// Process detail forms
		var dfs = $fobj.find("input[name='detailpage']").get();
		for (var i = 0; i < dfs.length; i++) {
			var df = dfs[i], val = df.value;
			if (val && ew.forms[val])
				if (!ew.forms[val].validate())
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	fcouncil_meetingadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcouncil_meetingadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fcouncil_meetingadd.lists["x_MeetingType"] = <?php echo $council_meeting_add->MeetingType->Lookup->toClientList($council_meeting_add) ?>;
	fcouncil_meetingadd.lists["x_MeetingType"].options = <?php echo JsonEncode($council_meeting_add->MeetingType->lookupOptions()) ?>;
	fcouncil_meetingadd.lists["x_LACode"] = <?php echo $council_meeting_add->LACode->Lookup->toClientList($council_meeting_add) ?>;
	fcouncil_meetingadd.lists["x_LACode"].options = <?php echo JsonEncode($council_meeting_add->LACode->lookupOptions()) ?>;
	fcouncil_meetingadd.autoSuggests["x_LACode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fcouncil_meetingadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $council_meeting_add->showPageHeader(); ?>
<?php
$council_meeting_add->showMessage();
?>
<form name="fcouncil_meetingadd" id="fcouncil_meetingadd" class="<?php echo $council_meeting_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="council_meeting">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$council_meeting_add->IsModal ?>">
<?php if ($council_meeting->getCurrentMasterTable() == "local_authority") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="local_authority">
<input type="hidden" name="fk_LACode" value="<?php echo HtmlEncode($council_meeting_add->LACode->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($council_meeting_add->MeetingRef->Visible) { // MeetingRef ?>
	<div id="r_MeetingRef" class="form-group row">
		<label id="elh_council_meeting_MeetingRef" for="x_MeetingRef" class="<?php echo $council_meeting_add->LeftColumnClass ?>"><?php echo $council_meeting_add->MeetingRef->caption() ?><?php echo $council_meeting_add->MeetingRef->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $council_meeting_add->RightColumnClass ?>"><div <?php echo $council_meeting_add->MeetingRef->cellAttributes() ?>>
<span id="el_council_meeting_MeetingRef">
<input type="text" data-table="council_meeting" data-field="x_MeetingRef" name="x_MeetingRef" id="x_MeetingRef" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($council_meeting_add->MeetingRef->getPlaceHolder()) ?>" value="<?php echo $council_meeting_add->MeetingRef->EditValue ?>"<?php echo $council_meeting_add->MeetingRef->editAttributes() ?>>
</span>
<?php echo $council_meeting_add->MeetingRef->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($council_meeting_add->MeetingType->Visible) { // MeetingType ?>
	<div id="r_MeetingType" class="form-group row">
		<label id="elh_council_meeting_MeetingType" for="x_MeetingType" class="<?php echo $council_meeting_add->LeftColumnClass ?>"><?php echo $council_meeting_add->MeetingType->caption() ?><?php echo $council_meeting_add->MeetingType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $council_meeting_add->RightColumnClass ?>"><div <?php echo $council_meeting_add->MeetingType->cellAttributes() ?>>
<span id="el_council_meeting_MeetingType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="council_meeting" data-field="x_MeetingType" data-value-separator="<?php echo $council_meeting_add->MeetingType->displayValueSeparatorAttribute() ?>" id="x_MeetingType" name="x_MeetingType"<?php echo $council_meeting_add->MeetingType->editAttributes() ?>>
			<?php echo $council_meeting_add->MeetingType->selectOptionListHtml("x_MeetingType") ?>
		</select>
</div>
<?php echo $council_meeting_add->MeetingType->Lookup->getParamTag($council_meeting_add, "p_x_MeetingType") ?>
</span>
<?php echo $council_meeting_add->MeetingType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($council_meeting_add->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label id="elh_council_meeting_LACode" class="<?php echo $council_meeting_add->LeftColumnClass ?>"><?php echo $council_meeting_add->LACode->caption() ?><?php echo $council_meeting_add->LACode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $council_meeting_add->RightColumnClass ?>"><div <?php echo $council_meeting_add->LACode->cellAttributes() ?>>
<?php if ($council_meeting_add->LACode->getSessionValue() != "") { ?>
<span id="el_council_meeting_LACode">
<span<?php echo $council_meeting_add->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($council_meeting_add->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_LACode" name="x_LACode" value="<?php echo HtmlEncode($council_meeting_add->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_council_meeting_LACode">
<?php
$onchange = $council_meeting_add->LACode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$council_meeting_add->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x_LACode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_LACode" id="sv_x_LACode" value="<?php echo RemoveHtml($council_meeting_add->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($council_meeting_add->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($council_meeting_add->LACode->getPlaceHolder()) ?>"<?php echo $council_meeting_add->LACode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($council_meeting_add->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_LACode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($council_meeting_add->LACode->ReadOnly || $council_meeting_add->LACode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="council_meeting" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $council_meeting_add->LACode->displayValueSeparatorAttribute() ?>" name="x_LACode" id="x_LACode" value="<?php echo HtmlEncode($council_meeting_add->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fcouncil_meetingadd"], function() {
	fcouncil_meetingadd.createAutoSuggest({"id":"x_LACode","forceSelect":false});
});
</script>
<?php echo $council_meeting_add->LACode->Lookup->getParamTag($council_meeting_add, "p_x_LACode") ?>
</span>
<?php } ?>
<?php echo $council_meeting_add->LACode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($council_meeting_add->PlannedDate->Visible) { // PlannedDate ?>
	<div id="r_PlannedDate" class="form-group row">
		<label id="elh_council_meeting_PlannedDate" for="x_PlannedDate" class="<?php echo $council_meeting_add->LeftColumnClass ?>"><?php echo $council_meeting_add->PlannedDate->caption() ?><?php echo $council_meeting_add->PlannedDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $council_meeting_add->RightColumnClass ?>"><div <?php echo $council_meeting_add->PlannedDate->cellAttributes() ?>>
<span id="el_council_meeting_PlannedDate">
<input type="text" data-table="council_meeting" data-field="x_PlannedDate" name="x_PlannedDate" id="x_PlannedDate" placeholder="<?php echo HtmlEncode($council_meeting_add->PlannedDate->getPlaceHolder()) ?>" value="<?php echo $council_meeting_add->PlannedDate->EditValue ?>"<?php echo $council_meeting_add->PlannedDate->editAttributes() ?>>
<?php if (!$council_meeting_add->PlannedDate->ReadOnly && !$council_meeting_add->PlannedDate->Disabled && !isset($council_meeting_add->PlannedDate->EditAttrs["readonly"]) && !isset($council_meeting_add->PlannedDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcouncil_meetingadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fcouncil_meetingadd", "x_PlannedDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $council_meeting_add->PlannedDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($council_meeting_add->ActualDate->Visible) { // ActualDate ?>
	<div id="r_ActualDate" class="form-group row">
		<label id="elh_council_meeting_ActualDate" for="x_ActualDate" class="<?php echo $council_meeting_add->LeftColumnClass ?>"><?php echo $council_meeting_add->ActualDate->caption() ?><?php echo $council_meeting_add->ActualDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $council_meeting_add->RightColumnClass ?>"><div <?php echo $council_meeting_add->ActualDate->cellAttributes() ?>>
<span id="el_council_meeting_ActualDate">
<input type="text" data-table="council_meeting" data-field="x_ActualDate" name="x_ActualDate" id="x_ActualDate" placeholder="<?php echo HtmlEncode($council_meeting_add->ActualDate->getPlaceHolder()) ?>" value="<?php echo $council_meeting_add->ActualDate->EditValue ?>"<?php echo $council_meeting_add->ActualDate->editAttributes() ?>>
<?php if (!$council_meeting_add->ActualDate->ReadOnly && !$council_meeting_add->ActualDate->Disabled && !isset($council_meeting_add->ActualDate->EditAttrs["readonly"]) && !isset($council_meeting_add->ActualDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcouncil_meetingadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fcouncil_meetingadd", "x_ActualDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $council_meeting_add->ActualDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($council_meeting_add->Attendance->Visible) { // Attendance ?>
	<div id="r_Attendance" class="form-group row">
		<label id="elh_council_meeting_Attendance" for="x_Attendance" class="<?php echo $council_meeting_add->LeftColumnClass ?>"><?php echo $council_meeting_add->Attendance->caption() ?><?php echo $council_meeting_add->Attendance->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $council_meeting_add->RightColumnClass ?>"><div <?php echo $council_meeting_add->Attendance->cellAttributes() ?>>
<span id="el_council_meeting_Attendance">
<input type="text" data-table="council_meeting" data-field="x_Attendance" name="x_Attendance" id="x_Attendance" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($council_meeting_add->Attendance->getPlaceHolder()) ?>" value="<?php echo $council_meeting_add->Attendance->EditValue ?>"<?php echo $council_meeting_add->Attendance->editAttributes() ?>>
</span>
<?php echo $council_meeting_add->Attendance->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($council_meeting_add->ChairedBy->Visible) { // ChairedBy ?>
	<div id="r_ChairedBy" class="form-group row">
		<label id="elh_council_meeting_ChairedBy" for="x_ChairedBy" class="<?php echo $council_meeting_add->LeftColumnClass ?>"><?php echo $council_meeting_add->ChairedBy->caption() ?><?php echo $council_meeting_add->ChairedBy->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $council_meeting_add->RightColumnClass ?>"><div <?php echo $council_meeting_add->ChairedBy->cellAttributes() ?>>
<span id="el_council_meeting_ChairedBy">
<input type="text" data-table="council_meeting" data-field="x_ChairedBy" name="x_ChairedBy" id="x_ChairedBy" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($council_meeting_add->ChairedBy->getPlaceHolder()) ?>" value="<?php echo $council_meeting_add->ChairedBy->EditValue ?>"<?php echo $council_meeting_add->ChairedBy->editAttributes() ?>>
</span>
<?php echo $council_meeting_add->ChairedBy->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($council_meeting_add->Minutes->Visible) { // Minutes ?>
	<div id="r_Minutes" class="form-group row">
		<label id="elh_council_meeting_Minutes" for="x_Minutes" class="<?php echo $council_meeting_add->LeftColumnClass ?>"><?php echo $council_meeting_add->Minutes->caption() ?><?php echo $council_meeting_add->Minutes->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $council_meeting_add->RightColumnClass ?>"><div <?php echo $council_meeting_add->Minutes->cellAttributes() ?>>
<span id="el_council_meeting_Minutes">
<textarea data-table="council_meeting" data-field="x_Minutes" name="x_Minutes" id="x_Minutes" cols="35" rows="4" placeholder="<?php echo HtmlEncode($council_meeting_add->Minutes->getPlaceHolder()) ?>"<?php echo $council_meeting_add->Minutes->editAttributes() ?>><?php echo $council_meeting_add->Minutes->EditValue ?></textarea>
</span>
<?php echo $council_meeting_add->Minutes->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($council_meeting_add->MinutesUploaded->Visible) { // MinutesUploaded ?>
	<div id="r_MinutesUploaded" class="form-group row">
		<label id="elh_council_meeting_MinutesUploaded" class="<?php echo $council_meeting_add->LeftColumnClass ?>"><?php echo $council_meeting_add->MinutesUploaded->caption() ?><?php echo $council_meeting_add->MinutesUploaded->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $council_meeting_add->RightColumnClass ?>"><div <?php echo $council_meeting_add->MinutesUploaded->cellAttributes() ?>>
<span id="el_council_meeting_MinutesUploaded">
<div id="fd_x_MinutesUploaded">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $council_meeting_add->MinutesUploaded->title() ?>" data-table="council_meeting" data-field="x_MinutesUploaded" name="x_MinutesUploaded" id="x_MinutesUploaded" lang="<?php echo CurrentLanguageID() ?>"<?php echo $council_meeting_add->MinutesUploaded->editAttributes() ?><?php if ($council_meeting_add->MinutesUploaded->ReadOnly || $council_meeting_add->MinutesUploaded->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_MinutesUploaded"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_MinutesUploaded" id= "fn_x_MinutesUploaded" value="<?php echo $council_meeting_add->MinutesUploaded->Upload->FileName ?>">
<input type="hidden" name="fa_x_MinutesUploaded" id= "fa_x_MinutesUploaded" value="0">
<input type="hidden" name="fs_x_MinutesUploaded" id= "fs_x_MinutesUploaded" value="0">
<input type="hidden" name="fx_x_MinutesUploaded" id= "fx_x_MinutesUploaded" value="<?php echo $council_meeting_add->MinutesUploaded->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_MinutesUploaded" id= "fm_x_MinutesUploaded" value="<?php echo $council_meeting_add->MinutesUploaded->UploadMaxFileSize ?>">
</div>
<table id="ft_x_MinutesUploaded" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $council_meeting_add->MinutesUploaded->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("council_resolution", explode(",", $council_meeting->getCurrentDetailTable())) && $council_resolution->DetailAdd) {
?>
<?php if ($council_meeting->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("council_resolution", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "council_resolutiongrid.php" ?>
<?php } ?>
<?php if (!$council_meeting_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $council_meeting_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $council_meeting_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$council_meeting_add->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php include_once "footer.php"; ?>
<?php
$council_meeting_add->terminate();
?>