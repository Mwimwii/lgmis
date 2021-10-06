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
$staffdisciplinary_action_add = new staffdisciplinary_action_add();

// Run the page
$staffdisciplinary_action_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$staffdisciplinary_action_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fstaffdisciplinary_actionadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fstaffdisciplinary_actionadd = currentForm = new ew.Form("fstaffdisciplinary_actionadd", "add");

	// Validate form
	fstaffdisciplinary_actionadd.validate = function() {
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
			<?php if ($staffdisciplinary_action_add->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_action_add->EmployeeID->caption(), $staffdisciplinary_action_add->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffdisciplinary_action_add->EmployeeID->errorMessage()) ?>");
			<?php if ($staffdisciplinary_action_add->OffenseCode->Required) { ?>
				elm = this.getElements("x" + infix + "_OffenseCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_action_add->OffenseCode->caption(), $staffdisciplinary_action_add->OffenseCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_OffenseCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffdisciplinary_action_add->OffenseCode->errorMessage()) ?>");
			<?php if ($staffdisciplinary_action_add->ActionTaken->Required) { ?>
				elm = this.getElements("x" + infix + "_ActionTaken");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_action_add->ActionTaken->caption(), $staffdisciplinary_action_add->ActionTaken->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffdisciplinary_action_add->ActionDescription->Required) { ?>
				elm = this.getElements("x" + infix + "_ActionDescription");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_action_add->ActionDescription->caption(), $staffdisciplinary_action_add->ActionDescription->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffdisciplinary_action_add->ActionDate->Required) { ?>
				elm = this.getElements("x" + infix + "_ActionDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_action_add->ActionDate->caption(), $staffdisciplinary_action_add->ActionDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ActionDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffdisciplinary_action_add->ActionDate->errorMessage()) ?>");
			<?php if ($staffdisciplinary_action_add->FromDate->Required) { ?>
				elm = this.getElements("x" + infix + "_FromDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_action_add->FromDate->caption(), $staffdisciplinary_action_add->FromDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_FromDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffdisciplinary_action_add->FromDate->errorMessage()) ?>");
			<?php if ($staffdisciplinary_action_add->ToDate->Required) { ?>
				elm = this.getElements("x" + infix + "_ToDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_action_add->ToDate->caption(), $staffdisciplinary_action_add->ToDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ToDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffdisciplinary_action_add->ToDate->errorMessage()) ?>");

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
	fstaffdisciplinary_actionadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fstaffdisciplinary_actionadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fstaffdisciplinary_actionadd.lists["x_ActionTaken"] = <?php echo $staffdisciplinary_action_add->ActionTaken->Lookup->toClientList($staffdisciplinary_action_add) ?>;
	fstaffdisciplinary_actionadd.lists["x_ActionTaken"].options = <?php echo JsonEncode($staffdisciplinary_action_add->ActionTaken->lookupOptions()) ?>;
	loadjs.done("fstaffdisciplinary_actionadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $staffdisciplinary_action_add->showPageHeader(); ?>
<?php
$staffdisciplinary_action_add->showMessage();
?>
<form name="fstaffdisciplinary_actionadd" id="fstaffdisciplinary_actionadd" class="<?php echo $staffdisciplinary_action_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="staffdisciplinary_action">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$staffdisciplinary_action_add->IsModal ?>">
<?php if ($staffdisciplinary_action->getCurrentMasterTable() == "staffdisciplinary_case") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="staffdisciplinary_case">
<input type="hidden" name="fk_EmployeeID" value="<?php echo HtmlEncode($staffdisciplinary_action_add->EmployeeID->getSessionValue()) ?>">
<input type="hidden" name="fk_CaseNo" value="<?php echo HtmlEncode($staffdisciplinary_action_add->CaseNo->getSessionValue()) ?>">
<?php } ?>
<?php if ($staffdisciplinary_action->getCurrentMasterTable() == "staff") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="staff">
<input type="hidden" name="fk_EmployeeID" value="<?php echo HtmlEncode($staffdisciplinary_action_add->EmployeeID->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($staffdisciplinary_action_add->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label id="elh_staffdisciplinary_action_EmployeeID" for="x_EmployeeID" class="<?php echo $staffdisciplinary_action_add->LeftColumnClass ?>"><?php echo $staffdisciplinary_action_add->EmployeeID->caption() ?><?php echo $staffdisciplinary_action_add->EmployeeID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffdisciplinary_action_add->RightColumnClass ?>"><div <?php echo $staffdisciplinary_action_add->EmployeeID->cellAttributes() ?>>
<?php if ($staffdisciplinary_action_add->EmployeeID->getSessionValue() != "") { ?>
<span id="el_staffdisciplinary_action_EmployeeID">
<span<?php echo $staffdisciplinary_action_add->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffdisciplinary_action_add->EmployeeID->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_EmployeeID" name="x_EmployeeID" value="<?php echo HtmlEncode($staffdisciplinary_action_add->EmployeeID->CurrentValue) ?>">
<?php } else { ?>
<span id="el_staffdisciplinary_action_EmployeeID">
<input type="text" data-table="staffdisciplinary_action" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($staffdisciplinary_action_add->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_action_add->EmployeeID->EditValue ?>"<?php echo $staffdisciplinary_action_add->EmployeeID->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $staffdisciplinary_action_add->EmployeeID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffdisciplinary_action_add->OffenseCode->Visible) { // OffenseCode ?>
	<div id="r_OffenseCode" class="form-group row">
		<label id="elh_staffdisciplinary_action_OffenseCode" for="x_OffenseCode" class="<?php echo $staffdisciplinary_action_add->LeftColumnClass ?>"><?php echo $staffdisciplinary_action_add->OffenseCode->caption() ?><?php echo $staffdisciplinary_action_add->OffenseCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffdisciplinary_action_add->RightColumnClass ?>"><div <?php echo $staffdisciplinary_action_add->OffenseCode->cellAttributes() ?>>
<span id="el_staffdisciplinary_action_OffenseCode">
<input type="text" data-table="staffdisciplinary_action" data-field="x_OffenseCode" name="x_OffenseCode" id="x_OffenseCode" size="30" placeholder="<?php echo HtmlEncode($staffdisciplinary_action_add->OffenseCode->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_action_add->OffenseCode->EditValue ?>"<?php echo $staffdisciplinary_action_add->OffenseCode->editAttributes() ?>>
</span>
<?php echo $staffdisciplinary_action_add->OffenseCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffdisciplinary_action_add->ActionTaken->Visible) { // ActionTaken ?>
	<div id="r_ActionTaken" class="form-group row">
		<label id="elh_staffdisciplinary_action_ActionTaken" for="x_ActionTaken" class="<?php echo $staffdisciplinary_action_add->LeftColumnClass ?>"><?php echo $staffdisciplinary_action_add->ActionTaken->caption() ?><?php echo $staffdisciplinary_action_add->ActionTaken->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffdisciplinary_action_add->RightColumnClass ?>"><div <?php echo $staffdisciplinary_action_add->ActionTaken->cellAttributes() ?>>
<span id="el_staffdisciplinary_action_ActionTaken">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffdisciplinary_action" data-field="x_ActionTaken" data-value-separator="<?php echo $staffdisciplinary_action_add->ActionTaken->displayValueSeparatorAttribute() ?>" id="x_ActionTaken" name="x_ActionTaken"<?php echo $staffdisciplinary_action_add->ActionTaken->editAttributes() ?>>
			<?php echo $staffdisciplinary_action_add->ActionTaken->selectOptionListHtml("x_ActionTaken") ?>
		</select>
</div>
<?php echo $staffdisciplinary_action_add->ActionTaken->Lookup->getParamTag($staffdisciplinary_action_add, "p_x_ActionTaken") ?>
</span>
<?php echo $staffdisciplinary_action_add->ActionTaken->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffdisciplinary_action_add->ActionDescription->Visible) { // ActionDescription ?>
	<div id="r_ActionDescription" class="form-group row">
		<label id="elh_staffdisciplinary_action_ActionDescription" for="x_ActionDescription" class="<?php echo $staffdisciplinary_action_add->LeftColumnClass ?>"><?php echo $staffdisciplinary_action_add->ActionDescription->caption() ?><?php echo $staffdisciplinary_action_add->ActionDescription->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffdisciplinary_action_add->RightColumnClass ?>"><div <?php echo $staffdisciplinary_action_add->ActionDescription->cellAttributes() ?>>
<span id="el_staffdisciplinary_action_ActionDescription">
<textarea data-table="staffdisciplinary_action" data-field="x_ActionDescription" name="x_ActionDescription" id="x_ActionDescription" cols="35" rows="4" placeholder="<?php echo HtmlEncode($staffdisciplinary_action_add->ActionDescription->getPlaceHolder()) ?>"<?php echo $staffdisciplinary_action_add->ActionDescription->editAttributes() ?>><?php echo $staffdisciplinary_action_add->ActionDescription->EditValue ?></textarea>
</span>
<?php echo $staffdisciplinary_action_add->ActionDescription->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffdisciplinary_action_add->ActionDate->Visible) { // ActionDate ?>
	<div id="r_ActionDate" class="form-group row">
		<label id="elh_staffdisciplinary_action_ActionDate" for="x_ActionDate" class="<?php echo $staffdisciplinary_action_add->LeftColumnClass ?>"><?php echo $staffdisciplinary_action_add->ActionDate->caption() ?><?php echo $staffdisciplinary_action_add->ActionDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffdisciplinary_action_add->RightColumnClass ?>"><div <?php echo $staffdisciplinary_action_add->ActionDate->cellAttributes() ?>>
<span id="el_staffdisciplinary_action_ActionDate">
<input type="text" data-table="staffdisciplinary_action" data-field="x_ActionDate" name="x_ActionDate" id="x_ActionDate" placeholder="<?php echo HtmlEncode($staffdisciplinary_action_add->ActionDate->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_action_add->ActionDate->EditValue ?>"<?php echo $staffdisciplinary_action_add->ActionDate->editAttributes() ?>>
<?php if (!$staffdisciplinary_action_add->ActionDate->ReadOnly && !$staffdisciplinary_action_add->ActionDate->Disabled && !isset($staffdisciplinary_action_add->ActionDate->EditAttrs["readonly"]) && !isset($staffdisciplinary_action_add->ActionDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_actionadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_actionadd", "x_ActionDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $staffdisciplinary_action_add->ActionDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffdisciplinary_action_add->FromDate->Visible) { // FromDate ?>
	<div id="r_FromDate" class="form-group row">
		<label id="elh_staffdisciplinary_action_FromDate" for="x_FromDate" class="<?php echo $staffdisciplinary_action_add->LeftColumnClass ?>"><?php echo $staffdisciplinary_action_add->FromDate->caption() ?><?php echo $staffdisciplinary_action_add->FromDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffdisciplinary_action_add->RightColumnClass ?>"><div <?php echo $staffdisciplinary_action_add->FromDate->cellAttributes() ?>>
<span id="el_staffdisciplinary_action_FromDate">
<input type="text" data-table="staffdisciplinary_action" data-field="x_FromDate" name="x_FromDate" id="x_FromDate" placeholder="<?php echo HtmlEncode($staffdisciplinary_action_add->FromDate->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_action_add->FromDate->EditValue ?>"<?php echo $staffdisciplinary_action_add->FromDate->editAttributes() ?>>
<?php if (!$staffdisciplinary_action_add->FromDate->ReadOnly && !$staffdisciplinary_action_add->FromDate->Disabled && !isset($staffdisciplinary_action_add->FromDate->EditAttrs["readonly"]) && !isset($staffdisciplinary_action_add->FromDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_actionadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_actionadd", "x_FromDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $staffdisciplinary_action_add->FromDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffdisciplinary_action_add->ToDate->Visible) { // ToDate ?>
	<div id="r_ToDate" class="form-group row">
		<label id="elh_staffdisciplinary_action_ToDate" for="x_ToDate" class="<?php echo $staffdisciplinary_action_add->LeftColumnClass ?>"><?php echo $staffdisciplinary_action_add->ToDate->caption() ?><?php echo $staffdisciplinary_action_add->ToDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffdisciplinary_action_add->RightColumnClass ?>"><div <?php echo $staffdisciplinary_action_add->ToDate->cellAttributes() ?>>
<span id="el_staffdisciplinary_action_ToDate">
<input type="text" data-table="staffdisciplinary_action" data-field="x_ToDate" name="x_ToDate" id="x_ToDate" placeholder="<?php echo HtmlEncode($staffdisciplinary_action_add->ToDate->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_action_add->ToDate->EditValue ?>"<?php echo $staffdisciplinary_action_add->ToDate->editAttributes() ?>>
<?php if (!$staffdisciplinary_action_add->ToDate->ReadOnly && !$staffdisciplinary_action_add->ToDate->Disabled && !isset($staffdisciplinary_action_add->ToDate->EditAttrs["readonly"]) && !isset($staffdisciplinary_action_add->ToDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_actionadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_actionadd", "x_ToDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $staffdisciplinary_action_add->ToDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<?php if (strval($staffdisciplinary_action_add->CaseNo->getSessionValue()) != "") { ?>
	<input type="hidden" name="x_CaseNo" id="x_CaseNo" value="<?php echo HtmlEncode(strval($staffdisciplinary_action_add->CaseNo->getSessionValue())) ?>">
	<?php } ?>
<?php if (!$staffdisciplinary_action_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $staffdisciplinary_action_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $staffdisciplinary_action_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$staffdisciplinary_action_add->showPageFooter();
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
$staffdisciplinary_action_add->terminate();
?>