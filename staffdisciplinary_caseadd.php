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
$staffdisciplinary_case_add = new staffdisciplinary_case_add();

// Run the page
$staffdisciplinary_case_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$staffdisciplinary_case_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fstaffdisciplinary_caseadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fstaffdisciplinary_caseadd = currentForm = new ew.Form("fstaffdisciplinary_caseadd", "add");

	// Validate form
	fstaffdisciplinary_caseadd.validate = function() {
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
			<?php if ($staffdisciplinary_case_add->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_case_add->EmployeeID->caption(), $staffdisciplinary_case_add->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffdisciplinary_case_add->EmployeeID->errorMessage()) ?>");
			<?php if ($staffdisciplinary_case_add->OffenseCode->Required) { ?>
				elm = this.getElements("x" + infix + "_OffenseCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_case_add->OffenseCode->caption(), $staffdisciplinary_case_add->OffenseCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffdisciplinary_case_add->CaseDescription->Required) { ?>
				elm = this.getElements("x" + infix + "_CaseDescription");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_case_add->CaseDescription->caption(), $staffdisciplinary_case_add->CaseDescription->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffdisciplinary_case_add->ActionTaken->Required) { ?>
				elm = this.getElements("x" + infix + "_ActionTaken");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_case_add->ActionTaken->caption(), $staffdisciplinary_case_add->ActionTaken->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffdisciplinary_case_add->OffenseDate->Required) { ?>
				elm = this.getElements("x" + infix + "_OffenseDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_case_add->OffenseDate->caption(), $staffdisciplinary_case_add->OffenseDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_OffenseDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffdisciplinary_case_add->OffenseDate->errorMessage()) ?>");
			<?php if ($staffdisciplinary_case_add->ActionDate->Required) { ?>
				elm = this.getElements("x" + infix + "_ActionDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_case_add->ActionDate->caption(), $staffdisciplinary_case_add->ActionDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ActionDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffdisciplinary_case_add->ActionDate->errorMessage()) ?>");
			<?php if ($staffdisciplinary_case_add->DateOfAppealLetter->Required) { ?>
				elm = this.getElements("x" + infix + "_DateOfAppealLetter");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_case_add->DateOfAppealLetter->caption(), $staffdisciplinary_case_add->DateOfAppealLetter->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateOfAppealLetter");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffdisciplinary_case_add->DateOfAppealLetter->errorMessage()) ?>");
			<?php if ($staffdisciplinary_case_add->DateAppealReceived->Required) { ?>
				elm = this.getElements("x" + infix + "_DateAppealReceived");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_case_add->DateAppealReceived->caption(), $staffdisciplinary_case_add->DateAppealReceived->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateAppealReceived");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffdisciplinary_case_add->DateAppealReceived->errorMessage()) ?>");
			<?php if ($staffdisciplinary_case_add->DateConcluded->Required) { ?>
				elm = this.getElements("x" + infix + "_DateConcluded");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_case_add->DateConcluded->caption(), $staffdisciplinary_case_add->DateConcluded->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateConcluded");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffdisciplinary_case_add->DateConcluded->errorMessage()) ?>");
			<?php if ($staffdisciplinary_case_add->AppealStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_AppealStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_case_add->AppealStatus->caption(), $staffdisciplinary_case_add->AppealStatus->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffdisciplinary_case_add->DiciplinaryHearing->Required) { ?>
				elm = this.getElements("x" + infix + "_DiciplinaryHearing");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_case_add->DiciplinaryHearing->caption(), $staffdisciplinary_case_add->DiciplinaryHearing->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffdisciplinary_case_add->AppealNotes->Required) { ?>
				elm = this.getElements("x" + infix + "_AppealNotes");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_case_add->AppealNotes->caption(), $staffdisciplinary_case_add->AppealNotes->RequiredErrorMessage)) ?>");
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
	fstaffdisciplinary_caseadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fstaffdisciplinary_caseadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fstaffdisciplinary_caseadd.lists["x_OffenseCode"] = <?php echo $staffdisciplinary_case_add->OffenseCode->Lookup->toClientList($staffdisciplinary_case_add) ?>;
	fstaffdisciplinary_caseadd.lists["x_OffenseCode"].options = <?php echo JsonEncode($staffdisciplinary_case_add->OffenseCode->lookupOptions()) ?>;
	fstaffdisciplinary_caseadd.lists["x_ActionTaken"] = <?php echo $staffdisciplinary_case_add->ActionTaken->Lookup->toClientList($staffdisciplinary_case_add) ?>;
	fstaffdisciplinary_caseadd.lists["x_ActionTaken"].options = <?php echo JsonEncode($staffdisciplinary_case_add->ActionTaken->lookupOptions()) ?>;
	fstaffdisciplinary_caseadd.lists["x_AppealStatus"] = <?php echo $staffdisciplinary_case_add->AppealStatus->Lookup->toClientList($staffdisciplinary_case_add) ?>;
	fstaffdisciplinary_caseadd.lists["x_AppealStatus"].options = <?php echo JsonEncode($staffdisciplinary_case_add->AppealStatus->lookupOptions()) ?>;
	loadjs.done("fstaffdisciplinary_caseadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $staffdisciplinary_case_add->showPageHeader(); ?>
<?php
$staffdisciplinary_case_add->showMessage();
?>
<form name="fstaffdisciplinary_caseadd" id="fstaffdisciplinary_caseadd" class="<?php echo $staffdisciplinary_case_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="staffdisciplinary_case">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$staffdisciplinary_case_add->IsModal ?>">
<?php if ($staffdisciplinary_case->getCurrentMasterTable() == "staff") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="staff">
<input type="hidden" name="fk_EmployeeID" value="<?php echo HtmlEncode($staffdisciplinary_case_add->EmployeeID->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($staffdisciplinary_case_add->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label id="elh_staffdisciplinary_case_EmployeeID" for="x_EmployeeID" class="<?php echo $staffdisciplinary_case_add->LeftColumnClass ?>"><?php echo $staffdisciplinary_case_add->EmployeeID->caption() ?><?php echo $staffdisciplinary_case_add->EmployeeID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffdisciplinary_case_add->RightColumnClass ?>"><div <?php echo $staffdisciplinary_case_add->EmployeeID->cellAttributes() ?>>
<?php if ($staffdisciplinary_case_add->EmployeeID->getSessionValue() != "") { ?>
<span id="el_staffdisciplinary_case_EmployeeID">
<span<?php echo $staffdisciplinary_case_add->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffdisciplinary_case_add->EmployeeID->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_EmployeeID" name="x_EmployeeID" value="<?php echo HtmlEncode($staffdisciplinary_case_add->EmployeeID->CurrentValue) ?>">
<?php } else { ?>
<span id="el_staffdisciplinary_case_EmployeeID">
<input type="text" data-table="staffdisciplinary_case" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($staffdisciplinary_case_add->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_case_add->EmployeeID->EditValue ?>"<?php echo $staffdisciplinary_case_add->EmployeeID->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $staffdisciplinary_case_add->EmployeeID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffdisciplinary_case_add->OffenseCode->Visible) { // OffenseCode ?>
	<div id="r_OffenseCode" class="form-group row">
		<label id="elh_staffdisciplinary_case_OffenseCode" class="<?php echo $staffdisciplinary_case_add->LeftColumnClass ?>"><?php echo $staffdisciplinary_case_add->OffenseCode->caption() ?><?php echo $staffdisciplinary_case_add->OffenseCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffdisciplinary_case_add->RightColumnClass ?>"><div <?php echo $staffdisciplinary_case_add->OffenseCode->cellAttributes() ?>>
<span id="el_staffdisciplinary_case_OffenseCode">
<?php $staffdisciplinary_case_add->OffenseCode->EditAttrs->prepend("onclick", "ew.autoFill(this);"); ?>
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($staffdisciplinary_case_add->OffenseCode->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $staffdisciplinary_case_add->OffenseCode->ViewValue ?></button>
		<div id="dsl_x_OffenseCode" data-repeatcolumn="5" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $staffdisciplinary_case_add->OffenseCode->radioButtonListHtml(TRUE, "x_OffenseCode") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_OffenseCode" class="ew-template"><input type="radio" class="custom-control-input" data-table="staffdisciplinary_case" data-field="x_OffenseCode" data-value-separator="<?php echo $staffdisciplinary_case_add->OffenseCode->displayValueSeparatorAttribute() ?>" name="x_OffenseCode" id="x_OffenseCode" value="{value}"<?php echo $staffdisciplinary_case_add->OffenseCode->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$staffdisciplinary_case_add->OffenseCode->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
<?php echo $staffdisciplinary_case_add->OffenseCode->Lookup->getParamTag($staffdisciplinary_case_add, "p_x_OffenseCode") ?>
</span>
<?php echo $staffdisciplinary_case_add->OffenseCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffdisciplinary_case_add->CaseDescription->Visible) { // CaseDescription ?>
	<div id="r_CaseDescription" class="form-group row">
		<label id="elh_staffdisciplinary_case_CaseDescription" for="x_CaseDescription" class="<?php echo $staffdisciplinary_case_add->LeftColumnClass ?>"><?php echo $staffdisciplinary_case_add->CaseDescription->caption() ?><?php echo $staffdisciplinary_case_add->CaseDescription->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffdisciplinary_case_add->RightColumnClass ?>"><div <?php echo $staffdisciplinary_case_add->CaseDescription->cellAttributes() ?>>
<span id="el_staffdisciplinary_case_CaseDescription">
<textarea data-table="staffdisciplinary_case" data-field="x_CaseDescription" name="x_CaseDescription" id="x_CaseDescription" cols="35" rows="4" placeholder="<?php echo HtmlEncode($staffdisciplinary_case_add->CaseDescription->getPlaceHolder()) ?>"<?php echo $staffdisciplinary_case_add->CaseDescription->editAttributes() ?>><?php echo $staffdisciplinary_case_add->CaseDescription->EditValue ?></textarea>
</span>
<?php echo $staffdisciplinary_case_add->CaseDescription->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffdisciplinary_case_add->ActionTaken->Visible) { // ActionTaken ?>
	<div id="r_ActionTaken" class="form-group row">
		<label id="elh_staffdisciplinary_case_ActionTaken" for="x_ActionTaken" class="<?php echo $staffdisciplinary_case_add->LeftColumnClass ?>"><?php echo $staffdisciplinary_case_add->ActionTaken->caption() ?><?php echo $staffdisciplinary_case_add->ActionTaken->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffdisciplinary_case_add->RightColumnClass ?>"><div <?php echo $staffdisciplinary_case_add->ActionTaken->cellAttributes() ?>>
<span id="el_staffdisciplinary_case_ActionTaken">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffdisciplinary_case" data-field="x_ActionTaken" data-value-separator="<?php echo $staffdisciplinary_case_add->ActionTaken->displayValueSeparatorAttribute() ?>" id="x_ActionTaken" name="x_ActionTaken"<?php echo $staffdisciplinary_case_add->ActionTaken->editAttributes() ?>>
			<?php echo $staffdisciplinary_case_add->ActionTaken->selectOptionListHtml("x_ActionTaken") ?>
		</select>
</div>
<?php echo $staffdisciplinary_case_add->ActionTaken->Lookup->getParamTag($staffdisciplinary_case_add, "p_x_ActionTaken") ?>
</span>
<?php echo $staffdisciplinary_case_add->ActionTaken->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffdisciplinary_case_add->OffenseDate->Visible) { // OffenseDate ?>
	<div id="r_OffenseDate" class="form-group row">
		<label id="elh_staffdisciplinary_case_OffenseDate" for="x_OffenseDate" class="<?php echo $staffdisciplinary_case_add->LeftColumnClass ?>"><?php echo $staffdisciplinary_case_add->OffenseDate->caption() ?><?php echo $staffdisciplinary_case_add->OffenseDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffdisciplinary_case_add->RightColumnClass ?>"><div <?php echo $staffdisciplinary_case_add->OffenseDate->cellAttributes() ?>>
<span id="el_staffdisciplinary_case_OffenseDate">
<input type="text" data-table="staffdisciplinary_case" data-field="x_OffenseDate" name="x_OffenseDate" id="x_OffenseDate" placeholder="<?php echo HtmlEncode($staffdisciplinary_case_add->OffenseDate->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_case_add->OffenseDate->EditValue ?>"<?php echo $staffdisciplinary_case_add->OffenseDate->editAttributes() ?>>
<?php if (!$staffdisciplinary_case_add->OffenseDate->ReadOnly && !$staffdisciplinary_case_add->OffenseDate->Disabled && !isset($staffdisciplinary_case_add->OffenseDate->EditAttrs["readonly"]) && !isset($staffdisciplinary_case_add->OffenseDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_caseadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_caseadd", "x_OffenseDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $staffdisciplinary_case_add->OffenseDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffdisciplinary_case_add->ActionDate->Visible) { // ActionDate ?>
	<div id="r_ActionDate" class="form-group row">
		<label id="elh_staffdisciplinary_case_ActionDate" for="x_ActionDate" class="<?php echo $staffdisciplinary_case_add->LeftColumnClass ?>"><?php echo $staffdisciplinary_case_add->ActionDate->caption() ?><?php echo $staffdisciplinary_case_add->ActionDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffdisciplinary_case_add->RightColumnClass ?>"><div <?php echo $staffdisciplinary_case_add->ActionDate->cellAttributes() ?>>
<span id="el_staffdisciplinary_case_ActionDate">
<input type="text" data-table="staffdisciplinary_case" data-field="x_ActionDate" name="x_ActionDate" id="x_ActionDate" placeholder="<?php echo HtmlEncode($staffdisciplinary_case_add->ActionDate->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_case_add->ActionDate->EditValue ?>"<?php echo $staffdisciplinary_case_add->ActionDate->editAttributes() ?>>
<?php if (!$staffdisciplinary_case_add->ActionDate->ReadOnly && !$staffdisciplinary_case_add->ActionDate->Disabled && !isset($staffdisciplinary_case_add->ActionDate->EditAttrs["readonly"]) && !isset($staffdisciplinary_case_add->ActionDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_caseadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_caseadd", "x_ActionDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $staffdisciplinary_case_add->ActionDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffdisciplinary_case_add->DateOfAppealLetter->Visible) { // DateOfAppealLetter ?>
	<div id="r_DateOfAppealLetter" class="form-group row">
		<label id="elh_staffdisciplinary_case_DateOfAppealLetter" for="x_DateOfAppealLetter" class="<?php echo $staffdisciplinary_case_add->LeftColumnClass ?>"><?php echo $staffdisciplinary_case_add->DateOfAppealLetter->caption() ?><?php echo $staffdisciplinary_case_add->DateOfAppealLetter->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffdisciplinary_case_add->RightColumnClass ?>"><div <?php echo $staffdisciplinary_case_add->DateOfAppealLetter->cellAttributes() ?>>
<span id="el_staffdisciplinary_case_DateOfAppealLetter">
<input type="text" data-table="staffdisciplinary_case" data-field="x_DateOfAppealLetter" name="x_DateOfAppealLetter" id="x_DateOfAppealLetter" placeholder="<?php echo HtmlEncode($staffdisciplinary_case_add->DateOfAppealLetter->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_case_add->DateOfAppealLetter->EditValue ?>"<?php echo $staffdisciplinary_case_add->DateOfAppealLetter->editAttributes() ?>>
<?php if (!$staffdisciplinary_case_add->DateOfAppealLetter->ReadOnly && !$staffdisciplinary_case_add->DateOfAppealLetter->Disabled && !isset($staffdisciplinary_case_add->DateOfAppealLetter->EditAttrs["readonly"]) && !isset($staffdisciplinary_case_add->DateOfAppealLetter->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_caseadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_caseadd", "x_DateOfAppealLetter", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $staffdisciplinary_case_add->DateOfAppealLetter->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffdisciplinary_case_add->DateAppealReceived->Visible) { // DateAppealReceived ?>
	<div id="r_DateAppealReceived" class="form-group row">
		<label id="elh_staffdisciplinary_case_DateAppealReceived" for="x_DateAppealReceived" class="<?php echo $staffdisciplinary_case_add->LeftColumnClass ?>"><?php echo $staffdisciplinary_case_add->DateAppealReceived->caption() ?><?php echo $staffdisciplinary_case_add->DateAppealReceived->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffdisciplinary_case_add->RightColumnClass ?>"><div <?php echo $staffdisciplinary_case_add->DateAppealReceived->cellAttributes() ?>>
<span id="el_staffdisciplinary_case_DateAppealReceived">
<input type="text" data-table="staffdisciplinary_case" data-field="x_DateAppealReceived" name="x_DateAppealReceived" id="x_DateAppealReceived" placeholder="<?php echo HtmlEncode($staffdisciplinary_case_add->DateAppealReceived->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_case_add->DateAppealReceived->EditValue ?>"<?php echo $staffdisciplinary_case_add->DateAppealReceived->editAttributes() ?>>
<?php if (!$staffdisciplinary_case_add->DateAppealReceived->ReadOnly && !$staffdisciplinary_case_add->DateAppealReceived->Disabled && !isset($staffdisciplinary_case_add->DateAppealReceived->EditAttrs["readonly"]) && !isset($staffdisciplinary_case_add->DateAppealReceived->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_caseadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_caseadd", "x_DateAppealReceived", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $staffdisciplinary_case_add->DateAppealReceived->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffdisciplinary_case_add->DateConcluded->Visible) { // DateConcluded ?>
	<div id="r_DateConcluded" class="form-group row">
		<label id="elh_staffdisciplinary_case_DateConcluded" for="x_DateConcluded" class="<?php echo $staffdisciplinary_case_add->LeftColumnClass ?>"><?php echo $staffdisciplinary_case_add->DateConcluded->caption() ?><?php echo $staffdisciplinary_case_add->DateConcluded->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffdisciplinary_case_add->RightColumnClass ?>"><div <?php echo $staffdisciplinary_case_add->DateConcluded->cellAttributes() ?>>
<span id="el_staffdisciplinary_case_DateConcluded">
<input type="text" data-table="staffdisciplinary_case" data-field="x_DateConcluded" name="x_DateConcluded" id="x_DateConcluded" placeholder="<?php echo HtmlEncode($staffdisciplinary_case_add->DateConcluded->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_case_add->DateConcluded->EditValue ?>"<?php echo $staffdisciplinary_case_add->DateConcluded->editAttributes() ?>>
<?php if (!$staffdisciplinary_case_add->DateConcluded->ReadOnly && !$staffdisciplinary_case_add->DateConcluded->Disabled && !isset($staffdisciplinary_case_add->DateConcluded->EditAttrs["readonly"]) && !isset($staffdisciplinary_case_add->DateConcluded->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_caseadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_caseadd", "x_DateConcluded", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $staffdisciplinary_case_add->DateConcluded->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffdisciplinary_case_add->AppealStatus->Visible) { // AppealStatus ?>
	<div id="r_AppealStatus" class="form-group row">
		<label id="elh_staffdisciplinary_case_AppealStatus" for="x_AppealStatus" class="<?php echo $staffdisciplinary_case_add->LeftColumnClass ?>"><?php echo $staffdisciplinary_case_add->AppealStatus->caption() ?><?php echo $staffdisciplinary_case_add->AppealStatus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffdisciplinary_case_add->RightColumnClass ?>"><div <?php echo $staffdisciplinary_case_add->AppealStatus->cellAttributes() ?>>
<span id="el_staffdisciplinary_case_AppealStatus">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffdisciplinary_case" data-field="x_AppealStatus" data-value-separator="<?php echo $staffdisciplinary_case_add->AppealStatus->displayValueSeparatorAttribute() ?>" id="x_AppealStatus" name="x_AppealStatus"<?php echo $staffdisciplinary_case_add->AppealStatus->editAttributes() ?>>
			<?php echo $staffdisciplinary_case_add->AppealStatus->selectOptionListHtml("x_AppealStatus") ?>
		</select>
</div>
<?php echo $staffdisciplinary_case_add->AppealStatus->Lookup->getParamTag($staffdisciplinary_case_add, "p_x_AppealStatus") ?>
</span>
<?php echo $staffdisciplinary_case_add->AppealStatus->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffdisciplinary_case_add->DiciplinaryHearing->Visible) { // DiciplinaryHearing ?>
	<div id="r_DiciplinaryHearing" class="form-group row">
		<label id="elh_staffdisciplinary_case_DiciplinaryHearing" for="x_DiciplinaryHearing" class="<?php echo $staffdisciplinary_case_add->LeftColumnClass ?>"><?php echo $staffdisciplinary_case_add->DiciplinaryHearing->caption() ?><?php echo $staffdisciplinary_case_add->DiciplinaryHearing->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffdisciplinary_case_add->RightColumnClass ?>"><div <?php echo $staffdisciplinary_case_add->DiciplinaryHearing->cellAttributes() ?>>
<span id="el_staffdisciplinary_case_DiciplinaryHearing">
<textarea data-table="staffdisciplinary_case" data-field="x_DiciplinaryHearing" name="x_DiciplinaryHearing" id="x_DiciplinaryHearing" cols="35" rows="4" placeholder="<?php echo HtmlEncode($staffdisciplinary_case_add->DiciplinaryHearing->getPlaceHolder()) ?>"<?php echo $staffdisciplinary_case_add->DiciplinaryHearing->editAttributes() ?>><?php echo $staffdisciplinary_case_add->DiciplinaryHearing->EditValue ?></textarea>
</span>
<?php echo $staffdisciplinary_case_add->DiciplinaryHearing->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffdisciplinary_case_add->AppealNotes->Visible) { // AppealNotes ?>
	<div id="r_AppealNotes" class="form-group row">
		<label id="elh_staffdisciplinary_case_AppealNotes" for="x_AppealNotes" class="<?php echo $staffdisciplinary_case_add->LeftColumnClass ?>"><?php echo $staffdisciplinary_case_add->AppealNotes->caption() ?><?php echo $staffdisciplinary_case_add->AppealNotes->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffdisciplinary_case_add->RightColumnClass ?>"><div <?php echo $staffdisciplinary_case_add->AppealNotes->cellAttributes() ?>>
<span id="el_staffdisciplinary_case_AppealNotes">
<textarea data-table="staffdisciplinary_case" data-field="x_AppealNotes" name="x_AppealNotes" id="x_AppealNotes" cols="35" rows="4" placeholder="<?php echo HtmlEncode($staffdisciplinary_case_add->AppealNotes->getPlaceHolder()) ?>"<?php echo $staffdisciplinary_case_add->AppealNotes->editAttributes() ?>><?php echo $staffdisciplinary_case_add->AppealNotes->EditValue ?></textarea>
</span>
<?php echo $staffdisciplinary_case_add->AppealNotes->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("staffdisciplinary_appeal", explode(",", $staffdisciplinary_case->getCurrentDetailTable())) && $staffdisciplinary_appeal->DetailAdd) {
?>
<?php if ($staffdisciplinary_case->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("staffdisciplinary_appeal", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "staffdisciplinary_appealgrid.php" ?>
<?php } ?>
<?php
	if (in_array("staffdisciplinary_action", explode(",", $staffdisciplinary_case->getCurrentDetailTable())) && $staffdisciplinary_action->DetailAdd) {
?>
<?php if ($staffdisciplinary_case->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("staffdisciplinary_action", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "staffdisciplinary_actiongrid.php" ?>
<?php } ?>
<?php if (!$staffdisciplinary_case_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $staffdisciplinary_case_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $staffdisciplinary_case_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$staffdisciplinary_case_add->showPageFooter();
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
$staffdisciplinary_case_add->terminate();
?>