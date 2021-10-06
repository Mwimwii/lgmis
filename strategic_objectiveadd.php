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
$strategic_objective_add = new strategic_objective_add();

// Run the page
$strategic_objective_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$strategic_objective_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fstrategic_objectiveadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fstrategic_objectiveadd = currentForm = new ew.Form("fstrategic_objectiveadd", "add");

	// Validate form
	fstrategic_objectiveadd.validate = function() {
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
			<?php if ($strategic_objective_add->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $strategic_objective_add->LACode->caption(), $strategic_objective_add->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($strategic_objective_add->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $strategic_objective_add->DepartmentCode->caption(), $strategic_objective_add->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($strategic_objective_add->StrategicObjectiveName->Required) { ?>
				elm = this.getElements("x" + infix + "_StrategicObjectiveName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $strategic_objective_add->StrategicObjectiveName->caption(), $strategic_objective_add->StrategicObjectiveName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($strategic_objective_add->Description->Required) { ?>
				elm = this.getElements("x" + infix + "_Description");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $strategic_objective_add->Description->caption(), $strategic_objective_add->Description->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($strategic_objective_add->ReferencedDocs->Required) { ?>
				elm = this.getElements("x" + infix + "_ReferencedDocs");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $strategic_objective_add->ReferencedDocs->caption(), $strategic_objective_add->ReferencedDocs->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($strategic_objective_add->ResultAreaCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ResultAreaCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $strategic_objective_add->ResultAreaCode->caption(), $strategic_objective_add->ResultAreaCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ResultAreaCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($strategic_objective_add->ResultAreaCode->errorMessage()) ?>");

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
	fstrategic_objectiveadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fstrategic_objectiveadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fstrategic_objectiveadd.lists["x_LACode"] = <?php echo $strategic_objective_add->LACode->Lookup->toClientList($strategic_objective_add) ?>;
	fstrategic_objectiveadd.lists["x_LACode"].options = <?php echo JsonEncode($strategic_objective_add->LACode->lookupOptions()) ?>;
	fstrategic_objectiveadd.lists["x_DepartmentCode"] = <?php echo $strategic_objective_add->DepartmentCode->Lookup->toClientList($strategic_objective_add) ?>;
	fstrategic_objectiveadd.lists["x_DepartmentCode"].options = <?php echo JsonEncode($strategic_objective_add->DepartmentCode->lookupOptions()) ?>;
	loadjs.done("fstrategic_objectiveadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $strategic_objective_add->showPageHeader(); ?>
<?php
$strategic_objective_add->showMessage();
?>
<form name="fstrategic_objectiveadd" id="fstrategic_objectiveadd" class="<?php echo $strategic_objective_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="strategic_objective">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$strategic_objective_add->IsModal ?>">
<?php if ($strategic_objective->getCurrentMasterTable() == "local_authority") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="local_authority">
<input type="hidden" name="fk_LACode" value="<?php echo HtmlEncode($strategic_objective_add->LACode->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($strategic_objective_add->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label id="elh_strategic_objective_LACode" for="x_LACode" class="<?php echo $strategic_objective_add->LeftColumnClass ?>"><?php echo $strategic_objective_add->LACode->caption() ?><?php echo $strategic_objective_add->LACode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $strategic_objective_add->RightColumnClass ?>"><div <?php echo $strategic_objective_add->LACode->cellAttributes() ?>>
<?php if ($strategic_objective_add->LACode->getSessionValue() != "") { ?>
<span id="el_strategic_objective_LACode">
<span<?php echo $strategic_objective_add->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($strategic_objective_add->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_LACode" name="x_LACode" value="<?php echo HtmlEncode($strategic_objective_add->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_strategic_objective_LACode">
<?php $strategic_objective_add->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_LACode"><?php echo EmptyValue(strval($strategic_objective_add->LACode->ViewValue)) ? $Language->phrase("PleaseSelect") : $strategic_objective_add->LACode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($strategic_objective_add->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($strategic_objective_add->LACode->ReadOnly || $strategic_objective_add->LACode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_LACode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $strategic_objective_add->LACode->Lookup->getParamTag($strategic_objective_add, "p_x_LACode") ?>
<input type="hidden" data-table="strategic_objective" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $strategic_objective_add->LACode->displayValueSeparatorAttribute() ?>" name="x_LACode" id="x_LACode" value="<?php echo $strategic_objective_add->LACode->CurrentValue ?>"<?php echo $strategic_objective_add->LACode->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $strategic_objective_add->LACode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($strategic_objective_add->DepartmentCode->Visible) { // DepartmentCode ?>
	<div id="r_DepartmentCode" class="form-group row">
		<label id="elh_strategic_objective_DepartmentCode" for="x_DepartmentCode" class="<?php echo $strategic_objective_add->LeftColumnClass ?>"><?php echo $strategic_objective_add->DepartmentCode->caption() ?><?php echo $strategic_objective_add->DepartmentCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $strategic_objective_add->RightColumnClass ?>"><div <?php echo $strategic_objective_add->DepartmentCode->cellAttributes() ?>>
<span id="el_strategic_objective_DepartmentCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="strategic_objective" data-field="x_DepartmentCode" data-value-separator="<?php echo $strategic_objective_add->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x_DepartmentCode" name="x_DepartmentCode"<?php echo $strategic_objective_add->DepartmentCode->editAttributes() ?>>
			<?php echo $strategic_objective_add->DepartmentCode->selectOptionListHtml("x_DepartmentCode") ?>
		</select>
</div>
<?php echo $strategic_objective_add->DepartmentCode->Lookup->getParamTag($strategic_objective_add, "p_x_DepartmentCode") ?>
</span>
<?php echo $strategic_objective_add->DepartmentCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($strategic_objective_add->StrategicObjectiveName->Visible) { // StrategicObjectiveName ?>
	<div id="r_StrategicObjectiveName" class="form-group row">
		<label id="elh_strategic_objective_StrategicObjectiveName" for="x_StrategicObjectiveName" class="<?php echo $strategic_objective_add->LeftColumnClass ?>"><?php echo $strategic_objective_add->StrategicObjectiveName->caption() ?><?php echo $strategic_objective_add->StrategicObjectiveName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $strategic_objective_add->RightColumnClass ?>"><div <?php echo $strategic_objective_add->StrategicObjectiveName->cellAttributes() ?>>
<span id="el_strategic_objective_StrategicObjectiveName">
<textarea data-table="strategic_objective" data-field="x_StrategicObjectiveName" name="x_StrategicObjectiveName" id="x_StrategicObjectiveName" cols="50" rows="2" placeholder="<?php echo HtmlEncode($strategic_objective_add->StrategicObjectiveName->getPlaceHolder()) ?>"<?php echo $strategic_objective_add->StrategicObjectiveName->editAttributes() ?>><?php echo $strategic_objective_add->StrategicObjectiveName->EditValue ?></textarea>
</span>
<?php echo $strategic_objective_add->StrategicObjectiveName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($strategic_objective_add->Description->Visible) { // Description ?>
	<div id="r_Description" class="form-group row">
		<label id="elh_strategic_objective_Description" for="x_Description" class="<?php echo $strategic_objective_add->LeftColumnClass ?>"><?php echo $strategic_objective_add->Description->caption() ?><?php echo $strategic_objective_add->Description->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $strategic_objective_add->RightColumnClass ?>"><div <?php echo $strategic_objective_add->Description->cellAttributes() ?>>
<span id="el_strategic_objective_Description">
<textarea data-table="strategic_objective" data-field="x_Description" name="x_Description" id="x_Description" cols="35" rows="4" placeholder="<?php echo HtmlEncode($strategic_objective_add->Description->getPlaceHolder()) ?>"<?php echo $strategic_objective_add->Description->editAttributes() ?>><?php echo $strategic_objective_add->Description->EditValue ?></textarea>
</span>
<?php echo $strategic_objective_add->Description->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($strategic_objective_add->ReferencedDocs->Visible) { // ReferencedDocs ?>
	<div id="r_ReferencedDocs" class="form-group row">
		<label id="elh_strategic_objective_ReferencedDocs" for="x_ReferencedDocs" class="<?php echo $strategic_objective_add->LeftColumnClass ?>"><?php echo $strategic_objective_add->ReferencedDocs->caption() ?><?php echo $strategic_objective_add->ReferencedDocs->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $strategic_objective_add->RightColumnClass ?>"><div <?php echo $strategic_objective_add->ReferencedDocs->cellAttributes() ?>>
<span id="el_strategic_objective_ReferencedDocs">
<textarea data-table="strategic_objective" data-field="x_ReferencedDocs" name="x_ReferencedDocs" id="x_ReferencedDocs" cols="50" rows="2" placeholder="<?php echo HtmlEncode($strategic_objective_add->ReferencedDocs->getPlaceHolder()) ?>"<?php echo $strategic_objective_add->ReferencedDocs->editAttributes() ?>><?php echo $strategic_objective_add->ReferencedDocs->EditValue ?></textarea>
</span>
<?php echo $strategic_objective_add->ReferencedDocs->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($strategic_objective_add->ResultAreaCode->Visible) { // ResultAreaCode ?>
	<div id="r_ResultAreaCode" class="form-group row">
		<label id="elh_strategic_objective_ResultAreaCode" for="x_ResultAreaCode" class="<?php echo $strategic_objective_add->LeftColumnClass ?>"><?php echo $strategic_objective_add->ResultAreaCode->caption() ?><?php echo $strategic_objective_add->ResultAreaCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $strategic_objective_add->RightColumnClass ?>"><div <?php echo $strategic_objective_add->ResultAreaCode->cellAttributes() ?>>
<span id="el_strategic_objective_ResultAreaCode">
<input type="text" data-table="strategic_objective" data-field="x_ResultAreaCode" name="x_ResultAreaCode" id="x_ResultAreaCode" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($strategic_objective_add->ResultAreaCode->getPlaceHolder()) ?>" value="<?php echo $strategic_objective_add->ResultAreaCode->EditValue ?>"<?php echo $strategic_objective_add->ResultAreaCode->editAttributes() ?>>
</span>
<?php echo $strategic_objective_add->ResultAreaCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("outcome", explode(",", $strategic_objective->getCurrentDetailTable())) && $outcome->DetailAdd) {
?>
<?php if ($strategic_objective->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("outcome", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "outcomegrid.php" ?>
<?php } ?>
<?php if (!$strategic_objective_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $strategic_objective_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $strategic_objective_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$strategic_objective_add->showPageFooter();
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
$strategic_objective_add->terminate();
?>