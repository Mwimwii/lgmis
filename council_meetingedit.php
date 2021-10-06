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
$council_meeting_edit = new council_meeting_edit();

// Run the page
$council_meeting_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$council_meeting_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcouncil_meetingedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fcouncil_meetingedit = currentForm = new ew.Form("fcouncil_meetingedit", "edit");

	// Validate form
	fcouncil_meetingedit.validate = function() {
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
			<?php if ($council_meeting_edit->MeetingNo->Required) { ?>
				elm = this.getElements("x" + infix + "_MeetingNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $council_meeting_edit->MeetingNo->caption(), $council_meeting_edit->MeetingNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($council_meeting_edit->MeetingRef->Required) { ?>
				elm = this.getElements("x" + infix + "_MeetingRef");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $council_meeting_edit->MeetingRef->caption(), $council_meeting_edit->MeetingRef->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($council_meeting_edit->MeetingType->Required) { ?>
				elm = this.getElements("x" + infix + "_MeetingType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $council_meeting_edit->MeetingType->caption(), $council_meeting_edit->MeetingType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($council_meeting_edit->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $council_meeting_edit->LACode->caption(), $council_meeting_edit->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($council_meeting_edit->PlannedDate->Required) { ?>
				elm = this.getElements("x" + infix + "_PlannedDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $council_meeting_edit->PlannedDate->caption(), $council_meeting_edit->PlannedDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PlannedDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($council_meeting_edit->PlannedDate->errorMessage()) ?>");
			<?php if ($council_meeting_edit->ActualDate->Required) { ?>
				elm = this.getElements("x" + infix + "_ActualDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $council_meeting_edit->ActualDate->caption(), $council_meeting_edit->ActualDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ActualDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($council_meeting_edit->ActualDate->errorMessage()) ?>");
			<?php if ($council_meeting_edit->Attendance->Required) { ?>
				elm = this.getElements("x" + infix + "_Attendance");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $council_meeting_edit->Attendance->caption(), $council_meeting_edit->Attendance->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($council_meeting_edit->ChairedBy->Required) { ?>
				elm = this.getElements("x" + infix + "_ChairedBy");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $council_meeting_edit->ChairedBy->caption(), $council_meeting_edit->ChairedBy->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($council_meeting_edit->Minutes->Required) { ?>
				elm = this.getElements("x" + infix + "_Minutes");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $council_meeting_edit->Minutes->caption(), $council_meeting_edit->Minutes->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($council_meeting_edit->MinutesUploaded->Required) { ?>
				felm = this.getElements("x" + infix + "_MinutesUploaded");
				elm = this.getElements("fn_x" + infix + "_MinutesUploaded");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $council_meeting_edit->MinutesUploaded->caption(), $council_meeting_edit->MinutesUploaded->RequiredErrorMessage)) ?>");
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
	fcouncil_meetingedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcouncil_meetingedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fcouncil_meetingedit.lists["x_MeetingType"] = <?php echo $council_meeting_edit->MeetingType->Lookup->toClientList($council_meeting_edit) ?>;
	fcouncil_meetingedit.lists["x_MeetingType"].options = <?php echo JsonEncode($council_meeting_edit->MeetingType->lookupOptions()) ?>;
	fcouncil_meetingedit.lists["x_LACode"] = <?php echo $council_meeting_edit->LACode->Lookup->toClientList($council_meeting_edit) ?>;
	fcouncil_meetingedit.lists["x_LACode"].options = <?php echo JsonEncode($council_meeting_edit->LACode->lookupOptions()) ?>;
	fcouncil_meetingedit.autoSuggests["x_LACode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fcouncil_meetingedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $council_meeting_edit->showPageHeader(); ?>
<?php
$council_meeting_edit->showMessage();
?>
<?php if (!$council_meeting_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $council_meeting_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fcouncil_meetingedit" id="fcouncil_meetingedit" class="<?php echo $council_meeting_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="council_meeting">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$council_meeting_edit->IsModal ?>">
<?php if ($council_meeting->getCurrentMasterTable() == "local_authority") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="local_authority">
<input type="hidden" name="fk_LACode" value="<?php echo HtmlEncode($council_meeting_edit->LACode->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($council_meeting_edit->MeetingNo->Visible) { // MeetingNo ?>
	<div id="r_MeetingNo" class="form-group row">
		<label id="elh_council_meeting_MeetingNo" class="<?php echo $council_meeting_edit->LeftColumnClass ?>"><?php echo $council_meeting_edit->MeetingNo->caption() ?><?php echo $council_meeting_edit->MeetingNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $council_meeting_edit->RightColumnClass ?>"><div <?php echo $council_meeting_edit->MeetingNo->cellAttributes() ?>>
<span id="el_council_meeting_MeetingNo">
<span<?php echo $council_meeting_edit->MeetingNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($council_meeting_edit->MeetingNo->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="council_meeting" data-field="x_MeetingNo" name="x_MeetingNo" id="x_MeetingNo" value="<?php echo HtmlEncode($council_meeting_edit->MeetingNo->CurrentValue) ?>">
<?php echo $council_meeting_edit->MeetingNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($council_meeting_edit->MeetingRef->Visible) { // MeetingRef ?>
	<div id="r_MeetingRef" class="form-group row">
		<label id="elh_council_meeting_MeetingRef" for="x_MeetingRef" class="<?php echo $council_meeting_edit->LeftColumnClass ?>"><?php echo $council_meeting_edit->MeetingRef->caption() ?><?php echo $council_meeting_edit->MeetingRef->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $council_meeting_edit->RightColumnClass ?>"><div <?php echo $council_meeting_edit->MeetingRef->cellAttributes() ?>>
<span id="el_council_meeting_MeetingRef">
<input type="text" data-table="council_meeting" data-field="x_MeetingRef" name="x_MeetingRef" id="x_MeetingRef" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($council_meeting_edit->MeetingRef->getPlaceHolder()) ?>" value="<?php echo $council_meeting_edit->MeetingRef->EditValue ?>"<?php echo $council_meeting_edit->MeetingRef->editAttributes() ?>>
</span>
<?php echo $council_meeting_edit->MeetingRef->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($council_meeting_edit->MeetingType->Visible) { // MeetingType ?>
	<div id="r_MeetingType" class="form-group row">
		<label id="elh_council_meeting_MeetingType" for="x_MeetingType" class="<?php echo $council_meeting_edit->LeftColumnClass ?>"><?php echo $council_meeting_edit->MeetingType->caption() ?><?php echo $council_meeting_edit->MeetingType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $council_meeting_edit->RightColumnClass ?>"><div <?php echo $council_meeting_edit->MeetingType->cellAttributes() ?>>
<span id="el_council_meeting_MeetingType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="council_meeting" data-field="x_MeetingType" data-value-separator="<?php echo $council_meeting_edit->MeetingType->displayValueSeparatorAttribute() ?>" id="x_MeetingType" name="x_MeetingType"<?php echo $council_meeting_edit->MeetingType->editAttributes() ?>>
			<?php echo $council_meeting_edit->MeetingType->selectOptionListHtml("x_MeetingType") ?>
		</select>
</div>
<?php echo $council_meeting_edit->MeetingType->Lookup->getParamTag($council_meeting_edit, "p_x_MeetingType") ?>
</span>
<?php echo $council_meeting_edit->MeetingType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($council_meeting_edit->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label id="elh_council_meeting_LACode" class="<?php echo $council_meeting_edit->LeftColumnClass ?>"><?php echo $council_meeting_edit->LACode->caption() ?><?php echo $council_meeting_edit->LACode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $council_meeting_edit->RightColumnClass ?>"><div <?php echo $council_meeting_edit->LACode->cellAttributes() ?>>
<?php if ($council_meeting_edit->LACode->getSessionValue() != "") { ?>
<span id="el_council_meeting_LACode">
<span<?php echo $council_meeting_edit->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($council_meeting_edit->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_LACode" name="x_LACode" value="<?php echo HtmlEncode($council_meeting_edit->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_council_meeting_LACode">
<?php
$onchange = $council_meeting_edit->LACode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$council_meeting_edit->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x_LACode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_LACode" id="sv_x_LACode" value="<?php echo RemoveHtml($council_meeting_edit->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($council_meeting_edit->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($council_meeting_edit->LACode->getPlaceHolder()) ?>"<?php echo $council_meeting_edit->LACode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($council_meeting_edit->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_LACode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($council_meeting_edit->LACode->ReadOnly || $council_meeting_edit->LACode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="council_meeting" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $council_meeting_edit->LACode->displayValueSeparatorAttribute() ?>" name="x_LACode" id="x_LACode" value="<?php echo HtmlEncode($council_meeting_edit->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fcouncil_meetingedit"], function() {
	fcouncil_meetingedit.createAutoSuggest({"id":"x_LACode","forceSelect":false});
});
</script>
<?php echo $council_meeting_edit->LACode->Lookup->getParamTag($council_meeting_edit, "p_x_LACode") ?>
</span>
<?php } ?>
<?php echo $council_meeting_edit->LACode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($council_meeting_edit->PlannedDate->Visible) { // PlannedDate ?>
	<div id="r_PlannedDate" class="form-group row">
		<label id="elh_council_meeting_PlannedDate" for="x_PlannedDate" class="<?php echo $council_meeting_edit->LeftColumnClass ?>"><?php echo $council_meeting_edit->PlannedDate->caption() ?><?php echo $council_meeting_edit->PlannedDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $council_meeting_edit->RightColumnClass ?>"><div <?php echo $council_meeting_edit->PlannedDate->cellAttributes() ?>>
<span id="el_council_meeting_PlannedDate">
<input type="text" data-table="council_meeting" data-field="x_PlannedDate" name="x_PlannedDate" id="x_PlannedDate" placeholder="<?php echo HtmlEncode($council_meeting_edit->PlannedDate->getPlaceHolder()) ?>" value="<?php echo $council_meeting_edit->PlannedDate->EditValue ?>"<?php echo $council_meeting_edit->PlannedDate->editAttributes() ?>>
<?php if (!$council_meeting_edit->PlannedDate->ReadOnly && !$council_meeting_edit->PlannedDate->Disabled && !isset($council_meeting_edit->PlannedDate->EditAttrs["readonly"]) && !isset($council_meeting_edit->PlannedDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcouncil_meetingedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fcouncil_meetingedit", "x_PlannedDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $council_meeting_edit->PlannedDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($council_meeting_edit->ActualDate->Visible) { // ActualDate ?>
	<div id="r_ActualDate" class="form-group row">
		<label id="elh_council_meeting_ActualDate" for="x_ActualDate" class="<?php echo $council_meeting_edit->LeftColumnClass ?>"><?php echo $council_meeting_edit->ActualDate->caption() ?><?php echo $council_meeting_edit->ActualDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $council_meeting_edit->RightColumnClass ?>"><div <?php echo $council_meeting_edit->ActualDate->cellAttributes() ?>>
<span id="el_council_meeting_ActualDate">
<input type="text" data-table="council_meeting" data-field="x_ActualDate" name="x_ActualDate" id="x_ActualDate" placeholder="<?php echo HtmlEncode($council_meeting_edit->ActualDate->getPlaceHolder()) ?>" value="<?php echo $council_meeting_edit->ActualDate->EditValue ?>"<?php echo $council_meeting_edit->ActualDate->editAttributes() ?>>
<?php if (!$council_meeting_edit->ActualDate->ReadOnly && !$council_meeting_edit->ActualDate->Disabled && !isset($council_meeting_edit->ActualDate->EditAttrs["readonly"]) && !isset($council_meeting_edit->ActualDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcouncil_meetingedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fcouncil_meetingedit", "x_ActualDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $council_meeting_edit->ActualDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($council_meeting_edit->Attendance->Visible) { // Attendance ?>
	<div id="r_Attendance" class="form-group row">
		<label id="elh_council_meeting_Attendance" for="x_Attendance" class="<?php echo $council_meeting_edit->LeftColumnClass ?>"><?php echo $council_meeting_edit->Attendance->caption() ?><?php echo $council_meeting_edit->Attendance->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $council_meeting_edit->RightColumnClass ?>"><div <?php echo $council_meeting_edit->Attendance->cellAttributes() ?>>
<span id="el_council_meeting_Attendance">
<input type="text" data-table="council_meeting" data-field="x_Attendance" name="x_Attendance" id="x_Attendance" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($council_meeting_edit->Attendance->getPlaceHolder()) ?>" value="<?php echo $council_meeting_edit->Attendance->EditValue ?>"<?php echo $council_meeting_edit->Attendance->editAttributes() ?>>
</span>
<?php echo $council_meeting_edit->Attendance->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($council_meeting_edit->ChairedBy->Visible) { // ChairedBy ?>
	<div id="r_ChairedBy" class="form-group row">
		<label id="elh_council_meeting_ChairedBy" for="x_ChairedBy" class="<?php echo $council_meeting_edit->LeftColumnClass ?>"><?php echo $council_meeting_edit->ChairedBy->caption() ?><?php echo $council_meeting_edit->ChairedBy->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $council_meeting_edit->RightColumnClass ?>"><div <?php echo $council_meeting_edit->ChairedBy->cellAttributes() ?>>
<span id="el_council_meeting_ChairedBy">
<input type="text" data-table="council_meeting" data-field="x_ChairedBy" name="x_ChairedBy" id="x_ChairedBy" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($council_meeting_edit->ChairedBy->getPlaceHolder()) ?>" value="<?php echo $council_meeting_edit->ChairedBy->EditValue ?>"<?php echo $council_meeting_edit->ChairedBy->editAttributes() ?>>
</span>
<?php echo $council_meeting_edit->ChairedBy->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($council_meeting_edit->Minutes->Visible) { // Minutes ?>
	<div id="r_Minutes" class="form-group row">
		<label id="elh_council_meeting_Minutes" for="x_Minutes" class="<?php echo $council_meeting_edit->LeftColumnClass ?>"><?php echo $council_meeting_edit->Minutes->caption() ?><?php echo $council_meeting_edit->Minutes->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $council_meeting_edit->RightColumnClass ?>"><div <?php echo $council_meeting_edit->Minutes->cellAttributes() ?>>
<span id="el_council_meeting_Minutes">
<textarea data-table="council_meeting" data-field="x_Minutes" name="x_Minutes" id="x_Minutes" cols="35" rows="4" placeholder="<?php echo HtmlEncode($council_meeting_edit->Minutes->getPlaceHolder()) ?>"<?php echo $council_meeting_edit->Minutes->editAttributes() ?>><?php echo $council_meeting_edit->Minutes->EditValue ?></textarea>
</span>
<?php echo $council_meeting_edit->Minutes->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($council_meeting_edit->MinutesUploaded->Visible) { // MinutesUploaded ?>
	<div id="r_MinutesUploaded" class="form-group row">
		<label id="elh_council_meeting_MinutesUploaded" class="<?php echo $council_meeting_edit->LeftColumnClass ?>"><?php echo $council_meeting_edit->MinutesUploaded->caption() ?><?php echo $council_meeting_edit->MinutesUploaded->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $council_meeting_edit->RightColumnClass ?>"><div <?php echo $council_meeting_edit->MinutesUploaded->cellAttributes() ?>>
<span id="el_council_meeting_MinutesUploaded">
<div id="fd_x_MinutesUploaded">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $council_meeting_edit->MinutesUploaded->title() ?>" data-table="council_meeting" data-field="x_MinutesUploaded" name="x_MinutesUploaded" id="x_MinutesUploaded" lang="<?php echo CurrentLanguageID() ?>"<?php echo $council_meeting_edit->MinutesUploaded->editAttributes() ?><?php if ($council_meeting_edit->MinutesUploaded->ReadOnly || $council_meeting_edit->MinutesUploaded->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_MinutesUploaded"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_MinutesUploaded" id= "fn_x_MinutesUploaded" value="<?php echo $council_meeting_edit->MinutesUploaded->Upload->FileName ?>">
<input type="hidden" name="fa_x_MinutesUploaded" id= "fa_x_MinutesUploaded" value="<?php echo (Post("fa_x_MinutesUploaded") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_MinutesUploaded" id= "fs_x_MinutesUploaded" value="0">
<input type="hidden" name="fx_x_MinutesUploaded" id= "fx_x_MinutesUploaded" value="<?php echo $council_meeting_edit->MinutesUploaded->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_MinutesUploaded" id= "fm_x_MinutesUploaded" value="<?php echo $council_meeting_edit->MinutesUploaded->UploadMaxFileSize ?>">
</div>
<table id="ft_x_MinutesUploaded" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $council_meeting_edit->MinutesUploaded->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("council_resolution", explode(",", $council_meeting->getCurrentDetailTable())) && $council_resolution->DetailEdit) {
?>
<?php if ($council_meeting->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("council_resolution", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "council_resolutiongrid.php" ?>
<?php } ?>
<?php if (!$council_meeting_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $council_meeting_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $council_meeting_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$council_meeting_edit->IsModal) { ?>
<?php echo $council_meeting_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$council_meeting_edit->showPageFooter();
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
$council_meeting_edit->terminate();
?>