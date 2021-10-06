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
$outcome_edit = new outcome_edit();

// Run the page
$outcome_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$outcome_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var foutcomeedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	foutcomeedit = currentForm = new ew.Form("foutcomeedit", "edit");

	// Validate form
	foutcomeedit.validate = function() {
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
			<?php if ($outcome_edit->OutcomeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_OutcomeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $outcome_edit->OutcomeCode->caption(), $outcome_edit->OutcomeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($outcome_edit->OutcomeName->Required) { ?>
				elm = this.getElements("x" + infix + "_OutcomeName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $outcome_edit->OutcomeName->caption(), $outcome_edit->OutcomeName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($outcome_edit->StrategicObjectiveCode->Required) { ?>
				elm = this.getElements("x" + infix + "_StrategicObjectiveCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $outcome_edit->StrategicObjectiveCode->caption(), $outcome_edit->StrategicObjectiveCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_StrategicObjectiveCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($outcome_edit->StrategicObjectiveCode->errorMessage()) ?>");
			<?php if ($outcome_edit->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $outcome_edit->LACode->caption(), $outcome_edit->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($outcome_edit->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $outcome_edit->DepartmentCode->caption(), $outcome_edit->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($outcome_edit->OutcomeKPI->Required) { ?>
				elm = this.getElements("x" + infix + "_OutcomeKPI");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $outcome_edit->OutcomeKPI->caption(), $outcome_edit->OutcomeKPI->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($outcome_edit->Assumptions->Required) { ?>
				elm = this.getElements("x" + infix + "_Assumptions");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $outcome_edit->Assumptions->caption(), $outcome_edit->Assumptions->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($outcome_edit->ResponsibleOfficer->Required) { ?>
				elm = this.getElements("x" + infix + "_ResponsibleOfficer");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $outcome_edit->ResponsibleOfficer->caption(), $outcome_edit->ResponsibleOfficer->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($outcome_edit->OutcomeStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_OutcomeStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $outcome_edit->OutcomeStatus->caption(), $outcome_edit->OutcomeStatus->RequiredErrorMessage)) ?>");
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
	foutcomeedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	foutcomeedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	foutcomeedit.lists["x_StrategicObjectiveCode"] = <?php echo $outcome_edit->StrategicObjectiveCode->Lookup->toClientList($outcome_edit) ?>;
	foutcomeedit.lists["x_StrategicObjectiveCode"].options = <?php echo JsonEncode($outcome_edit->StrategicObjectiveCode->lookupOptions()) ?>;
	foutcomeedit.autoSuggests["x_StrategicObjectiveCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	foutcomeedit.lists["x_LACode"] = <?php echo $outcome_edit->LACode->Lookup->toClientList($outcome_edit) ?>;
	foutcomeedit.lists["x_LACode"].options = <?php echo JsonEncode($outcome_edit->LACode->lookupOptions()) ?>;
	foutcomeedit.autoSuggests["x_LACode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	foutcomeedit.lists["x_DepartmentCode"] = <?php echo $outcome_edit->DepartmentCode->Lookup->toClientList($outcome_edit) ?>;
	foutcomeedit.lists["x_DepartmentCode"].options = <?php echo JsonEncode($outcome_edit->DepartmentCode->lookupOptions()) ?>;
	foutcomeedit.lists["x_OutcomeStatus"] = <?php echo $outcome_edit->OutcomeStatus->Lookup->toClientList($outcome_edit) ?>;
	foutcomeedit.lists["x_OutcomeStatus"].options = <?php echo JsonEncode($outcome_edit->OutcomeStatus->lookupOptions()) ?>;
	loadjs.done("foutcomeedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $outcome_edit->showPageHeader(); ?>
<?php
$outcome_edit->showMessage();
?>
<?php if (!$outcome_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $outcome_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="foutcomeedit" id="foutcomeedit" class="<?php echo $outcome_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="outcome">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$outcome_edit->IsModal ?>">
<?php if ($outcome->getCurrentMasterTable() == "strategic_objective") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="strategic_objective">
<input type="hidden" name="fk_LACode" value="<?php echo HtmlEncode($outcome_edit->LACode->getSessionValue()) ?>">
<input type="hidden" name="fk_StrategicObjectiveCode" value="<?php echo HtmlEncode($outcome_edit->StrategicObjectiveCode->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($outcome_edit->OutcomeCode->Visible) { // OutcomeCode ?>
	<div id="r_OutcomeCode" class="form-group row">
		<label id="elh_outcome_OutcomeCode" class="<?php echo $outcome_edit->LeftColumnClass ?>"><?php echo $outcome_edit->OutcomeCode->caption() ?><?php echo $outcome_edit->OutcomeCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $outcome_edit->RightColumnClass ?>"><div <?php echo $outcome_edit->OutcomeCode->cellAttributes() ?>>
<span id="el_outcome_OutcomeCode">
<span<?php echo $outcome_edit->OutcomeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($outcome_edit->OutcomeCode->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="outcome" data-field="x_OutcomeCode" name="x_OutcomeCode" id="x_OutcomeCode" value="<?php echo HtmlEncode($outcome_edit->OutcomeCode->CurrentValue) ?>">
<?php echo $outcome_edit->OutcomeCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($outcome_edit->OutcomeName->Visible) { // OutcomeName ?>
	<div id="r_OutcomeName" class="form-group row">
		<label id="elh_outcome_OutcomeName" for="x_OutcomeName" class="<?php echo $outcome_edit->LeftColumnClass ?>"><?php echo $outcome_edit->OutcomeName->caption() ?><?php echo $outcome_edit->OutcomeName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $outcome_edit->RightColumnClass ?>"><div <?php echo $outcome_edit->OutcomeName->cellAttributes() ?>>
<span id="el_outcome_OutcomeName">
<textarea data-table="outcome" data-field="x_OutcomeName" name="x_OutcomeName" id="x_OutcomeName" cols="35" rows="4" placeholder="<?php echo HtmlEncode($outcome_edit->OutcomeName->getPlaceHolder()) ?>"<?php echo $outcome_edit->OutcomeName->editAttributes() ?>><?php echo $outcome_edit->OutcomeName->EditValue ?></textarea>
</span>
<?php echo $outcome_edit->OutcomeName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($outcome_edit->StrategicObjectiveCode->Visible) { // StrategicObjectiveCode ?>
	<div id="r_StrategicObjectiveCode" class="form-group row">
		<label id="elh_outcome_StrategicObjectiveCode" class="<?php echo $outcome_edit->LeftColumnClass ?>"><?php echo $outcome_edit->StrategicObjectiveCode->caption() ?><?php echo $outcome_edit->StrategicObjectiveCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $outcome_edit->RightColumnClass ?>"><div <?php echo $outcome_edit->StrategicObjectiveCode->cellAttributes() ?>>
<?php if ($outcome_edit->StrategicObjectiveCode->getSessionValue() != "") { ?>
<span id="el_outcome_StrategicObjectiveCode">
<span<?php echo $outcome_edit->StrategicObjectiveCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($outcome_edit->StrategicObjectiveCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_StrategicObjectiveCode" name="x_StrategicObjectiveCode" value="<?php echo HtmlEncode($outcome_edit->StrategicObjectiveCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_outcome_StrategicObjectiveCode">
<?php
$onchange = $outcome_edit->StrategicObjectiveCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$outcome_edit->StrategicObjectiveCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_StrategicObjectiveCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_StrategicObjectiveCode" id="sv_x_StrategicObjectiveCode" value="<?php echo RemoveHtml($outcome_edit->StrategicObjectiveCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($outcome_edit->StrategicObjectiveCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($outcome_edit->StrategicObjectiveCode->getPlaceHolder()) ?>"<?php echo $outcome_edit->StrategicObjectiveCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($outcome_edit->StrategicObjectiveCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_StrategicObjectiveCode',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($outcome_edit->StrategicObjectiveCode->ReadOnly || $outcome_edit->StrategicObjectiveCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="outcome" data-field="x_StrategicObjectiveCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $outcome_edit->StrategicObjectiveCode->displayValueSeparatorAttribute() ?>" name="x_StrategicObjectiveCode" id="x_StrategicObjectiveCode" value="<?php echo HtmlEncode($outcome_edit->StrategicObjectiveCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutcomeedit"], function() {
	foutcomeedit.createAutoSuggest({"id":"x_StrategicObjectiveCode","forceSelect":true});
});
</script>
<?php echo $outcome_edit->StrategicObjectiveCode->Lookup->getParamTag($outcome_edit, "p_x_StrategicObjectiveCode") ?>
</span>
<?php } ?>
<?php echo $outcome_edit->StrategicObjectiveCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($outcome_edit->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label id="elh_outcome_LACode" class="<?php echo $outcome_edit->LeftColumnClass ?>"><?php echo $outcome_edit->LACode->caption() ?><?php echo $outcome_edit->LACode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $outcome_edit->RightColumnClass ?>"><div <?php echo $outcome_edit->LACode->cellAttributes() ?>>
<?php if ($outcome_edit->LACode->getSessionValue() != "") { ?>
<span id="el_outcome_LACode">
<span<?php echo $outcome_edit->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($outcome_edit->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_LACode" name="x_LACode" value="<?php echo HtmlEncode($outcome_edit->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_outcome_LACode">
<?php
$onchange = $outcome_edit->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$outcome_edit->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x_LACode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_LACode" id="sv_x_LACode" value="<?php echo RemoveHtml($outcome_edit->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($outcome_edit->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($outcome_edit->LACode->getPlaceHolder()) ?>"<?php echo $outcome_edit->LACode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($outcome_edit->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_LACode',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($outcome_edit->LACode->ReadOnly || $outcome_edit->LACode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="outcome" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $outcome_edit->LACode->displayValueSeparatorAttribute() ?>" name="x_LACode" id="x_LACode" value="<?php echo HtmlEncode($outcome_edit->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutcomeedit"], function() {
	foutcomeedit.createAutoSuggest({"id":"x_LACode","forceSelect":true});
});
</script>
<?php echo $outcome_edit->LACode->Lookup->getParamTag($outcome_edit, "p_x_LACode") ?>
</span>
<?php } ?>
<?php echo $outcome_edit->LACode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($outcome_edit->DepartmentCode->Visible) { // DepartmentCode ?>
	<div id="r_DepartmentCode" class="form-group row">
		<label id="elh_outcome_DepartmentCode" for="x_DepartmentCode" class="<?php echo $outcome_edit->LeftColumnClass ?>"><?php echo $outcome_edit->DepartmentCode->caption() ?><?php echo $outcome_edit->DepartmentCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $outcome_edit->RightColumnClass ?>"><div <?php echo $outcome_edit->DepartmentCode->cellAttributes() ?>>
<span id="el_outcome_DepartmentCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_DepartmentCode"><?php echo EmptyValue(strval($outcome_edit->DepartmentCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $outcome_edit->DepartmentCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($outcome_edit->DepartmentCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($outcome_edit->DepartmentCode->ReadOnly || $outcome_edit->DepartmentCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_DepartmentCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $outcome_edit->DepartmentCode->Lookup->getParamTag($outcome_edit, "p_x_DepartmentCode") ?>
<input type="hidden" data-table="outcome" data-field="x_DepartmentCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $outcome_edit->DepartmentCode->displayValueSeparatorAttribute() ?>" name="x_DepartmentCode" id="x_DepartmentCode" value="<?php echo $outcome_edit->DepartmentCode->CurrentValue ?>"<?php echo $outcome_edit->DepartmentCode->editAttributes() ?>>
</span>
<?php echo $outcome_edit->DepartmentCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($outcome_edit->OutcomeKPI->Visible) { // OutcomeKPI ?>
	<div id="r_OutcomeKPI" class="form-group row">
		<label id="elh_outcome_OutcomeKPI" for="x_OutcomeKPI" class="<?php echo $outcome_edit->LeftColumnClass ?>"><?php echo $outcome_edit->OutcomeKPI->caption() ?><?php echo $outcome_edit->OutcomeKPI->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $outcome_edit->RightColumnClass ?>"><div <?php echo $outcome_edit->OutcomeKPI->cellAttributes() ?>>
<span id="el_outcome_OutcomeKPI">
<textarea data-table="outcome" data-field="x_OutcomeKPI" name="x_OutcomeKPI" id="x_OutcomeKPI" cols="50" rows="2" placeholder="<?php echo HtmlEncode($outcome_edit->OutcomeKPI->getPlaceHolder()) ?>"<?php echo $outcome_edit->OutcomeKPI->editAttributes() ?>><?php echo $outcome_edit->OutcomeKPI->EditValue ?></textarea>
</span>
<?php echo $outcome_edit->OutcomeKPI->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($outcome_edit->Assumptions->Visible) { // Assumptions ?>
	<div id="r_Assumptions" class="form-group row">
		<label id="elh_outcome_Assumptions" for="x_Assumptions" class="<?php echo $outcome_edit->LeftColumnClass ?>"><?php echo $outcome_edit->Assumptions->caption() ?><?php echo $outcome_edit->Assumptions->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $outcome_edit->RightColumnClass ?>"><div <?php echo $outcome_edit->Assumptions->cellAttributes() ?>>
<span id="el_outcome_Assumptions">
<textarea data-table="outcome" data-field="x_Assumptions" name="x_Assumptions" id="x_Assumptions" cols="50" rows="2" placeholder="<?php echo HtmlEncode($outcome_edit->Assumptions->getPlaceHolder()) ?>"<?php echo $outcome_edit->Assumptions->editAttributes() ?>><?php echo $outcome_edit->Assumptions->EditValue ?></textarea>
</span>
<?php echo $outcome_edit->Assumptions->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($outcome_edit->ResponsibleOfficer->Visible) { // ResponsibleOfficer ?>
	<div id="r_ResponsibleOfficer" class="form-group row">
		<label id="elh_outcome_ResponsibleOfficer" for="x_ResponsibleOfficer" class="<?php echo $outcome_edit->LeftColumnClass ?>"><?php echo $outcome_edit->ResponsibleOfficer->caption() ?><?php echo $outcome_edit->ResponsibleOfficer->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $outcome_edit->RightColumnClass ?>"><div <?php echo $outcome_edit->ResponsibleOfficer->cellAttributes() ?>>
<span id="el_outcome_ResponsibleOfficer">
<input type="text" data-table="outcome" data-field="x_ResponsibleOfficer" name="x_ResponsibleOfficer" id="x_ResponsibleOfficer" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($outcome_edit->ResponsibleOfficer->getPlaceHolder()) ?>" value="<?php echo $outcome_edit->ResponsibleOfficer->EditValue ?>"<?php echo $outcome_edit->ResponsibleOfficer->editAttributes() ?>>
</span>
<?php echo $outcome_edit->ResponsibleOfficer->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($outcome_edit->OutcomeStatus->Visible) { // OutcomeStatus ?>
	<div id="r_OutcomeStatus" class="form-group row">
		<label id="elh_outcome_OutcomeStatus" for="x_OutcomeStatus" class="<?php echo $outcome_edit->LeftColumnClass ?>"><?php echo $outcome_edit->OutcomeStatus->caption() ?><?php echo $outcome_edit->OutcomeStatus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $outcome_edit->RightColumnClass ?>"><div <?php echo $outcome_edit->OutcomeStatus->cellAttributes() ?>>
<span id="el_outcome_OutcomeStatus">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="outcome" data-field="x_OutcomeStatus" data-value-separator="<?php echo $outcome_edit->OutcomeStatus->displayValueSeparatorAttribute() ?>" id="x_OutcomeStatus" name="x_OutcomeStatus"<?php echo $outcome_edit->OutcomeStatus->editAttributes() ?>>
			<?php echo $outcome_edit->OutcomeStatus->selectOptionListHtml("x_OutcomeStatus") ?>
		</select>
</div>
<?php echo $outcome_edit->OutcomeStatus->Lookup->getParamTag($outcome_edit, "p_x_OutcomeStatus") ?>
</span>
<?php echo $outcome_edit->OutcomeStatus->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("output", explode(",", $outcome->getCurrentDetailTable())) && $output->DetailEdit) {
?>
<?php if ($outcome->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("output", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "outputgrid.php" ?>
<?php } ?>
<?php if (!$outcome_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $outcome_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $outcome_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$outcome_edit->IsModal) { ?>
<?php echo $outcome_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$outcome_edit->showPageFooter();
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
$outcome_edit->terminate();
?>