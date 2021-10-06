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
$staffdisciplinary_case_edit = new staffdisciplinary_case_edit();

// Run the page
$staffdisciplinary_case_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$staffdisciplinary_case_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fstaffdisciplinary_caseedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fstaffdisciplinary_caseedit = currentForm = new ew.Form("fstaffdisciplinary_caseedit", "edit");

	// Validate form
	fstaffdisciplinary_caseedit.validate = function() {
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
			<?php if ($staffdisciplinary_case_edit->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_case_edit->EmployeeID->caption(), $staffdisciplinary_case_edit->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffdisciplinary_case_edit->EmployeeID->errorMessage()) ?>");
			<?php if ($staffdisciplinary_case_edit->CaseNo->Required) { ?>
				elm = this.getElements("x" + infix + "_CaseNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_case_edit->CaseNo->caption(), $staffdisciplinary_case_edit->CaseNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffdisciplinary_case_edit->OffenseCode->Required) { ?>
				elm = this.getElements("x" + infix + "_OffenseCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_case_edit->OffenseCode->caption(), $staffdisciplinary_case_edit->OffenseCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffdisciplinary_case_edit->CaseDescription->Required) { ?>
				elm = this.getElements("x" + infix + "_CaseDescription");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_case_edit->CaseDescription->caption(), $staffdisciplinary_case_edit->CaseDescription->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffdisciplinary_case_edit->ActionTaken->Required) { ?>
				elm = this.getElements("x" + infix + "_ActionTaken");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_case_edit->ActionTaken->caption(), $staffdisciplinary_case_edit->ActionTaken->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffdisciplinary_case_edit->OffenseDate->Required) { ?>
				elm = this.getElements("x" + infix + "_OffenseDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_case_edit->OffenseDate->caption(), $staffdisciplinary_case_edit->OffenseDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_OffenseDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffdisciplinary_case_edit->OffenseDate->errorMessage()) ?>");
			<?php if ($staffdisciplinary_case_edit->ActionDate->Required) { ?>
				elm = this.getElements("x" + infix + "_ActionDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_case_edit->ActionDate->caption(), $staffdisciplinary_case_edit->ActionDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ActionDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffdisciplinary_case_edit->ActionDate->errorMessage()) ?>");
			<?php if ($staffdisciplinary_case_edit->DateOfAppealLetter->Required) { ?>
				elm = this.getElements("x" + infix + "_DateOfAppealLetter");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_case_edit->DateOfAppealLetter->caption(), $staffdisciplinary_case_edit->DateOfAppealLetter->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateOfAppealLetter");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffdisciplinary_case_edit->DateOfAppealLetter->errorMessage()) ?>");
			<?php if ($staffdisciplinary_case_edit->DateAppealReceived->Required) { ?>
				elm = this.getElements("x" + infix + "_DateAppealReceived");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_case_edit->DateAppealReceived->caption(), $staffdisciplinary_case_edit->DateAppealReceived->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateAppealReceived");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffdisciplinary_case_edit->DateAppealReceived->errorMessage()) ?>");
			<?php if ($staffdisciplinary_case_edit->DateConcluded->Required) { ?>
				elm = this.getElements("x" + infix + "_DateConcluded");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_case_edit->DateConcluded->caption(), $staffdisciplinary_case_edit->DateConcluded->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateConcluded");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffdisciplinary_case_edit->DateConcluded->errorMessage()) ?>");
			<?php if ($staffdisciplinary_case_edit->AppealStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_AppealStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_case_edit->AppealStatus->caption(), $staffdisciplinary_case_edit->AppealStatus->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffdisciplinary_case_edit->DiciplinaryHearing->Required) { ?>
				elm = this.getElements("x" + infix + "_DiciplinaryHearing");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_case_edit->DiciplinaryHearing->caption(), $staffdisciplinary_case_edit->DiciplinaryHearing->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffdisciplinary_case_edit->AppealNotes->Required) { ?>
				elm = this.getElements("x" + infix + "_AppealNotes");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_case_edit->AppealNotes->caption(), $staffdisciplinary_case_edit->AppealNotes->RequiredErrorMessage)) ?>");
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
	fstaffdisciplinary_caseedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fstaffdisciplinary_caseedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fstaffdisciplinary_caseedit.lists["x_OffenseCode"] = <?php echo $staffdisciplinary_case_edit->OffenseCode->Lookup->toClientList($staffdisciplinary_case_edit) ?>;
	fstaffdisciplinary_caseedit.lists["x_OffenseCode"].options = <?php echo JsonEncode($staffdisciplinary_case_edit->OffenseCode->lookupOptions()) ?>;
	fstaffdisciplinary_caseedit.lists["x_ActionTaken"] = <?php echo $staffdisciplinary_case_edit->ActionTaken->Lookup->toClientList($staffdisciplinary_case_edit) ?>;
	fstaffdisciplinary_caseedit.lists["x_ActionTaken"].options = <?php echo JsonEncode($staffdisciplinary_case_edit->ActionTaken->lookupOptions()) ?>;
	fstaffdisciplinary_caseedit.lists["x_AppealStatus"] = <?php echo $staffdisciplinary_case_edit->AppealStatus->Lookup->toClientList($staffdisciplinary_case_edit) ?>;
	fstaffdisciplinary_caseedit.lists["x_AppealStatus"].options = <?php echo JsonEncode($staffdisciplinary_case_edit->AppealStatus->lookupOptions()) ?>;
	loadjs.done("fstaffdisciplinary_caseedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $staffdisciplinary_case_edit->showPageHeader(); ?>
<?php
$staffdisciplinary_case_edit->showMessage();
?>
<?php if (!$staffdisciplinary_case_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $staffdisciplinary_case_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fstaffdisciplinary_caseedit" id="fstaffdisciplinary_caseedit" class="<?php echo $staffdisciplinary_case_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="staffdisciplinary_case">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$staffdisciplinary_case_edit->IsModal ?>">
<?php if ($staffdisciplinary_case->getCurrentMasterTable() == "staff") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="staff">
<input type="hidden" name="fk_EmployeeID" value="<?php echo HtmlEncode($staffdisciplinary_case_edit->EmployeeID->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($staffdisciplinary_case_edit->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label id="elh_staffdisciplinary_case_EmployeeID" for="x_EmployeeID" class="<?php echo $staffdisciplinary_case_edit->LeftColumnClass ?>"><?php echo $staffdisciplinary_case_edit->EmployeeID->caption() ?><?php echo $staffdisciplinary_case_edit->EmployeeID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffdisciplinary_case_edit->RightColumnClass ?>"><div <?php echo $staffdisciplinary_case_edit->EmployeeID->cellAttributes() ?>>
<?php if ($staffdisciplinary_case_edit->EmployeeID->getSessionValue() != "") { ?>

<span id="el_staffdisciplinary_case_EmployeeID">
<span<?php echo $staffdisciplinary_case_edit->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffdisciplinary_case_edit->EmployeeID->EditValue)) ?>"></span>
</span>

<input type="hidden" id="x_EmployeeID" name="x_EmployeeID" value="<?php echo HtmlEncode($staffdisciplinary_case_edit->EmployeeID->CurrentValue) ?>">
<?php } else { ?>

<input type="text" data-table="staffdisciplinary_case" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($staffdisciplinary_case_edit->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_case_edit->EmployeeID->EditValue ?>"<?php echo $staffdisciplinary_case_edit->EmployeeID->editAttributes() ?>>

<?php } ?>

<input type="hidden" data-table="staffdisciplinary_case" data-field="x_EmployeeID" name="o_EmployeeID" id="o_EmployeeID" value="<?php echo HtmlEncode($staffdisciplinary_case_edit->EmployeeID->OldValue != null ? $staffdisciplinary_case_edit->EmployeeID->OldValue : $staffdisciplinary_case_edit->EmployeeID->CurrentValue) ?>">
<?php echo $staffdisciplinary_case_edit->EmployeeID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffdisciplinary_case_edit->CaseNo->Visible) { // CaseNo ?>
	<div id="r_CaseNo" class="form-group row">
		<label id="elh_staffdisciplinary_case_CaseNo" class="<?php echo $staffdisciplinary_case_edit->LeftColumnClass ?>"><?php echo $staffdisciplinary_case_edit->CaseNo->caption() ?><?php echo $staffdisciplinary_case_edit->CaseNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffdisciplinary_case_edit->RightColumnClass ?>"><div <?php echo $staffdisciplinary_case_edit->CaseNo->cellAttributes() ?>>
<span id="el_staffdisciplinary_case_CaseNo">
<span<?php echo $staffdisciplinary_case_edit->CaseNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffdisciplinary_case_edit->CaseNo->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_CaseNo" name="x_CaseNo" id="x_CaseNo" value="<?php echo HtmlEncode($staffdisciplinary_case_edit->CaseNo->CurrentValue) ?>">
<?php echo $staffdisciplinary_case_edit->CaseNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffdisciplinary_case_edit->OffenseCode->Visible) { // OffenseCode ?>
	<div id="r_OffenseCode" class="form-group row">
		<label id="elh_staffdisciplinary_case_OffenseCode" class="<?php echo $staffdisciplinary_case_edit->LeftColumnClass ?>"><?php echo $staffdisciplinary_case_edit->OffenseCode->caption() ?><?php echo $staffdisciplinary_case_edit->OffenseCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffdisciplinary_case_edit->RightColumnClass ?>"><div <?php echo $staffdisciplinary_case_edit->OffenseCode->cellAttributes() ?>>
<?php $staffdisciplinary_case_edit->OffenseCode->EditAttrs->prepend("onclick", "ew.autoFill(this);"); ?>
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($staffdisciplinary_case_edit->OffenseCode->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $staffdisciplinary_case_edit->OffenseCode->ViewValue ?></button>
		<div id="dsl_x_OffenseCode" data-repeatcolumn="5" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $staffdisciplinary_case_edit->OffenseCode->radioButtonListHtml(TRUE, "x_OffenseCode") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_OffenseCode" class="ew-template"><input type="radio" class="custom-control-input" data-table="staffdisciplinary_case" data-field="x_OffenseCode" data-value-separator="<?php echo $staffdisciplinary_case_edit->OffenseCode->displayValueSeparatorAttribute() ?>" name="x_OffenseCode" id="x_OffenseCode" value="{value}"<?php echo $staffdisciplinary_case_edit->OffenseCode->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$staffdisciplinary_case_edit->OffenseCode->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
<?php echo $staffdisciplinary_case_edit->OffenseCode->Lookup->getParamTag($staffdisciplinary_case_edit, "p_x_OffenseCode") ?>
<input type="hidden" data-table="staffdisciplinary_case" data-field="x_OffenseCode" name="o_OffenseCode" id="o_OffenseCode" value="<?php echo HtmlEncode($staffdisciplinary_case_edit->OffenseCode->OldValue != null ? $staffdisciplinary_case_edit->OffenseCode->OldValue : $staffdisciplinary_case_edit->OffenseCode->CurrentValue) ?>">
<?php echo $staffdisciplinary_case_edit->OffenseCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffdisciplinary_case_edit->CaseDescription->Visible) { // CaseDescription ?>
	<div id="r_CaseDescription" class="form-group row">
		<label id="elh_staffdisciplinary_case_CaseDescription" for="x_CaseDescription" class="<?php echo $staffdisciplinary_case_edit->LeftColumnClass ?>"><?php echo $staffdisciplinary_case_edit->CaseDescription->caption() ?><?php echo $staffdisciplinary_case_edit->CaseDescription->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffdisciplinary_case_edit->RightColumnClass ?>"><div <?php echo $staffdisciplinary_case_edit->CaseDescription->cellAttributes() ?>>
<span id="el_staffdisciplinary_case_CaseDescription">
<textarea data-table="staffdisciplinary_case" data-field="x_CaseDescription" name="x_CaseDescription" id="x_CaseDescription" cols="35" rows="4" placeholder="<?php echo HtmlEncode($staffdisciplinary_case_edit->CaseDescription->getPlaceHolder()) ?>"<?php echo $staffdisciplinary_case_edit->CaseDescription->editAttributes() ?>><?php echo $staffdisciplinary_case_edit->CaseDescription->EditValue ?></textarea>
</span>
<?php echo $staffdisciplinary_case_edit->CaseDescription->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffdisciplinary_case_edit->ActionTaken->Visible) { // ActionTaken ?>
	<div id="r_ActionTaken" class="form-group row">
		<label id="elh_staffdisciplinary_case_ActionTaken" for="x_ActionTaken" class="<?php echo $staffdisciplinary_case_edit->LeftColumnClass ?>"><?php echo $staffdisciplinary_case_edit->ActionTaken->caption() ?><?php echo $staffdisciplinary_case_edit->ActionTaken->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffdisciplinary_case_edit->RightColumnClass ?>"><div <?php echo $staffdisciplinary_case_edit->ActionTaken->cellAttributes() ?>>
<span id="el_staffdisciplinary_case_ActionTaken">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffdisciplinary_case" data-field="x_ActionTaken" data-value-separator="<?php echo $staffdisciplinary_case_edit->ActionTaken->displayValueSeparatorAttribute() ?>" id="x_ActionTaken" name="x_ActionTaken"<?php echo $staffdisciplinary_case_edit->ActionTaken->editAttributes() ?>>
			<?php echo $staffdisciplinary_case_edit->ActionTaken->selectOptionListHtml("x_ActionTaken") ?>
		</select>
</div>
<?php echo $staffdisciplinary_case_edit->ActionTaken->Lookup->getParamTag($staffdisciplinary_case_edit, "p_x_ActionTaken") ?>
</span>
<?php echo $staffdisciplinary_case_edit->ActionTaken->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffdisciplinary_case_edit->OffenseDate->Visible) { // OffenseDate ?>
	<div id="r_OffenseDate" class="form-group row">
		<label id="elh_staffdisciplinary_case_OffenseDate" for="x_OffenseDate" class="<?php echo $staffdisciplinary_case_edit->LeftColumnClass ?>"><?php echo $staffdisciplinary_case_edit->OffenseDate->caption() ?><?php echo $staffdisciplinary_case_edit->OffenseDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffdisciplinary_case_edit->RightColumnClass ?>"><div <?php echo $staffdisciplinary_case_edit->OffenseDate->cellAttributes() ?>>
<span id="el_staffdisciplinary_case_OffenseDate">
<input type="text" data-table="staffdisciplinary_case" data-field="x_OffenseDate" name="x_OffenseDate" id="x_OffenseDate" placeholder="<?php echo HtmlEncode($staffdisciplinary_case_edit->OffenseDate->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_case_edit->OffenseDate->EditValue ?>"<?php echo $staffdisciplinary_case_edit->OffenseDate->editAttributes() ?>>
<?php if (!$staffdisciplinary_case_edit->OffenseDate->ReadOnly && !$staffdisciplinary_case_edit->OffenseDate->Disabled && !isset($staffdisciplinary_case_edit->OffenseDate->EditAttrs["readonly"]) && !isset($staffdisciplinary_case_edit->OffenseDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_caseedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_caseedit", "x_OffenseDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $staffdisciplinary_case_edit->OffenseDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffdisciplinary_case_edit->ActionDate->Visible) { // ActionDate ?>
	<div id="r_ActionDate" class="form-group row">
		<label id="elh_staffdisciplinary_case_ActionDate" for="x_ActionDate" class="<?php echo $staffdisciplinary_case_edit->LeftColumnClass ?>"><?php echo $staffdisciplinary_case_edit->ActionDate->caption() ?><?php echo $staffdisciplinary_case_edit->ActionDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffdisciplinary_case_edit->RightColumnClass ?>"><div <?php echo $staffdisciplinary_case_edit->ActionDate->cellAttributes() ?>>
<span id="el_staffdisciplinary_case_ActionDate">
<input type="text" data-table="staffdisciplinary_case" data-field="x_ActionDate" name="x_ActionDate" id="x_ActionDate" placeholder="<?php echo HtmlEncode($staffdisciplinary_case_edit->ActionDate->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_case_edit->ActionDate->EditValue ?>"<?php echo $staffdisciplinary_case_edit->ActionDate->editAttributes() ?>>
<?php if (!$staffdisciplinary_case_edit->ActionDate->ReadOnly && !$staffdisciplinary_case_edit->ActionDate->Disabled && !isset($staffdisciplinary_case_edit->ActionDate->EditAttrs["readonly"]) && !isset($staffdisciplinary_case_edit->ActionDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_caseedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_caseedit", "x_ActionDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $staffdisciplinary_case_edit->ActionDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffdisciplinary_case_edit->DateOfAppealLetter->Visible) { // DateOfAppealLetter ?>
	<div id="r_DateOfAppealLetter" class="form-group row">
		<label id="elh_staffdisciplinary_case_DateOfAppealLetter" for="x_DateOfAppealLetter" class="<?php echo $staffdisciplinary_case_edit->LeftColumnClass ?>"><?php echo $staffdisciplinary_case_edit->DateOfAppealLetter->caption() ?><?php echo $staffdisciplinary_case_edit->DateOfAppealLetter->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffdisciplinary_case_edit->RightColumnClass ?>"><div <?php echo $staffdisciplinary_case_edit->DateOfAppealLetter->cellAttributes() ?>>
<span id="el_staffdisciplinary_case_DateOfAppealLetter">
<input type="text" data-table="staffdisciplinary_case" data-field="x_DateOfAppealLetter" name="x_DateOfAppealLetter" id="x_DateOfAppealLetter" placeholder="<?php echo HtmlEncode($staffdisciplinary_case_edit->DateOfAppealLetter->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_case_edit->DateOfAppealLetter->EditValue ?>"<?php echo $staffdisciplinary_case_edit->DateOfAppealLetter->editAttributes() ?>>
<?php if (!$staffdisciplinary_case_edit->DateOfAppealLetter->ReadOnly && !$staffdisciplinary_case_edit->DateOfAppealLetter->Disabled && !isset($staffdisciplinary_case_edit->DateOfAppealLetter->EditAttrs["readonly"]) && !isset($staffdisciplinary_case_edit->DateOfAppealLetter->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_caseedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_caseedit", "x_DateOfAppealLetter", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $staffdisciplinary_case_edit->DateOfAppealLetter->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffdisciplinary_case_edit->DateAppealReceived->Visible) { // DateAppealReceived ?>
	<div id="r_DateAppealReceived" class="form-group row">
		<label id="elh_staffdisciplinary_case_DateAppealReceived" for="x_DateAppealReceived" class="<?php echo $staffdisciplinary_case_edit->LeftColumnClass ?>"><?php echo $staffdisciplinary_case_edit->DateAppealReceived->caption() ?><?php echo $staffdisciplinary_case_edit->DateAppealReceived->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffdisciplinary_case_edit->RightColumnClass ?>"><div <?php echo $staffdisciplinary_case_edit->DateAppealReceived->cellAttributes() ?>>
<span id="el_staffdisciplinary_case_DateAppealReceived">
<input type="text" data-table="staffdisciplinary_case" data-field="x_DateAppealReceived" name="x_DateAppealReceived" id="x_DateAppealReceived" placeholder="<?php echo HtmlEncode($staffdisciplinary_case_edit->DateAppealReceived->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_case_edit->DateAppealReceived->EditValue ?>"<?php echo $staffdisciplinary_case_edit->DateAppealReceived->editAttributes() ?>>
<?php if (!$staffdisciplinary_case_edit->DateAppealReceived->ReadOnly && !$staffdisciplinary_case_edit->DateAppealReceived->Disabled && !isset($staffdisciplinary_case_edit->DateAppealReceived->EditAttrs["readonly"]) && !isset($staffdisciplinary_case_edit->DateAppealReceived->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_caseedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_caseedit", "x_DateAppealReceived", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $staffdisciplinary_case_edit->DateAppealReceived->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffdisciplinary_case_edit->DateConcluded->Visible) { // DateConcluded ?>
	<div id="r_DateConcluded" class="form-group row">
		<label id="elh_staffdisciplinary_case_DateConcluded" for="x_DateConcluded" class="<?php echo $staffdisciplinary_case_edit->LeftColumnClass ?>"><?php echo $staffdisciplinary_case_edit->DateConcluded->caption() ?><?php echo $staffdisciplinary_case_edit->DateConcluded->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffdisciplinary_case_edit->RightColumnClass ?>"><div <?php echo $staffdisciplinary_case_edit->DateConcluded->cellAttributes() ?>>
<span id="el_staffdisciplinary_case_DateConcluded">
<input type="text" data-table="staffdisciplinary_case" data-field="x_DateConcluded" name="x_DateConcluded" id="x_DateConcluded" placeholder="<?php echo HtmlEncode($staffdisciplinary_case_edit->DateConcluded->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_case_edit->DateConcluded->EditValue ?>"<?php echo $staffdisciplinary_case_edit->DateConcluded->editAttributes() ?>>
<?php if (!$staffdisciplinary_case_edit->DateConcluded->ReadOnly && !$staffdisciplinary_case_edit->DateConcluded->Disabled && !isset($staffdisciplinary_case_edit->DateConcluded->EditAttrs["readonly"]) && !isset($staffdisciplinary_case_edit->DateConcluded->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_caseedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_caseedit", "x_DateConcluded", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $staffdisciplinary_case_edit->DateConcluded->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffdisciplinary_case_edit->AppealStatus->Visible) { // AppealStatus ?>
	<div id="r_AppealStatus" class="form-group row">
		<label id="elh_staffdisciplinary_case_AppealStatus" for="x_AppealStatus" class="<?php echo $staffdisciplinary_case_edit->LeftColumnClass ?>"><?php echo $staffdisciplinary_case_edit->AppealStatus->caption() ?><?php echo $staffdisciplinary_case_edit->AppealStatus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffdisciplinary_case_edit->RightColumnClass ?>"><div <?php echo $staffdisciplinary_case_edit->AppealStatus->cellAttributes() ?>>
<span id="el_staffdisciplinary_case_AppealStatus">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffdisciplinary_case" data-field="x_AppealStatus" data-value-separator="<?php echo $staffdisciplinary_case_edit->AppealStatus->displayValueSeparatorAttribute() ?>" id="x_AppealStatus" name="x_AppealStatus"<?php echo $staffdisciplinary_case_edit->AppealStatus->editAttributes() ?>>
			<?php echo $staffdisciplinary_case_edit->AppealStatus->selectOptionListHtml("x_AppealStatus") ?>
		</select>
</div>
<?php echo $staffdisciplinary_case_edit->AppealStatus->Lookup->getParamTag($staffdisciplinary_case_edit, "p_x_AppealStatus") ?>
</span>
<?php echo $staffdisciplinary_case_edit->AppealStatus->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffdisciplinary_case_edit->DiciplinaryHearing->Visible) { // DiciplinaryHearing ?>
	<div id="r_DiciplinaryHearing" class="form-group row">
		<label id="elh_staffdisciplinary_case_DiciplinaryHearing" for="x_DiciplinaryHearing" class="<?php echo $staffdisciplinary_case_edit->LeftColumnClass ?>"><?php echo $staffdisciplinary_case_edit->DiciplinaryHearing->caption() ?><?php echo $staffdisciplinary_case_edit->DiciplinaryHearing->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffdisciplinary_case_edit->RightColumnClass ?>"><div <?php echo $staffdisciplinary_case_edit->DiciplinaryHearing->cellAttributes() ?>>
<span id="el_staffdisciplinary_case_DiciplinaryHearing">
<textarea data-table="staffdisciplinary_case" data-field="x_DiciplinaryHearing" name="x_DiciplinaryHearing" id="x_DiciplinaryHearing" cols="35" rows="4" placeholder="<?php echo HtmlEncode($staffdisciplinary_case_edit->DiciplinaryHearing->getPlaceHolder()) ?>"<?php echo $staffdisciplinary_case_edit->DiciplinaryHearing->editAttributes() ?>><?php echo $staffdisciplinary_case_edit->DiciplinaryHearing->EditValue ?></textarea>
</span>
<?php echo $staffdisciplinary_case_edit->DiciplinaryHearing->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffdisciplinary_case_edit->AppealNotes->Visible) { // AppealNotes ?>
	<div id="r_AppealNotes" class="form-group row">
		<label id="elh_staffdisciplinary_case_AppealNotes" for="x_AppealNotes" class="<?php echo $staffdisciplinary_case_edit->LeftColumnClass ?>"><?php echo $staffdisciplinary_case_edit->AppealNotes->caption() ?><?php echo $staffdisciplinary_case_edit->AppealNotes->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffdisciplinary_case_edit->RightColumnClass ?>"><div <?php echo $staffdisciplinary_case_edit->AppealNotes->cellAttributes() ?>>
<span id="el_staffdisciplinary_case_AppealNotes">
<textarea data-table="staffdisciplinary_case" data-field="x_AppealNotes" name="x_AppealNotes" id="x_AppealNotes" cols="35" rows="4" placeholder="<?php echo HtmlEncode($staffdisciplinary_case_edit->AppealNotes->getPlaceHolder()) ?>"<?php echo $staffdisciplinary_case_edit->AppealNotes->editAttributes() ?>><?php echo $staffdisciplinary_case_edit->AppealNotes->EditValue ?></textarea>
</span>
<?php echo $staffdisciplinary_case_edit->AppealNotes->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("staffdisciplinary_appeal", explode(",", $staffdisciplinary_case->getCurrentDetailTable())) && $staffdisciplinary_appeal->DetailEdit) {
?>
<?php if ($staffdisciplinary_case->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("staffdisciplinary_appeal", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "staffdisciplinary_appealgrid.php" ?>
<?php } ?>
<?php
	if (in_array("staffdisciplinary_action", explode(",", $staffdisciplinary_case->getCurrentDetailTable())) && $staffdisciplinary_action->DetailEdit) {
?>
<?php if ($staffdisciplinary_case->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("staffdisciplinary_action", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "staffdisciplinary_actiongrid.php" ?>
<?php } ?>
<?php if (!$staffdisciplinary_case_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $staffdisciplinary_case_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $staffdisciplinary_case_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$staffdisciplinary_case_edit->IsModal) { ?>
<?php echo $staffdisciplinary_case_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$staffdisciplinary_case_edit->showPageFooter();
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
$staffdisciplinary_case_edit->terminate();
?>