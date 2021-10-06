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
$council_resolution_edit = new council_resolution_edit();

// Run the page
$council_resolution_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$council_resolution_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcouncil_resolutionedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fcouncil_resolutionedit = currentForm = new ew.Form("fcouncil_resolutionedit", "edit");

	// Validate form
	fcouncil_resolutionedit.validate = function() {
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
			<?php if ($council_resolution_edit->MeetingNo->Required) { ?>
				elm = this.getElements("x" + infix + "_MeetingNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $council_resolution_edit->MeetingNo->caption(), $council_resolution_edit->MeetingNo->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_MeetingNo");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($council_resolution_edit->MeetingNo->errorMessage()) ?>");
			<?php if ($council_resolution_edit->MinuteNumber->Required) { ?>
				elm = this.getElements("x" + infix + "_MinuteNumber");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $council_resolution_edit->MinuteNumber->caption(), $council_resolution_edit->MinuteNumber->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($council_resolution_edit->Subject->Required) { ?>
				elm = this.getElements("x" + infix + "_Subject");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $council_resolution_edit->Subject->caption(), $council_resolution_edit->Subject->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($council_resolution_edit->Resolutionccategory->Required) { ?>
				elm = this.getElements("x" + infix + "_Resolutionccategory");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $council_resolution_edit->Resolutionccategory->caption(), $council_resolution_edit->Resolutionccategory->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($council_resolution_edit->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $council_resolution_edit->LACode->caption(), $council_resolution_edit->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($council_resolution_edit->ResolutionNo->Required) { ?>
				elm = this.getElements("x" + infix + "_ResolutionNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $council_resolution_edit->ResolutionNo->caption(), $council_resolution_edit->ResolutionNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($council_resolution_edit->Resolution->Required) { ?>
				elm = this.getElements("x" + infix + "_Resolution");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $council_resolution_edit->Resolution->caption(), $council_resolution_edit->Resolution->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($council_resolution_edit->Responsibility->Required) { ?>
				elm = this.getElements("x" + infix + "_Responsibility");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $council_resolution_edit->Responsibility->caption(), $council_resolution_edit->Responsibility->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($council_resolution_edit->ActionDate->Required) { ?>
				elm = this.getElements("x" + infix + "_ActionDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $council_resolution_edit->ActionDate->caption(), $council_resolution_edit->ActionDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ActionDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($council_resolution_edit->ActionDate->errorMessage()) ?>");

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
	fcouncil_resolutionedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcouncil_resolutionedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fcouncil_resolutionedit.lists["x_MeetingNo"] = <?php echo $council_resolution_edit->MeetingNo->Lookup->toClientList($council_resolution_edit) ?>;
	fcouncil_resolutionedit.lists["x_MeetingNo"].options = <?php echo JsonEncode($council_resolution_edit->MeetingNo->lookupOptions()) ?>;
	fcouncil_resolutionedit.autoSuggests["x_MeetingNo"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fcouncil_resolutionedit.lists["x_Resolutionccategory"] = <?php echo $council_resolution_edit->Resolutionccategory->Lookup->toClientList($council_resolution_edit) ?>;
	fcouncil_resolutionedit.lists["x_Resolutionccategory"].options = <?php echo JsonEncode($council_resolution_edit->Resolutionccategory->lookupOptions()) ?>;
	fcouncil_resolutionedit.lists["x_LACode"] = <?php echo $council_resolution_edit->LACode->Lookup->toClientList($council_resolution_edit) ?>;
	fcouncil_resolutionedit.lists["x_LACode"].options = <?php echo JsonEncode($council_resolution_edit->LACode->lookupOptions()) ?>;
	fcouncil_resolutionedit.autoSuggests["x_LACode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fcouncil_resolutionedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $council_resolution_edit->showPageHeader(); ?>
<?php
$council_resolution_edit->showMessage();
?>
<?php if (!$council_resolution_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $council_resolution_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fcouncil_resolutionedit" id="fcouncil_resolutionedit" class="<?php echo $council_resolution_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="council_resolution">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$council_resolution_edit->IsModal ?>">
<?php if ($council_resolution->getCurrentMasterTable() == "council_meeting") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="council_meeting">
<input type="hidden" name="fk_MeetingNo" value="<?php echo HtmlEncode($council_resolution_edit->MeetingNo->getSessionValue()) ?>">
<input type="hidden" name="fk_LACode" value="<?php echo HtmlEncode($council_resolution_edit->LACode->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($council_resolution_edit->MeetingNo->Visible) { // MeetingNo ?>
	<div id="r_MeetingNo" class="form-group row">
		<label id="elh_council_resolution_MeetingNo" class="<?php echo $council_resolution_edit->LeftColumnClass ?>"><?php echo $council_resolution_edit->MeetingNo->caption() ?><?php echo $council_resolution_edit->MeetingNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $council_resolution_edit->RightColumnClass ?>"><div <?php echo $council_resolution_edit->MeetingNo->cellAttributes() ?>>
<?php if ($council_resolution_edit->MeetingNo->getSessionValue() != "") { ?>
<span id="el_council_resolution_MeetingNo">
<span<?php echo $council_resolution_edit->MeetingNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($council_resolution_edit->MeetingNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_MeetingNo" name="x_MeetingNo" value="<?php echo HtmlEncode($council_resolution_edit->MeetingNo->CurrentValue) ?>">
<?php } else { ?>
<span id="el_council_resolution_MeetingNo">
<?php
$onchange = $council_resolution_edit->MeetingNo->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$council_resolution_edit->MeetingNo->EditAttrs["onchange"] = "";
?>
<span id="as_x_MeetingNo">
	<input type="text" class="form-control" name="sv_x_MeetingNo" id="sv_x_MeetingNo" value="<?php echo RemoveHtml($council_resolution_edit->MeetingNo->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($council_resolution_edit->MeetingNo->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($council_resolution_edit->MeetingNo->getPlaceHolder()) ?>"<?php echo $council_resolution_edit->MeetingNo->editAttributes() ?>>
</span>
<input type="hidden" data-table="council_resolution" data-field="x_MeetingNo" data-value-separator="<?php echo $council_resolution_edit->MeetingNo->displayValueSeparatorAttribute() ?>" name="x_MeetingNo" id="x_MeetingNo" value="<?php echo HtmlEncode($council_resolution_edit->MeetingNo->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fcouncil_resolutionedit"], function() {
	fcouncil_resolutionedit.createAutoSuggest({"id":"x_MeetingNo","forceSelect":false});
});
</script>
<?php echo $council_resolution_edit->MeetingNo->Lookup->getParamTag($council_resolution_edit, "p_x_MeetingNo") ?>
</span>
<?php } ?>
<?php echo $council_resolution_edit->MeetingNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($council_resolution_edit->MinuteNumber->Visible) { // MinuteNumber ?>
	<div id="r_MinuteNumber" class="form-group row">
		<label id="elh_council_resolution_MinuteNumber" for="x_MinuteNumber" class="<?php echo $council_resolution_edit->LeftColumnClass ?>"><?php echo $council_resolution_edit->MinuteNumber->caption() ?><?php echo $council_resolution_edit->MinuteNumber->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $council_resolution_edit->RightColumnClass ?>"><div <?php echo $council_resolution_edit->MinuteNumber->cellAttributes() ?>>
<span id="el_council_resolution_MinuteNumber">
<input type="text" data-table="council_resolution" data-field="x_MinuteNumber" name="x_MinuteNumber" id="x_MinuteNumber" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($council_resolution_edit->MinuteNumber->getPlaceHolder()) ?>" value="<?php echo $council_resolution_edit->MinuteNumber->EditValue ?>"<?php echo $council_resolution_edit->MinuteNumber->editAttributes() ?>>
</span>
<?php echo $council_resolution_edit->MinuteNumber->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($council_resolution_edit->Subject->Visible) { // Subject ?>
	<div id="r_Subject" class="form-group row">
		<label id="elh_council_resolution_Subject" for="x_Subject" class="<?php echo $council_resolution_edit->LeftColumnClass ?>"><?php echo $council_resolution_edit->Subject->caption() ?><?php echo $council_resolution_edit->Subject->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $council_resolution_edit->RightColumnClass ?>"><div <?php echo $council_resolution_edit->Subject->cellAttributes() ?>>
<span id="el_council_resolution_Subject">
<textarea data-table="council_resolution" data-field="x_Subject" name="x_Subject" id="x_Subject" cols="35" rows="4" placeholder="<?php echo HtmlEncode($council_resolution_edit->Subject->getPlaceHolder()) ?>"<?php echo $council_resolution_edit->Subject->editAttributes() ?>><?php echo $council_resolution_edit->Subject->EditValue ?></textarea>
</span>
<?php echo $council_resolution_edit->Subject->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($council_resolution_edit->Resolutionccategory->Visible) { // Resolutionccategory ?>
	<div id="r_Resolutionccategory" class="form-group row">
		<label id="elh_council_resolution_Resolutionccategory" for="x_Resolutionccategory" class="<?php echo $council_resolution_edit->LeftColumnClass ?>"><?php echo $council_resolution_edit->Resolutionccategory->caption() ?><?php echo $council_resolution_edit->Resolutionccategory->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $council_resolution_edit->RightColumnClass ?>"><div <?php echo $council_resolution_edit->Resolutionccategory->cellAttributes() ?>>
<span id="el_council_resolution_Resolutionccategory">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="council_resolution" data-field="x_Resolutionccategory" data-value-separator="<?php echo $council_resolution_edit->Resolutionccategory->displayValueSeparatorAttribute() ?>" id="x_Resolutionccategory" name="x_Resolutionccategory"<?php echo $council_resolution_edit->Resolutionccategory->editAttributes() ?>>
			<?php echo $council_resolution_edit->Resolutionccategory->selectOptionListHtml("x_Resolutionccategory") ?>
		</select>
</div>
<?php echo $council_resolution_edit->Resolutionccategory->Lookup->getParamTag($council_resolution_edit, "p_x_Resolutionccategory") ?>
</span>
<?php echo $council_resolution_edit->Resolutionccategory->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($council_resolution_edit->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label id="elh_council_resolution_LACode" class="<?php echo $council_resolution_edit->LeftColumnClass ?>"><?php echo $council_resolution_edit->LACode->caption() ?><?php echo $council_resolution_edit->LACode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $council_resolution_edit->RightColumnClass ?>"><div <?php echo $council_resolution_edit->LACode->cellAttributes() ?>>
<?php if ($council_resolution_edit->LACode->getSessionValue() != "") { ?>
<span id="el_council_resolution_LACode">
<span<?php echo $council_resolution_edit->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($council_resolution_edit->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_LACode" name="x_LACode" value="<?php echo HtmlEncode($council_resolution_edit->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_council_resolution_LACode">
<?php
$onchange = $council_resolution_edit->LACode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$council_resolution_edit->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x_LACode">
	<input type="text" class="form-control" name="sv_x_LACode" id="sv_x_LACode" value="<?php echo RemoveHtml($council_resolution_edit->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($council_resolution_edit->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($council_resolution_edit->LACode->getPlaceHolder()) ?>"<?php echo $council_resolution_edit->LACode->editAttributes() ?>>
</span>
<input type="hidden" data-table="council_resolution" data-field="x_LACode" data-value-separator="<?php echo $council_resolution_edit->LACode->displayValueSeparatorAttribute() ?>" name="x_LACode" id="x_LACode" value="<?php echo HtmlEncode($council_resolution_edit->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fcouncil_resolutionedit"], function() {
	fcouncil_resolutionedit.createAutoSuggest({"id":"x_LACode","forceSelect":false});
});
</script>
<?php echo $council_resolution_edit->LACode->Lookup->getParamTag($council_resolution_edit, "p_x_LACode") ?>
</span>
<?php } ?>
<?php echo $council_resolution_edit->LACode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($council_resolution_edit->ResolutionNo->Visible) { // ResolutionNo ?>
	<div id="r_ResolutionNo" class="form-group row">
		<label id="elh_council_resolution_ResolutionNo" class="<?php echo $council_resolution_edit->LeftColumnClass ?>"><?php echo $council_resolution_edit->ResolutionNo->caption() ?><?php echo $council_resolution_edit->ResolutionNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $council_resolution_edit->RightColumnClass ?>"><div <?php echo $council_resolution_edit->ResolutionNo->cellAttributes() ?>>
<span id="el_council_resolution_ResolutionNo">
<span<?php echo $council_resolution_edit->ResolutionNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($council_resolution_edit->ResolutionNo->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="council_resolution" data-field="x_ResolutionNo" name="x_ResolutionNo" id="x_ResolutionNo" value="<?php echo HtmlEncode($council_resolution_edit->ResolutionNo->CurrentValue) ?>">
<?php echo $council_resolution_edit->ResolutionNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($council_resolution_edit->Resolution->Visible) { // Resolution ?>
	<div id="r_Resolution" class="form-group row">
		<label id="elh_council_resolution_Resolution" for="x_Resolution" class="<?php echo $council_resolution_edit->LeftColumnClass ?>"><?php echo $council_resolution_edit->Resolution->caption() ?><?php echo $council_resolution_edit->Resolution->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $council_resolution_edit->RightColumnClass ?>"><div <?php echo $council_resolution_edit->Resolution->cellAttributes() ?>>
<span id="el_council_resolution_Resolution">
<textarea data-table="council_resolution" data-field="x_Resolution" name="x_Resolution" id="x_Resolution" cols="35" rows="4" placeholder="<?php echo HtmlEncode($council_resolution_edit->Resolution->getPlaceHolder()) ?>"<?php echo $council_resolution_edit->Resolution->editAttributes() ?>><?php echo $council_resolution_edit->Resolution->EditValue ?></textarea>
</span>
<?php echo $council_resolution_edit->Resolution->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($council_resolution_edit->Responsibility->Visible) { // Responsibility ?>
	<div id="r_Responsibility" class="form-group row">
		<label id="elh_council_resolution_Responsibility" for="x_Responsibility" class="<?php echo $council_resolution_edit->LeftColumnClass ?>"><?php echo $council_resolution_edit->Responsibility->caption() ?><?php echo $council_resolution_edit->Responsibility->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $council_resolution_edit->RightColumnClass ?>"><div <?php echo $council_resolution_edit->Responsibility->cellAttributes() ?>>
<span id="el_council_resolution_Responsibility">
<input type="text" data-table="council_resolution" data-field="x_Responsibility" name="x_Responsibility" id="x_Responsibility" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($council_resolution_edit->Responsibility->getPlaceHolder()) ?>" value="<?php echo $council_resolution_edit->Responsibility->EditValue ?>"<?php echo $council_resolution_edit->Responsibility->editAttributes() ?>>
</span>
<?php echo $council_resolution_edit->Responsibility->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($council_resolution_edit->ActionDate->Visible) { // ActionDate ?>
	<div id="r_ActionDate" class="form-group row">
		<label id="elh_council_resolution_ActionDate" for="x_ActionDate" class="<?php echo $council_resolution_edit->LeftColumnClass ?>"><?php echo $council_resolution_edit->ActionDate->caption() ?><?php echo $council_resolution_edit->ActionDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $council_resolution_edit->RightColumnClass ?>"><div <?php echo $council_resolution_edit->ActionDate->cellAttributes() ?>>
<span id="el_council_resolution_ActionDate">
<input type="text" data-table="council_resolution" data-field="x_ActionDate" name="x_ActionDate" id="x_ActionDate" placeholder="<?php echo HtmlEncode($council_resolution_edit->ActionDate->getPlaceHolder()) ?>" value="<?php echo $council_resolution_edit->ActionDate->EditValue ?>"<?php echo $council_resolution_edit->ActionDate->editAttributes() ?>>
<?php if (!$council_resolution_edit->ActionDate->ReadOnly && !$council_resolution_edit->ActionDate->Disabled && !isset($council_resolution_edit->ActionDate->EditAttrs["readonly"]) && !isset($council_resolution_edit->ActionDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcouncil_resolutionedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fcouncil_resolutionedit", "x_ActionDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $council_resolution_edit->ActionDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$council_resolution_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $council_resolution_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $council_resolution_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$council_resolution_edit->IsModal) { ?>
<?php echo $council_resolution_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$council_resolution_edit->showPageFooter();
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
$council_resolution_edit->terminate();
?>