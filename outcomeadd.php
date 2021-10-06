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
$outcome_add = new outcome_add();

// Run the page
$outcome_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$outcome_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var foutcomeadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	foutcomeadd = currentForm = new ew.Form("foutcomeadd", "add");

	// Validate form
	foutcomeadd.validate = function() {
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
			<?php if ($outcome_add->OutcomeName->Required) { ?>
				elm = this.getElements("x" + infix + "_OutcomeName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $outcome_add->OutcomeName->caption(), $outcome_add->OutcomeName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($outcome_add->StrategicObjectiveCode->Required) { ?>
				elm = this.getElements("x" + infix + "_StrategicObjectiveCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $outcome_add->StrategicObjectiveCode->caption(), $outcome_add->StrategicObjectiveCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_StrategicObjectiveCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($outcome_add->StrategicObjectiveCode->errorMessage()) ?>");
			<?php if ($outcome_add->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $outcome_add->LACode->caption(), $outcome_add->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($outcome_add->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $outcome_add->DepartmentCode->caption(), $outcome_add->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($outcome_add->OutcomeKPI->Required) { ?>
				elm = this.getElements("x" + infix + "_OutcomeKPI");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $outcome_add->OutcomeKPI->caption(), $outcome_add->OutcomeKPI->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($outcome_add->Assumptions->Required) { ?>
				elm = this.getElements("x" + infix + "_Assumptions");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $outcome_add->Assumptions->caption(), $outcome_add->Assumptions->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($outcome_add->ResponsibleOfficer->Required) { ?>
				elm = this.getElements("x" + infix + "_ResponsibleOfficer");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $outcome_add->ResponsibleOfficer->caption(), $outcome_add->ResponsibleOfficer->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($outcome_add->OutcomeStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_OutcomeStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $outcome_add->OutcomeStatus->caption(), $outcome_add->OutcomeStatus->RequiredErrorMessage)) ?>");
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
	foutcomeadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	foutcomeadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	foutcomeadd.lists["x_StrategicObjectiveCode"] = <?php echo $outcome_add->StrategicObjectiveCode->Lookup->toClientList($outcome_add) ?>;
	foutcomeadd.lists["x_StrategicObjectiveCode"].options = <?php echo JsonEncode($outcome_add->StrategicObjectiveCode->lookupOptions()) ?>;
	foutcomeadd.autoSuggests["x_StrategicObjectiveCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	foutcomeadd.lists["x_LACode"] = <?php echo $outcome_add->LACode->Lookup->toClientList($outcome_add) ?>;
	foutcomeadd.lists["x_LACode"].options = <?php echo JsonEncode($outcome_add->LACode->lookupOptions()) ?>;
	foutcomeadd.autoSuggests["x_LACode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	foutcomeadd.lists["x_DepartmentCode"] = <?php echo $outcome_add->DepartmentCode->Lookup->toClientList($outcome_add) ?>;
	foutcomeadd.lists["x_DepartmentCode"].options = <?php echo JsonEncode($outcome_add->DepartmentCode->lookupOptions()) ?>;
	foutcomeadd.lists["x_OutcomeStatus"] = <?php echo $outcome_add->OutcomeStatus->Lookup->toClientList($outcome_add) ?>;
	foutcomeadd.lists["x_OutcomeStatus"].options = <?php echo JsonEncode($outcome_add->OutcomeStatus->lookupOptions()) ?>;
	loadjs.done("foutcomeadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $outcome_add->showPageHeader(); ?>
<?php
$outcome_add->showMessage();
?>
<form name="foutcomeadd" id="foutcomeadd" class="<?php echo $outcome_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="outcome">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$outcome_add->IsModal ?>">
<?php if ($outcome->getCurrentMasterTable() == "strategic_objective") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="strategic_objective">
<input type="hidden" name="fk_LACode" value="<?php echo HtmlEncode($outcome_add->LACode->getSessionValue()) ?>">
<input type="hidden" name="fk_StrategicObjectiveCode" value="<?php echo HtmlEncode($outcome_add->StrategicObjectiveCode->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($outcome_add->OutcomeName->Visible) { // OutcomeName ?>
	<div id="r_OutcomeName" class="form-group row">
		<label id="elh_outcome_OutcomeName" for="x_OutcomeName" class="<?php echo $outcome_add->LeftColumnClass ?>"><?php echo $outcome_add->OutcomeName->caption() ?><?php echo $outcome_add->OutcomeName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $outcome_add->RightColumnClass ?>"><div <?php echo $outcome_add->OutcomeName->cellAttributes() ?>>
<span id="el_outcome_OutcomeName">
<textarea data-table="outcome" data-field="x_OutcomeName" name="x_OutcomeName" id="x_OutcomeName" cols="35" rows="4" placeholder="<?php echo HtmlEncode($outcome_add->OutcomeName->getPlaceHolder()) ?>"<?php echo $outcome_add->OutcomeName->editAttributes() ?>><?php echo $outcome_add->OutcomeName->EditValue ?></textarea>
</span>
<?php echo $outcome_add->OutcomeName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($outcome_add->StrategicObjectiveCode->Visible) { // StrategicObjectiveCode ?>
	<div id="r_StrategicObjectiveCode" class="form-group row">
		<label id="elh_outcome_StrategicObjectiveCode" class="<?php echo $outcome_add->LeftColumnClass ?>"><?php echo $outcome_add->StrategicObjectiveCode->caption() ?><?php echo $outcome_add->StrategicObjectiveCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $outcome_add->RightColumnClass ?>"><div <?php echo $outcome_add->StrategicObjectiveCode->cellAttributes() ?>>
<?php if ($outcome_add->StrategicObjectiveCode->getSessionValue() != "") { ?>
<span id="el_outcome_StrategicObjectiveCode">
<span<?php echo $outcome_add->StrategicObjectiveCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($outcome_add->StrategicObjectiveCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_StrategicObjectiveCode" name="x_StrategicObjectiveCode" value="<?php echo HtmlEncode($outcome_add->StrategicObjectiveCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_outcome_StrategicObjectiveCode">
<?php
$onchange = $outcome_add->StrategicObjectiveCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$outcome_add->StrategicObjectiveCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_StrategicObjectiveCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_StrategicObjectiveCode" id="sv_x_StrategicObjectiveCode" value="<?php echo RemoveHtml($outcome_add->StrategicObjectiveCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($outcome_add->StrategicObjectiveCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($outcome_add->StrategicObjectiveCode->getPlaceHolder()) ?>"<?php echo $outcome_add->StrategicObjectiveCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($outcome_add->StrategicObjectiveCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_StrategicObjectiveCode',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($outcome_add->StrategicObjectiveCode->ReadOnly || $outcome_add->StrategicObjectiveCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="outcome" data-field="x_StrategicObjectiveCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $outcome_add->StrategicObjectiveCode->displayValueSeparatorAttribute() ?>" name="x_StrategicObjectiveCode" id="x_StrategicObjectiveCode" value="<?php echo HtmlEncode($outcome_add->StrategicObjectiveCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutcomeadd"], function() {
	foutcomeadd.createAutoSuggest({"id":"x_StrategicObjectiveCode","forceSelect":true});
});
</script>
<?php echo $outcome_add->StrategicObjectiveCode->Lookup->getParamTag($outcome_add, "p_x_StrategicObjectiveCode") ?>
</span>
<?php } ?>
<?php echo $outcome_add->StrategicObjectiveCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($outcome_add->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label id="elh_outcome_LACode" class="<?php echo $outcome_add->LeftColumnClass ?>"><?php echo $outcome_add->LACode->caption() ?><?php echo $outcome_add->LACode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $outcome_add->RightColumnClass ?>"><div <?php echo $outcome_add->LACode->cellAttributes() ?>>
<?php if ($outcome_add->LACode->getSessionValue() != "") { ?>
<span id="el_outcome_LACode">
<span<?php echo $outcome_add->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($outcome_add->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_LACode" name="x_LACode" value="<?php echo HtmlEncode($outcome_add->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_outcome_LACode">
<?php
$onchange = $outcome_add->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$outcome_add->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x_LACode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_LACode" id="sv_x_LACode" value="<?php echo RemoveHtml($outcome_add->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($outcome_add->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($outcome_add->LACode->getPlaceHolder()) ?>"<?php echo $outcome_add->LACode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($outcome_add->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_LACode',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($outcome_add->LACode->ReadOnly || $outcome_add->LACode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="outcome" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $outcome_add->LACode->displayValueSeparatorAttribute() ?>" name="x_LACode" id="x_LACode" value="<?php echo HtmlEncode($outcome_add->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutcomeadd"], function() {
	foutcomeadd.createAutoSuggest({"id":"x_LACode","forceSelect":true});
});
</script>
<?php echo $outcome_add->LACode->Lookup->getParamTag($outcome_add, "p_x_LACode") ?>
</span>
<?php } ?>
<?php echo $outcome_add->LACode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($outcome_add->DepartmentCode->Visible) { // DepartmentCode ?>
	<div id="r_DepartmentCode" class="form-group row">
		<label id="elh_outcome_DepartmentCode" for="x_DepartmentCode" class="<?php echo $outcome_add->LeftColumnClass ?>"><?php echo $outcome_add->DepartmentCode->caption() ?><?php echo $outcome_add->DepartmentCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $outcome_add->RightColumnClass ?>"><div <?php echo $outcome_add->DepartmentCode->cellAttributes() ?>>
<span id="el_outcome_DepartmentCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_DepartmentCode"><?php echo EmptyValue(strval($outcome_add->DepartmentCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $outcome_add->DepartmentCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($outcome_add->DepartmentCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($outcome_add->DepartmentCode->ReadOnly || $outcome_add->DepartmentCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_DepartmentCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $outcome_add->DepartmentCode->Lookup->getParamTag($outcome_add, "p_x_DepartmentCode") ?>
<input type="hidden" data-table="outcome" data-field="x_DepartmentCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $outcome_add->DepartmentCode->displayValueSeparatorAttribute() ?>" name="x_DepartmentCode" id="x_DepartmentCode" value="<?php echo $outcome_add->DepartmentCode->CurrentValue ?>"<?php echo $outcome_add->DepartmentCode->editAttributes() ?>>
</span>
<?php echo $outcome_add->DepartmentCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($outcome_add->OutcomeKPI->Visible) { // OutcomeKPI ?>
	<div id="r_OutcomeKPI" class="form-group row">
		<label id="elh_outcome_OutcomeKPI" for="x_OutcomeKPI" class="<?php echo $outcome_add->LeftColumnClass ?>"><?php echo $outcome_add->OutcomeKPI->caption() ?><?php echo $outcome_add->OutcomeKPI->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $outcome_add->RightColumnClass ?>"><div <?php echo $outcome_add->OutcomeKPI->cellAttributes() ?>>
<span id="el_outcome_OutcomeKPI">
<textarea data-table="outcome" data-field="x_OutcomeKPI" name="x_OutcomeKPI" id="x_OutcomeKPI" cols="50" rows="2" placeholder="<?php echo HtmlEncode($outcome_add->OutcomeKPI->getPlaceHolder()) ?>"<?php echo $outcome_add->OutcomeKPI->editAttributes() ?>><?php echo $outcome_add->OutcomeKPI->EditValue ?></textarea>
</span>
<?php echo $outcome_add->OutcomeKPI->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($outcome_add->Assumptions->Visible) { // Assumptions ?>
	<div id="r_Assumptions" class="form-group row">
		<label id="elh_outcome_Assumptions" for="x_Assumptions" class="<?php echo $outcome_add->LeftColumnClass ?>"><?php echo $outcome_add->Assumptions->caption() ?><?php echo $outcome_add->Assumptions->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $outcome_add->RightColumnClass ?>"><div <?php echo $outcome_add->Assumptions->cellAttributes() ?>>
<span id="el_outcome_Assumptions">
<textarea data-table="outcome" data-field="x_Assumptions" name="x_Assumptions" id="x_Assumptions" cols="50" rows="2" placeholder="<?php echo HtmlEncode($outcome_add->Assumptions->getPlaceHolder()) ?>"<?php echo $outcome_add->Assumptions->editAttributes() ?>><?php echo $outcome_add->Assumptions->EditValue ?></textarea>
</span>
<?php echo $outcome_add->Assumptions->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($outcome_add->ResponsibleOfficer->Visible) { // ResponsibleOfficer ?>
	<div id="r_ResponsibleOfficer" class="form-group row">
		<label id="elh_outcome_ResponsibleOfficer" for="x_ResponsibleOfficer" class="<?php echo $outcome_add->LeftColumnClass ?>"><?php echo $outcome_add->ResponsibleOfficer->caption() ?><?php echo $outcome_add->ResponsibleOfficer->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $outcome_add->RightColumnClass ?>"><div <?php echo $outcome_add->ResponsibleOfficer->cellAttributes() ?>>
<span id="el_outcome_ResponsibleOfficer">
<input type="text" data-table="outcome" data-field="x_ResponsibleOfficer" name="x_ResponsibleOfficer" id="x_ResponsibleOfficer" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($outcome_add->ResponsibleOfficer->getPlaceHolder()) ?>" value="<?php echo $outcome_add->ResponsibleOfficer->EditValue ?>"<?php echo $outcome_add->ResponsibleOfficer->editAttributes() ?>>
</span>
<?php echo $outcome_add->ResponsibleOfficer->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($outcome_add->OutcomeStatus->Visible) { // OutcomeStatus ?>
	<div id="r_OutcomeStatus" class="form-group row">
		<label id="elh_outcome_OutcomeStatus" for="x_OutcomeStatus" class="<?php echo $outcome_add->LeftColumnClass ?>"><?php echo $outcome_add->OutcomeStatus->caption() ?><?php echo $outcome_add->OutcomeStatus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $outcome_add->RightColumnClass ?>"><div <?php echo $outcome_add->OutcomeStatus->cellAttributes() ?>>
<span id="el_outcome_OutcomeStatus">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="outcome" data-field="x_OutcomeStatus" data-value-separator="<?php echo $outcome_add->OutcomeStatus->displayValueSeparatorAttribute() ?>" id="x_OutcomeStatus" name="x_OutcomeStatus"<?php echo $outcome_add->OutcomeStatus->editAttributes() ?>>
			<?php echo $outcome_add->OutcomeStatus->selectOptionListHtml("x_OutcomeStatus") ?>
		</select>
</div>
<?php echo $outcome_add->OutcomeStatus->Lookup->getParamTag($outcome_add, "p_x_OutcomeStatus") ?>
</span>
<?php echo $outcome_add->OutcomeStatus->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("output", explode(",", $outcome->getCurrentDetailTable())) && $output->DetailAdd) {
?>
<?php if ($outcome->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("output", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "outputgrid.php" ?>
<?php } ?>
<?php if (!$outcome_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $outcome_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $outcome_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$outcome_add->showPageFooter();
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
$outcome_add->terminate();
?>