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
$staffdisciplinary_appeal_edit = new staffdisciplinary_appeal_edit();

// Run the page
$staffdisciplinary_appeal_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$staffdisciplinary_appeal_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fstaffdisciplinary_appealedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fstaffdisciplinary_appealedit = currentForm = new ew.Form("fstaffdisciplinary_appealedit", "edit");

	// Validate form
	fstaffdisciplinary_appealedit.validate = function() {
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
			<?php if ($staffdisciplinary_appeal_edit->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_appeal_edit->EmployeeID->caption(), $staffdisciplinary_appeal_edit->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffdisciplinary_appeal_edit->EmployeeID->errorMessage()) ?>");
			<?php if ($staffdisciplinary_appeal_edit->CaseNo->Required) { ?>
				elm = this.getElements("x" + infix + "_CaseNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_appeal_edit->CaseNo->caption(), $staffdisciplinary_appeal_edit->CaseNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffdisciplinary_appeal_edit->OffenseCode->Required) { ?>
				elm = this.getElements("x" + infix + "_OffenseCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_appeal_edit->OffenseCode->caption(), $staffdisciplinary_appeal_edit->OffenseCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_OffenseCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffdisciplinary_appeal_edit->OffenseCode->errorMessage()) ?>");
			<?php if ($staffdisciplinary_appeal_edit->AppealNo->Required) { ?>
				elm = this.getElements("x" + infix + "_AppealNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_appeal_edit->AppealNo->caption(), $staffdisciplinary_appeal_edit->AppealNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffdisciplinary_appeal_edit->DateOfAppealLetter->Required) { ?>
				elm = this.getElements("x" + infix + "_DateOfAppealLetter");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_appeal_edit->DateOfAppealLetter->caption(), $staffdisciplinary_appeal_edit->DateOfAppealLetter->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateOfAppealLetter");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffdisciplinary_appeal_edit->DateOfAppealLetter->errorMessage()) ?>");
			<?php if ($staffdisciplinary_appeal_edit->DateAppealReceived->Required) { ?>
				elm = this.getElements("x" + infix + "_DateAppealReceived");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_appeal_edit->DateAppealReceived->caption(), $staffdisciplinary_appeal_edit->DateAppealReceived->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateAppealReceived");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffdisciplinary_appeal_edit->DateAppealReceived->errorMessage()) ?>");
			<?php if ($staffdisciplinary_appeal_edit->DateConcluded->Required) { ?>
				elm = this.getElements("x" + infix + "_DateConcluded");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_appeal_edit->DateConcluded->caption(), $staffdisciplinary_appeal_edit->DateConcluded->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateConcluded");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffdisciplinary_appeal_edit->DateConcluded->errorMessage()) ?>");
			<?php if ($staffdisciplinary_appeal_edit->AppealStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_AppealStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_appeal_edit->AppealStatus->caption(), $staffdisciplinary_appeal_edit->AppealStatus->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffdisciplinary_appeal_edit->LastUpdate->Required) { ?>
				elm = this.getElements("x" + infix + "_LastUpdate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_appeal_edit->LastUpdate->caption(), $staffdisciplinary_appeal_edit->LastUpdate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LastUpdate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffdisciplinary_appeal_edit->LastUpdate->errorMessage()) ?>");
			<?php if ($staffdisciplinary_appeal_edit->AppealNotes->Required) { ?>
				elm = this.getElements("x" + infix + "_AppealNotes");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_appeal_edit->AppealNotes->caption(), $staffdisciplinary_appeal_edit->AppealNotes->RequiredErrorMessage)) ?>");
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
	fstaffdisciplinary_appealedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fstaffdisciplinary_appealedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fstaffdisciplinary_appealedit.lists["x_AppealStatus"] = <?php echo $staffdisciplinary_appeal_edit->AppealStatus->Lookup->toClientList($staffdisciplinary_appeal_edit) ?>;
	fstaffdisciplinary_appealedit.lists["x_AppealStatus"].options = <?php echo JsonEncode($staffdisciplinary_appeal_edit->AppealStatus->lookupOptions()) ?>;
	loadjs.done("fstaffdisciplinary_appealedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $staffdisciplinary_appeal_edit->showPageHeader(); ?>
<?php
$staffdisciplinary_appeal_edit->showMessage();
?>
<?php if (!$staffdisciplinary_appeal_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $staffdisciplinary_appeal_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fstaffdisciplinary_appealedit" id="fstaffdisciplinary_appealedit" class="<?php echo $staffdisciplinary_appeal_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="staffdisciplinary_appeal">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$staffdisciplinary_appeal_edit->IsModal ?>">
<?php if ($staffdisciplinary_appeal->getCurrentMasterTable() == "staffdisciplinary_case") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="staffdisciplinary_case">
<input type="hidden" name="fk_EmployeeID" value="<?php echo HtmlEncode($staffdisciplinary_appeal_edit->EmployeeID->getSessionValue()) ?>">
<input type="hidden" name="fk_CaseNo" value="<?php echo HtmlEncode($staffdisciplinary_appeal_edit->CaseNo->getSessionValue()) ?>">
<input type="hidden" name="fk_OffenseCode" value="<?php echo HtmlEncode($staffdisciplinary_appeal_edit->OffenseCode->getSessionValue()) ?>">
<?php } ?>
<?php if ($staffdisciplinary_appeal->getCurrentMasterTable() == "staff") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="staff">
<input type="hidden" name="fk_EmployeeID" value="<?php echo HtmlEncode($staffdisciplinary_appeal_edit->EmployeeID->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($staffdisciplinary_appeal_edit->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label id="elh_staffdisciplinary_appeal_EmployeeID" for="x_EmployeeID" class="<?php echo $staffdisciplinary_appeal_edit->LeftColumnClass ?>"><?php echo $staffdisciplinary_appeal_edit->EmployeeID->caption() ?><?php echo $staffdisciplinary_appeal_edit->EmployeeID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffdisciplinary_appeal_edit->RightColumnClass ?>"><div <?php echo $staffdisciplinary_appeal_edit->EmployeeID->cellAttributes() ?>>
<?php if ($staffdisciplinary_appeal_edit->EmployeeID->getSessionValue() != "") { ?>

<span id="el_staffdisciplinary_appeal_EmployeeID">
<span<?php echo $staffdisciplinary_appeal_edit->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffdisciplinary_appeal_edit->EmployeeID->EditValue)) ?>"></span>
</span>

<input type="hidden" id="x_EmployeeID" name="x_EmployeeID" value="<?php echo HtmlEncode($staffdisciplinary_appeal_edit->EmployeeID->CurrentValue) ?>">
<?php } else { ?>

<input type="text" data-table="staffdisciplinary_appeal" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($staffdisciplinary_appeal_edit->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_appeal_edit->EmployeeID->EditValue ?>"<?php echo $staffdisciplinary_appeal_edit->EmployeeID->editAttributes() ?>>

<?php } ?>

<input type="hidden" data-table="staffdisciplinary_appeal" data-field="x_EmployeeID" name="o_EmployeeID" id="o_EmployeeID" value="<?php echo HtmlEncode($staffdisciplinary_appeal_edit->EmployeeID->OldValue != null ? $staffdisciplinary_appeal_edit->EmployeeID->OldValue : $staffdisciplinary_appeal_edit->EmployeeID->CurrentValue) ?>">
<?php echo $staffdisciplinary_appeal_edit->EmployeeID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffdisciplinary_appeal_edit->CaseNo->Visible) { // CaseNo ?>
	<div id="r_CaseNo" class="form-group row">
		<label id="elh_staffdisciplinary_appeal_CaseNo" class="<?php echo $staffdisciplinary_appeal_edit->LeftColumnClass ?>"><?php echo $staffdisciplinary_appeal_edit->CaseNo->caption() ?><?php echo $staffdisciplinary_appeal_edit->CaseNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffdisciplinary_appeal_edit->RightColumnClass ?>"><div <?php echo $staffdisciplinary_appeal_edit->CaseNo->cellAttributes() ?>>
<?php if ($staffdisciplinary_appeal_edit->CaseNo->getSessionValue() != "") { ?>

<span id="el_staffdisciplinary_appeal_CaseNo">
<span<?php echo $staffdisciplinary_appeal_edit->CaseNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffdisciplinary_appeal_edit->CaseNo->EditValue)) ?>"></span>
</span>

<input type="hidden" id="x_CaseNo" name="x_CaseNo" value="<?php echo HtmlEncode($staffdisciplinary_appeal_edit->CaseNo->CurrentValue) ?>">
<?php } else { ?>

<input type="text" data-table="staffdisciplinary_appeal" data-field="x_CaseNo" name="x_CaseNo" id="x_CaseNo" placeholder="<?php echo HtmlEncode($staffdisciplinary_appeal_edit->CaseNo->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_appeal_edit->CaseNo->EditValue ?>"<?php echo $staffdisciplinary_appeal_edit->CaseNo->editAttributes() ?>>

<?php } ?>

<input type="hidden" data-table="staffdisciplinary_appeal" data-field="x_CaseNo" name="o_CaseNo" id="o_CaseNo" value="<?php echo HtmlEncode($staffdisciplinary_appeal_edit->CaseNo->OldValue != null ? $staffdisciplinary_appeal_edit->CaseNo->OldValue : $staffdisciplinary_appeal_edit->CaseNo->CurrentValue) ?>">
<?php echo $staffdisciplinary_appeal_edit->CaseNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffdisciplinary_appeal_edit->OffenseCode->Visible) { // OffenseCode ?>
	<div id="r_OffenseCode" class="form-group row">
		<label id="elh_staffdisciplinary_appeal_OffenseCode" for="x_OffenseCode" class="<?php echo $staffdisciplinary_appeal_edit->LeftColumnClass ?>"><?php echo $staffdisciplinary_appeal_edit->OffenseCode->caption() ?><?php echo $staffdisciplinary_appeal_edit->OffenseCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffdisciplinary_appeal_edit->RightColumnClass ?>"><div <?php echo $staffdisciplinary_appeal_edit->OffenseCode->cellAttributes() ?>>
<?php if ($staffdisciplinary_appeal_edit->OffenseCode->getSessionValue() != "") { ?>

<span id="el_staffdisciplinary_appeal_OffenseCode">
<span<?php echo $staffdisciplinary_appeal_edit->OffenseCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffdisciplinary_appeal_edit->OffenseCode->EditValue)) ?>"></span>
</span>

<input type="hidden" id="x_OffenseCode" name="x_OffenseCode" value="<?php echo HtmlEncode($staffdisciplinary_appeal_edit->OffenseCode->CurrentValue) ?>">
<?php } else { ?>

<input type="text" data-table="staffdisciplinary_appeal" data-field="x_OffenseCode" name="x_OffenseCode" id="x_OffenseCode" size="30" placeholder="<?php echo HtmlEncode($staffdisciplinary_appeal_edit->OffenseCode->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_appeal_edit->OffenseCode->EditValue ?>"<?php echo $staffdisciplinary_appeal_edit->OffenseCode->editAttributes() ?>>

<?php } ?>

<input type="hidden" data-table="staffdisciplinary_appeal" data-field="x_OffenseCode" name="o_OffenseCode" id="o_OffenseCode" value="<?php echo HtmlEncode($staffdisciplinary_appeal_edit->OffenseCode->OldValue != null ? $staffdisciplinary_appeal_edit->OffenseCode->OldValue : $staffdisciplinary_appeal_edit->OffenseCode->CurrentValue) ?>">
<?php echo $staffdisciplinary_appeal_edit->OffenseCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffdisciplinary_appeal_edit->AppealNo->Visible) { // AppealNo ?>
	<div id="r_AppealNo" class="form-group row">
		<label id="elh_staffdisciplinary_appeal_AppealNo" class="<?php echo $staffdisciplinary_appeal_edit->LeftColumnClass ?>"><?php echo $staffdisciplinary_appeal_edit->AppealNo->caption() ?><?php echo $staffdisciplinary_appeal_edit->AppealNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffdisciplinary_appeal_edit->RightColumnClass ?>"><div <?php echo $staffdisciplinary_appeal_edit->AppealNo->cellAttributes() ?>>
<span id="el_staffdisciplinary_appeal_AppealNo">
<span<?php echo $staffdisciplinary_appeal_edit->AppealNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffdisciplinary_appeal_edit->AppealNo->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="staffdisciplinary_appeal" data-field="x_AppealNo" name="x_AppealNo" id="x_AppealNo" value="<?php echo HtmlEncode($staffdisciplinary_appeal_edit->AppealNo->CurrentValue) ?>">
<?php echo $staffdisciplinary_appeal_edit->AppealNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffdisciplinary_appeal_edit->DateOfAppealLetter->Visible) { // DateOfAppealLetter ?>
	<div id="r_DateOfAppealLetter" class="form-group row">
		<label id="elh_staffdisciplinary_appeal_DateOfAppealLetter" for="x_DateOfAppealLetter" class="<?php echo $staffdisciplinary_appeal_edit->LeftColumnClass ?>"><?php echo $staffdisciplinary_appeal_edit->DateOfAppealLetter->caption() ?><?php echo $staffdisciplinary_appeal_edit->DateOfAppealLetter->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffdisciplinary_appeal_edit->RightColumnClass ?>"><div <?php echo $staffdisciplinary_appeal_edit->DateOfAppealLetter->cellAttributes() ?>>
<span id="el_staffdisciplinary_appeal_DateOfAppealLetter">
<input type="text" data-table="staffdisciplinary_appeal" data-field="x_DateOfAppealLetter" name="x_DateOfAppealLetter" id="x_DateOfAppealLetter" placeholder="<?php echo HtmlEncode($staffdisciplinary_appeal_edit->DateOfAppealLetter->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_appeal_edit->DateOfAppealLetter->EditValue ?>"<?php echo $staffdisciplinary_appeal_edit->DateOfAppealLetter->editAttributes() ?>>
<?php if (!$staffdisciplinary_appeal_edit->DateOfAppealLetter->ReadOnly && !$staffdisciplinary_appeal_edit->DateOfAppealLetter->Disabled && !isset($staffdisciplinary_appeal_edit->DateOfAppealLetter->EditAttrs["readonly"]) && !isset($staffdisciplinary_appeal_edit->DateOfAppealLetter->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_appealedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_appealedit", "x_DateOfAppealLetter", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $staffdisciplinary_appeal_edit->DateOfAppealLetter->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffdisciplinary_appeal_edit->DateAppealReceived->Visible) { // DateAppealReceived ?>
	<div id="r_DateAppealReceived" class="form-group row">
		<label id="elh_staffdisciplinary_appeal_DateAppealReceived" for="x_DateAppealReceived" class="<?php echo $staffdisciplinary_appeal_edit->LeftColumnClass ?>"><?php echo $staffdisciplinary_appeal_edit->DateAppealReceived->caption() ?><?php echo $staffdisciplinary_appeal_edit->DateAppealReceived->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffdisciplinary_appeal_edit->RightColumnClass ?>"><div <?php echo $staffdisciplinary_appeal_edit->DateAppealReceived->cellAttributes() ?>>
<span id="el_staffdisciplinary_appeal_DateAppealReceived">
<input type="text" data-table="staffdisciplinary_appeal" data-field="x_DateAppealReceived" name="x_DateAppealReceived" id="x_DateAppealReceived" placeholder="<?php echo HtmlEncode($staffdisciplinary_appeal_edit->DateAppealReceived->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_appeal_edit->DateAppealReceived->EditValue ?>"<?php echo $staffdisciplinary_appeal_edit->DateAppealReceived->editAttributes() ?>>
<?php if (!$staffdisciplinary_appeal_edit->DateAppealReceived->ReadOnly && !$staffdisciplinary_appeal_edit->DateAppealReceived->Disabled && !isset($staffdisciplinary_appeal_edit->DateAppealReceived->EditAttrs["readonly"]) && !isset($staffdisciplinary_appeal_edit->DateAppealReceived->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_appealedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_appealedit", "x_DateAppealReceived", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $staffdisciplinary_appeal_edit->DateAppealReceived->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffdisciplinary_appeal_edit->DateConcluded->Visible) { // DateConcluded ?>
	<div id="r_DateConcluded" class="form-group row">
		<label id="elh_staffdisciplinary_appeal_DateConcluded" for="x_DateConcluded" class="<?php echo $staffdisciplinary_appeal_edit->LeftColumnClass ?>"><?php echo $staffdisciplinary_appeal_edit->DateConcluded->caption() ?><?php echo $staffdisciplinary_appeal_edit->DateConcluded->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffdisciplinary_appeal_edit->RightColumnClass ?>"><div <?php echo $staffdisciplinary_appeal_edit->DateConcluded->cellAttributes() ?>>
<span id="el_staffdisciplinary_appeal_DateConcluded">
<input type="text" data-table="staffdisciplinary_appeal" data-field="x_DateConcluded" name="x_DateConcluded" id="x_DateConcluded" placeholder="<?php echo HtmlEncode($staffdisciplinary_appeal_edit->DateConcluded->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_appeal_edit->DateConcluded->EditValue ?>"<?php echo $staffdisciplinary_appeal_edit->DateConcluded->editAttributes() ?>>
<?php if (!$staffdisciplinary_appeal_edit->DateConcluded->ReadOnly && !$staffdisciplinary_appeal_edit->DateConcluded->Disabled && !isset($staffdisciplinary_appeal_edit->DateConcluded->EditAttrs["readonly"]) && !isset($staffdisciplinary_appeal_edit->DateConcluded->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_appealedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_appealedit", "x_DateConcluded", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $staffdisciplinary_appeal_edit->DateConcluded->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffdisciplinary_appeal_edit->AppealStatus->Visible) { // AppealStatus ?>
	<div id="r_AppealStatus" class="form-group row">
		<label id="elh_staffdisciplinary_appeal_AppealStatus" for="x_AppealStatus" class="<?php echo $staffdisciplinary_appeal_edit->LeftColumnClass ?>"><?php echo $staffdisciplinary_appeal_edit->AppealStatus->caption() ?><?php echo $staffdisciplinary_appeal_edit->AppealStatus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffdisciplinary_appeal_edit->RightColumnClass ?>"><div <?php echo $staffdisciplinary_appeal_edit->AppealStatus->cellAttributes() ?>>
<span id="el_staffdisciplinary_appeal_AppealStatus">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffdisciplinary_appeal" data-field="x_AppealStatus" data-value-separator="<?php echo $staffdisciplinary_appeal_edit->AppealStatus->displayValueSeparatorAttribute() ?>" id="x_AppealStatus" name="x_AppealStatus"<?php echo $staffdisciplinary_appeal_edit->AppealStatus->editAttributes() ?>>
			<?php echo $staffdisciplinary_appeal_edit->AppealStatus->selectOptionListHtml("x_AppealStatus") ?>
		</select>
</div>
<?php echo $staffdisciplinary_appeal_edit->AppealStatus->Lookup->getParamTag($staffdisciplinary_appeal_edit, "p_x_AppealStatus") ?>
</span>
<?php echo $staffdisciplinary_appeal_edit->AppealStatus->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffdisciplinary_appeal_edit->LastUpdate->Visible) { // LastUpdate ?>
	<div id="r_LastUpdate" class="form-group row">
		<label id="elh_staffdisciplinary_appeal_LastUpdate" for="x_LastUpdate" class="<?php echo $staffdisciplinary_appeal_edit->LeftColumnClass ?>"><?php echo $staffdisciplinary_appeal_edit->LastUpdate->caption() ?><?php echo $staffdisciplinary_appeal_edit->LastUpdate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffdisciplinary_appeal_edit->RightColumnClass ?>"><div <?php echo $staffdisciplinary_appeal_edit->LastUpdate->cellAttributes() ?>>
<span id="el_staffdisciplinary_appeal_LastUpdate">
<input type="text" data-table="staffdisciplinary_appeal" data-field="x_LastUpdate" name="x_LastUpdate" id="x_LastUpdate" placeholder="<?php echo HtmlEncode($staffdisciplinary_appeal_edit->LastUpdate->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_appeal_edit->LastUpdate->EditValue ?>"<?php echo $staffdisciplinary_appeal_edit->LastUpdate->editAttributes() ?>>
<?php if (!$staffdisciplinary_appeal_edit->LastUpdate->ReadOnly && !$staffdisciplinary_appeal_edit->LastUpdate->Disabled && !isset($staffdisciplinary_appeal_edit->LastUpdate->EditAttrs["readonly"]) && !isset($staffdisciplinary_appeal_edit->LastUpdate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_appealedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_appealedit", "x_LastUpdate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $staffdisciplinary_appeal_edit->LastUpdate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffdisciplinary_appeal_edit->AppealNotes->Visible) { // AppealNotes ?>
	<div id="r_AppealNotes" class="form-group row">
		<label id="elh_staffdisciplinary_appeal_AppealNotes" for="x_AppealNotes" class="<?php echo $staffdisciplinary_appeal_edit->LeftColumnClass ?>"><?php echo $staffdisciplinary_appeal_edit->AppealNotes->caption() ?><?php echo $staffdisciplinary_appeal_edit->AppealNotes->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffdisciplinary_appeal_edit->RightColumnClass ?>"><div <?php echo $staffdisciplinary_appeal_edit->AppealNotes->cellAttributes() ?>>
<span id="el_staffdisciplinary_appeal_AppealNotes">
<textarea data-table="staffdisciplinary_appeal" data-field="x_AppealNotes" name="x_AppealNotes" id="x_AppealNotes" cols="35" rows="4" placeholder="<?php echo HtmlEncode($staffdisciplinary_appeal_edit->AppealNotes->getPlaceHolder()) ?>"<?php echo $staffdisciplinary_appeal_edit->AppealNotes->editAttributes() ?>><?php echo $staffdisciplinary_appeal_edit->AppealNotes->EditValue ?></textarea>
</span>
<?php echo $staffdisciplinary_appeal_edit->AppealNotes->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$staffdisciplinary_appeal_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $staffdisciplinary_appeal_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $staffdisciplinary_appeal_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$staffdisciplinary_appeal_edit->IsModal) { ?>
<?php echo $staffdisciplinary_appeal_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$staffdisciplinary_appeal_edit->showPageFooter();
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
$staffdisciplinary_appeal_edit->terminate();
?>