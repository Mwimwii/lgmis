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
$staffdisciplinary_action_edit = new staffdisciplinary_action_edit();

// Run the page
$staffdisciplinary_action_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$staffdisciplinary_action_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fstaffdisciplinary_actionedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fstaffdisciplinary_actionedit = currentForm = new ew.Form("fstaffdisciplinary_actionedit", "edit");

	// Validate form
	fstaffdisciplinary_actionedit.validate = function() {
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
			<?php if ($staffdisciplinary_action_edit->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_action_edit->EmployeeID->caption(), $staffdisciplinary_action_edit->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffdisciplinary_action_edit->EmployeeID->errorMessage()) ?>");
			<?php if ($staffdisciplinary_action_edit->CaseNo->Required) { ?>
				elm = this.getElements("x" + infix + "_CaseNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_action_edit->CaseNo->caption(), $staffdisciplinary_action_edit->CaseNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffdisciplinary_action_edit->OffenseCode->Required) { ?>
				elm = this.getElements("x" + infix + "_OffenseCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_action_edit->OffenseCode->caption(), $staffdisciplinary_action_edit->OffenseCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_OffenseCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffdisciplinary_action_edit->OffenseCode->errorMessage()) ?>");
			<?php if ($staffdisciplinary_action_edit->ActionTaken->Required) { ?>
				elm = this.getElements("x" + infix + "_ActionTaken");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_action_edit->ActionTaken->caption(), $staffdisciplinary_action_edit->ActionTaken->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffdisciplinary_action_edit->ActionDescription->Required) { ?>
				elm = this.getElements("x" + infix + "_ActionDescription");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_action_edit->ActionDescription->caption(), $staffdisciplinary_action_edit->ActionDescription->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffdisciplinary_action_edit->ActionDate->Required) { ?>
				elm = this.getElements("x" + infix + "_ActionDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_action_edit->ActionDate->caption(), $staffdisciplinary_action_edit->ActionDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ActionDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffdisciplinary_action_edit->ActionDate->errorMessage()) ?>");
			<?php if ($staffdisciplinary_action_edit->FromDate->Required) { ?>
				elm = this.getElements("x" + infix + "_FromDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_action_edit->FromDate->caption(), $staffdisciplinary_action_edit->FromDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_FromDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffdisciplinary_action_edit->FromDate->errorMessage()) ?>");
			<?php if ($staffdisciplinary_action_edit->ToDate->Required) { ?>
				elm = this.getElements("x" + infix + "_ToDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_action_edit->ToDate->caption(), $staffdisciplinary_action_edit->ToDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ToDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffdisciplinary_action_edit->ToDate->errorMessage()) ?>");

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
	fstaffdisciplinary_actionedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fstaffdisciplinary_actionedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fstaffdisciplinary_actionedit.lists["x_ActionTaken"] = <?php echo $staffdisciplinary_action_edit->ActionTaken->Lookup->toClientList($staffdisciplinary_action_edit) ?>;
	fstaffdisciplinary_actionedit.lists["x_ActionTaken"].options = <?php echo JsonEncode($staffdisciplinary_action_edit->ActionTaken->lookupOptions()) ?>;
	loadjs.done("fstaffdisciplinary_actionedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $staffdisciplinary_action_edit->showPageHeader(); ?>
<?php
$staffdisciplinary_action_edit->showMessage();
?>
<?php if (!$staffdisciplinary_action_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $staffdisciplinary_action_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fstaffdisciplinary_actionedit" id="fstaffdisciplinary_actionedit" class="<?php echo $staffdisciplinary_action_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="staffdisciplinary_action">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$staffdisciplinary_action_edit->IsModal ?>">
<?php if ($staffdisciplinary_action->getCurrentMasterTable() == "staffdisciplinary_case") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="staffdisciplinary_case">
<input type="hidden" name="fk_EmployeeID" value="<?php echo HtmlEncode($staffdisciplinary_action_edit->EmployeeID->getSessionValue()) ?>">
<input type="hidden" name="fk_CaseNo" value="<?php echo HtmlEncode($staffdisciplinary_action_edit->CaseNo->getSessionValue()) ?>">
<?php } ?>
<?php if ($staffdisciplinary_action->getCurrentMasterTable() == "staff") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="staff">
<input type="hidden" name="fk_EmployeeID" value="<?php echo HtmlEncode($staffdisciplinary_action_edit->EmployeeID->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($staffdisciplinary_action_edit->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label id="elh_staffdisciplinary_action_EmployeeID" for="x_EmployeeID" class="<?php echo $staffdisciplinary_action_edit->LeftColumnClass ?>"><?php echo $staffdisciplinary_action_edit->EmployeeID->caption() ?><?php echo $staffdisciplinary_action_edit->EmployeeID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffdisciplinary_action_edit->RightColumnClass ?>"><div <?php echo $staffdisciplinary_action_edit->EmployeeID->cellAttributes() ?>>
<?php if ($staffdisciplinary_action_edit->EmployeeID->getSessionValue() != "") { ?>

<span id="el_staffdisciplinary_action_EmployeeID">
<span<?php echo $staffdisciplinary_action_edit->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffdisciplinary_action_edit->EmployeeID->EditValue)) ?>"></span>
</span>

<input type="hidden" id="x_EmployeeID" name="x_EmployeeID" value="<?php echo HtmlEncode($staffdisciplinary_action_edit->EmployeeID->CurrentValue) ?>">
<?php } else { ?>

<input type="text" data-table="staffdisciplinary_action" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($staffdisciplinary_action_edit->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_action_edit->EmployeeID->EditValue ?>"<?php echo $staffdisciplinary_action_edit->EmployeeID->editAttributes() ?>>

<?php } ?>

<input type="hidden" data-table="staffdisciplinary_action" data-field="x_EmployeeID" name="o_EmployeeID" id="o_EmployeeID" value="<?php echo HtmlEncode($staffdisciplinary_action_edit->EmployeeID->OldValue != null ? $staffdisciplinary_action_edit->EmployeeID->OldValue : $staffdisciplinary_action_edit->EmployeeID->CurrentValue) ?>">
<?php echo $staffdisciplinary_action_edit->EmployeeID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffdisciplinary_action_edit->CaseNo->Visible) { // CaseNo ?>
	<div id="r_CaseNo" class="form-group row">
		<label id="elh_staffdisciplinary_action_CaseNo" class="<?php echo $staffdisciplinary_action_edit->LeftColumnClass ?>"><?php echo $staffdisciplinary_action_edit->CaseNo->caption() ?><?php echo $staffdisciplinary_action_edit->CaseNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffdisciplinary_action_edit->RightColumnClass ?>"><div <?php echo $staffdisciplinary_action_edit->CaseNo->cellAttributes() ?>>
<span id="el_staffdisciplinary_action_CaseNo">
<span<?php echo $staffdisciplinary_action_edit->CaseNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffdisciplinary_action_edit->CaseNo->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="staffdisciplinary_action" data-field="x_CaseNo" name="x_CaseNo" id="x_CaseNo" value="<?php echo HtmlEncode($staffdisciplinary_action_edit->CaseNo->CurrentValue) ?>">
<?php echo $staffdisciplinary_action_edit->CaseNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffdisciplinary_action_edit->OffenseCode->Visible) { // OffenseCode ?>
	<div id="r_OffenseCode" class="form-group row">
		<label id="elh_staffdisciplinary_action_OffenseCode" for="x_OffenseCode" class="<?php echo $staffdisciplinary_action_edit->LeftColumnClass ?>"><?php echo $staffdisciplinary_action_edit->OffenseCode->caption() ?><?php echo $staffdisciplinary_action_edit->OffenseCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffdisciplinary_action_edit->RightColumnClass ?>"><div <?php echo $staffdisciplinary_action_edit->OffenseCode->cellAttributes() ?>>
<span id="el_staffdisciplinary_action_OffenseCode">
<input type="text" data-table="staffdisciplinary_action" data-field="x_OffenseCode" name="x_OffenseCode" id="x_OffenseCode" size="30" placeholder="<?php echo HtmlEncode($staffdisciplinary_action_edit->OffenseCode->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_action_edit->OffenseCode->EditValue ?>"<?php echo $staffdisciplinary_action_edit->OffenseCode->editAttributes() ?>>
</span>
<?php echo $staffdisciplinary_action_edit->OffenseCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffdisciplinary_action_edit->ActionTaken->Visible) { // ActionTaken ?>
	<div id="r_ActionTaken" class="form-group row">
		<label id="elh_staffdisciplinary_action_ActionTaken" for="x_ActionTaken" class="<?php echo $staffdisciplinary_action_edit->LeftColumnClass ?>"><?php echo $staffdisciplinary_action_edit->ActionTaken->caption() ?><?php echo $staffdisciplinary_action_edit->ActionTaken->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffdisciplinary_action_edit->RightColumnClass ?>"><div <?php echo $staffdisciplinary_action_edit->ActionTaken->cellAttributes() ?>>
<span id="el_staffdisciplinary_action_ActionTaken">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffdisciplinary_action" data-field="x_ActionTaken" data-value-separator="<?php echo $staffdisciplinary_action_edit->ActionTaken->displayValueSeparatorAttribute() ?>" id="x_ActionTaken" name="x_ActionTaken"<?php echo $staffdisciplinary_action_edit->ActionTaken->editAttributes() ?>>
			<?php echo $staffdisciplinary_action_edit->ActionTaken->selectOptionListHtml("x_ActionTaken") ?>
		</select>
</div>
<?php echo $staffdisciplinary_action_edit->ActionTaken->Lookup->getParamTag($staffdisciplinary_action_edit, "p_x_ActionTaken") ?>
</span>
<?php echo $staffdisciplinary_action_edit->ActionTaken->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffdisciplinary_action_edit->ActionDescription->Visible) { // ActionDescription ?>
	<div id="r_ActionDescription" class="form-group row">
		<label id="elh_staffdisciplinary_action_ActionDescription" for="x_ActionDescription" class="<?php echo $staffdisciplinary_action_edit->LeftColumnClass ?>"><?php echo $staffdisciplinary_action_edit->ActionDescription->caption() ?><?php echo $staffdisciplinary_action_edit->ActionDescription->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffdisciplinary_action_edit->RightColumnClass ?>"><div <?php echo $staffdisciplinary_action_edit->ActionDescription->cellAttributes() ?>>
<span id="el_staffdisciplinary_action_ActionDescription">
<textarea data-table="staffdisciplinary_action" data-field="x_ActionDescription" name="x_ActionDescription" id="x_ActionDescription" cols="35" rows="4" placeholder="<?php echo HtmlEncode($staffdisciplinary_action_edit->ActionDescription->getPlaceHolder()) ?>"<?php echo $staffdisciplinary_action_edit->ActionDescription->editAttributes() ?>><?php echo $staffdisciplinary_action_edit->ActionDescription->EditValue ?></textarea>
</span>
<?php echo $staffdisciplinary_action_edit->ActionDescription->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffdisciplinary_action_edit->ActionDate->Visible) { // ActionDate ?>
	<div id="r_ActionDate" class="form-group row">
		<label id="elh_staffdisciplinary_action_ActionDate" for="x_ActionDate" class="<?php echo $staffdisciplinary_action_edit->LeftColumnClass ?>"><?php echo $staffdisciplinary_action_edit->ActionDate->caption() ?><?php echo $staffdisciplinary_action_edit->ActionDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffdisciplinary_action_edit->RightColumnClass ?>"><div <?php echo $staffdisciplinary_action_edit->ActionDate->cellAttributes() ?>>
<span id="el_staffdisciplinary_action_ActionDate">
<input type="text" data-table="staffdisciplinary_action" data-field="x_ActionDate" name="x_ActionDate" id="x_ActionDate" placeholder="<?php echo HtmlEncode($staffdisciplinary_action_edit->ActionDate->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_action_edit->ActionDate->EditValue ?>"<?php echo $staffdisciplinary_action_edit->ActionDate->editAttributes() ?>>
<?php if (!$staffdisciplinary_action_edit->ActionDate->ReadOnly && !$staffdisciplinary_action_edit->ActionDate->Disabled && !isset($staffdisciplinary_action_edit->ActionDate->EditAttrs["readonly"]) && !isset($staffdisciplinary_action_edit->ActionDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_actionedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_actionedit", "x_ActionDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $staffdisciplinary_action_edit->ActionDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffdisciplinary_action_edit->FromDate->Visible) { // FromDate ?>
	<div id="r_FromDate" class="form-group row">
		<label id="elh_staffdisciplinary_action_FromDate" for="x_FromDate" class="<?php echo $staffdisciplinary_action_edit->LeftColumnClass ?>"><?php echo $staffdisciplinary_action_edit->FromDate->caption() ?><?php echo $staffdisciplinary_action_edit->FromDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffdisciplinary_action_edit->RightColumnClass ?>"><div <?php echo $staffdisciplinary_action_edit->FromDate->cellAttributes() ?>>
<span id="el_staffdisciplinary_action_FromDate">
<input type="text" data-table="staffdisciplinary_action" data-field="x_FromDate" name="x_FromDate" id="x_FromDate" placeholder="<?php echo HtmlEncode($staffdisciplinary_action_edit->FromDate->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_action_edit->FromDate->EditValue ?>"<?php echo $staffdisciplinary_action_edit->FromDate->editAttributes() ?>>
<?php if (!$staffdisciplinary_action_edit->FromDate->ReadOnly && !$staffdisciplinary_action_edit->FromDate->Disabled && !isset($staffdisciplinary_action_edit->FromDate->EditAttrs["readonly"]) && !isset($staffdisciplinary_action_edit->FromDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_actionedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_actionedit", "x_FromDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $staffdisciplinary_action_edit->FromDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffdisciplinary_action_edit->ToDate->Visible) { // ToDate ?>
	<div id="r_ToDate" class="form-group row">
		<label id="elh_staffdisciplinary_action_ToDate" for="x_ToDate" class="<?php echo $staffdisciplinary_action_edit->LeftColumnClass ?>"><?php echo $staffdisciplinary_action_edit->ToDate->caption() ?><?php echo $staffdisciplinary_action_edit->ToDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffdisciplinary_action_edit->RightColumnClass ?>"><div <?php echo $staffdisciplinary_action_edit->ToDate->cellAttributes() ?>>
<span id="el_staffdisciplinary_action_ToDate">
<input type="text" data-table="staffdisciplinary_action" data-field="x_ToDate" name="x_ToDate" id="x_ToDate" placeholder="<?php echo HtmlEncode($staffdisciplinary_action_edit->ToDate->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_action_edit->ToDate->EditValue ?>"<?php echo $staffdisciplinary_action_edit->ToDate->editAttributes() ?>>
<?php if (!$staffdisciplinary_action_edit->ToDate->ReadOnly && !$staffdisciplinary_action_edit->ToDate->Disabled && !isset($staffdisciplinary_action_edit->ToDate->EditAttrs["readonly"]) && !isset($staffdisciplinary_action_edit->ToDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_actionedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_actionedit", "x_ToDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $staffdisciplinary_action_edit->ToDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$staffdisciplinary_action_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $staffdisciplinary_action_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $staffdisciplinary_action_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$staffdisciplinary_action_edit->IsModal) { ?>
<?php echo $staffdisciplinary_action_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$staffdisciplinary_action_edit->showPageFooter();
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
$staffdisciplinary_action_edit->terminate();
?>