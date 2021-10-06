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
$staffdisciplinary_appeal_add = new staffdisciplinary_appeal_add();

// Run the page
$staffdisciplinary_appeal_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$staffdisciplinary_appeal_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fstaffdisciplinary_appealadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fstaffdisciplinary_appealadd = currentForm = new ew.Form("fstaffdisciplinary_appealadd", "add");

	// Validate form
	fstaffdisciplinary_appealadd.validate = function() {
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
			<?php if ($staffdisciplinary_appeal_add->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_appeal_add->EmployeeID->caption(), $staffdisciplinary_appeal_add->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffdisciplinary_appeal_add->EmployeeID->errorMessage()) ?>");
			<?php if ($staffdisciplinary_appeal_add->OffenseCode->Required) { ?>
				elm = this.getElements("x" + infix + "_OffenseCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_appeal_add->OffenseCode->caption(), $staffdisciplinary_appeal_add->OffenseCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_OffenseCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffdisciplinary_appeal_add->OffenseCode->errorMessage()) ?>");
			<?php if ($staffdisciplinary_appeal_add->DateOfAppealLetter->Required) { ?>
				elm = this.getElements("x" + infix + "_DateOfAppealLetter");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_appeal_add->DateOfAppealLetter->caption(), $staffdisciplinary_appeal_add->DateOfAppealLetter->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateOfAppealLetter");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffdisciplinary_appeal_add->DateOfAppealLetter->errorMessage()) ?>");
			<?php if ($staffdisciplinary_appeal_add->DateAppealReceived->Required) { ?>
				elm = this.getElements("x" + infix + "_DateAppealReceived");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_appeal_add->DateAppealReceived->caption(), $staffdisciplinary_appeal_add->DateAppealReceived->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateAppealReceived");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffdisciplinary_appeal_add->DateAppealReceived->errorMessage()) ?>");
			<?php if ($staffdisciplinary_appeal_add->DateConcluded->Required) { ?>
				elm = this.getElements("x" + infix + "_DateConcluded");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_appeal_add->DateConcluded->caption(), $staffdisciplinary_appeal_add->DateConcluded->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateConcluded");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffdisciplinary_appeal_add->DateConcluded->errorMessage()) ?>");
			<?php if ($staffdisciplinary_appeal_add->AppealStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_AppealStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_appeal_add->AppealStatus->caption(), $staffdisciplinary_appeal_add->AppealStatus->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffdisciplinary_appeal_add->LastUpdate->Required) { ?>
				elm = this.getElements("x" + infix + "_LastUpdate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_appeal_add->LastUpdate->caption(), $staffdisciplinary_appeal_add->LastUpdate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LastUpdate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffdisciplinary_appeal_add->LastUpdate->errorMessage()) ?>");
			<?php if ($staffdisciplinary_appeal_add->AppealNotes->Required) { ?>
				elm = this.getElements("x" + infix + "_AppealNotes");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_appeal_add->AppealNotes->caption(), $staffdisciplinary_appeal_add->AppealNotes->RequiredErrorMessage)) ?>");
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
	fstaffdisciplinary_appealadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fstaffdisciplinary_appealadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fstaffdisciplinary_appealadd.lists["x_AppealStatus"] = <?php echo $staffdisciplinary_appeal_add->AppealStatus->Lookup->toClientList($staffdisciplinary_appeal_add) ?>;
	fstaffdisciplinary_appealadd.lists["x_AppealStatus"].options = <?php echo JsonEncode($staffdisciplinary_appeal_add->AppealStatus->lookupOptions()) ?>;
	loadjs.done("fstaffdisciplinary_appealadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $staffdisciplinary_appeal_add->showPageHeader(); ?>
<?php
$staffdisciplinary_appeal_add->showMessage();
?>
<form name="fstaffdisciplinary_appealadd" id="fstaffdisciplinary_appealadd" class="<?php echo $staffdisciplinary_appeal_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="staffdisciplinary_appeal">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$staffdisciplinary_appeal_add->IsModal ?>">
<?php if ($staffdisciplinary_appeal->getCurrentMasterTable() == "staffdisciplinary_case") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="staffdisciplinary_case">
<input type="hidden" name="fk_EmployeeID" value="<?php echo HtmlEncode($staffdisciplinary_appeal_add->EmployeeID->getSessionValue()) ?>">
<input type="hidden" name="fk_CaseNo" value="<?php echo HtmlEncode($staffdisciplinary_appeal_add->CaseNo->getSessionValue()) ?>">
<input type="hidden" name="fk_OffenseCode" value="<?php echo HtmlEncode($staffdisciplinary_appeal_add->OffenseCode->getSessionValue()) ?>">
<?php } ?>
<?php if ($staffdisciplinary_appeal->getCurrentMasterTable() == "staff") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="staff">
<input type="hidden" name="fk_EmployeeID" value="<?php echo HtmlEncode($staffdisciplinary_appeal_add->EmployeeID->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($staffdisciplinary_appeal_add->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label id="elh_staffdisciplinary_appeal_EmployeeID" for="x_EmployeeID" class="<?php echo $staffdisciplinary_appeal_add->LeftColumnClass ?>"><?php echo $staffdisciplinary_appeal_add->EmployeeID->caption() ?><?php echo $staffdisciplinary_appeal_add->EmployeeID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffdisciplinary_appeal_add->RightColumnClass ?>"><div <?php echo $staffdisciplinary_appeal_add->EmployeeID->cellAttributes() ?>>
<?php if ($staffdisciplinary_appeal_add->EmployeeID->getSessionValue() != "") { ?>
<span id="el_staffdisciplinary_appeal_EmployeeID">
<span<?php echo $staffdisciplinary_appeal_add->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffdisciplinary_appeal_add->EmployeeID->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_EmployeeID" name="x_EmployeeID" value="<?php echo HtmlEncode($staffdisciplinary_appeal_add->EmployeeID->CurrentValue) ?>">
<?php } else { ?>
<span id="el_staffdisciplinary_appeal_EmployeeID">
<input type="text" data-table="staffdisciplinary_appeal" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($staffdisciplinary_appeal_add->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_appeal_add->EmployeeID->EditValue ?>"<?php echo $staffdisciplinary_appeal_add->EmployeeID->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $staffdisciplinary_appeal_add->EmployeeID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffdisciplinary_appeal_add->OffenseCode->Visible) { // OffenseCode ?>
	<div id="r_OffenseCode" class="form-group row">
		<label id="elh_staffdisciplinary_appeal_OffenseCode" for="x_OffenseCode" class="<?php echo $staffdisciplinary_appeal_add->LeftColumnClass ?>"><?php echo $staffdisciplinary_appeal_add->OffenseCode->caption() ?><?php echo $staffdisciplinary_appeal_add->OffenseCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffdisciplinary_appeal_add->RightColumnClass ?>"><div <?php echo $staffdisciplinary_appeal_add->OffenseCode->cellAttributes() ?>>
<?php if ($staffdisciplinary_appeal_add->OffenseCode->getSessionValue() != "") { ?>
<span id="el_staffdisciplinary_appeal_OffenseCode">
<span<?php echo $staffdisciplinary_appeal_add->OffenseCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffdisciplinary_appeal_add->OffenseCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_OffenseCode" name="x_OffenseCode" value="<?php echo HtmlEncode($staffdisciplinary_appeal_add->OffenseCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_staffdisciplinary_appeal_OffenseCode">
<input type="text" data-table="staffdisciplinary_appeal" data-field="x_OffenseCode" name="x_OffenseCode" id="x_OffenseCode" size="30" placeholder="<?php echo HtmlEncode($staffdisciplinary_appeal_add->OffenseCode->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_appeal_add->OffenseCode->EditValue ?>"<?php echo $staffdisciplinary_appeal_add->OffenseCode->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $staffdisciplinary_appeal_add->OffenseCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffdisciplinary_appeal_add->DateOfAppealLetter->Visible) { // DateOfAppealLetter ?>
	<div id="r_DateOfAppealLetter" class="form-group row">
		<label id="elh_staffdisciplinary_appeal_DateOfAppealLetter" for="x_DateOfAppealLetter" class="<?php echo $staffdisciplinary_appeal_add->LeftColumnClass ?>"><?php echo $staffdisciplinary_appeal_add->DateOfAppealLetter->caption() ?><?php echo $staffdisciplinary_appeal_add->DateOfAppealLetter->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffdisciplinary_appeal_add->RightColumnClass ?>"><div <?php echo $staffdisciplinary_appeal_add->DateOfAppealLetter->cellAttributes() ?>>
<span id="el_staffdisciplinary_appeal_DateOfAppealLetter">
<input type="text" data-table="staffdisciplinary_appeal" data-field="x_DateOfAppealLetter" name="x_DateOfAppealLetter" id="x_DateOfAppealLetter" placeholder="<?php echo HtmlEncode($staffdisciplinary_appeal_add->DateOfAppealLetter->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_appeal_add->DateOfAppealLetter->EditValue ?>"<?php echo $staffdisciplinary_appeal_add->DateOfAppealLetter->editAttributes() ?>>
<?php if (!$staffdisciplinary_appeal_add->DateOfAppealLetter->ReadOnly && !$staffdisciplinary_appeal_add->DateOfAppealLetter->Disabled && !isset($staffdisciplinary_appeal_add->DateOfAppealLetter->EditAttrs["readonly"]) && !isset($staffdisciplinary_appeal_add->DateOfAppealLetter->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_appealadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_appealadd", "x_DateOfAppealLetter", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $staffdisciplinary_appeal_add->DateOfAppealLetter->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffdisciplinary_appeal_add->DateAppealReceived->Visible) { // DateAppealReceived ?>
	<div id="r_DateAppealReceived" class="form-group row">
		<label id="elh_staffdisciplinary_appeal_DateAppealReceived" for="x_DateAppealReceived" class="<?php echo $staffdisciplinary_appeal_add->LeftColumnClass ?>"><?php echo $staffdisciplinary_appeal_add->DateAppealReceived->caption() ?><?php echo $staffdisciplinary_appeal_add->DateAppealReceived->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffdisciplinary_appeal_add->RightColumnClass ?>"><div <?php echo $staffdisciplinary_appeal_add->DateAppealReceived->cellAttributes() ?>>
<span id="el_staffdisciplinary_appeal_DateAppealReceived">
<input type="text" data-table="staffdisciplinary_appeal" data-field="x_DateAppealReceived" name="x_DateAppealReceived" id="x_DateAppealReceived" placeholder="<?php echo HtmlEncode($staffdisciplinary_appeal_add->DateAppealReceived->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_appeal_add->DateAppealReceived->EditValue ?>"<?php echo $staffdisciplinary_appeal_add->DateAppealReceived->editAttributes() ?>>
<?php if (!$staffdisciplinary_appeal_add->DateAppealReceived->ReadOnly && !$staffdisciplinary_appeal_add->DateAppealReceived->Disabled && !isset($staffdisciplinary_appeal_add->DateAppealReceived->EditAttrs["readonly"]) && !isset($staffdisciplinary_appeal_add->DateAppealReceived->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_appealadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_appealadd", "x_DateAppealReceived", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $staffdisciplinary_appeal_add->DateAppealReceived->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffdisciplinary_appeal_add->DateConcluded->Visible) { // DateConcluded ?>
	<div id="r_DateConcluded" class="form-group row">
		<label id="elh_staffdisciplinary_appeal_DateConcluded" for="x_DateConcluded" class="<?php echo $staffdisciplinary_appeal_add->LeftColumnClass ?>"><?php echo $staffdisciplinary_appeal_add->DateConcluded->caption() ?><?php echo $staffdisciplinary_appeal_add->DateConcluded->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffdisciplinary_appeal_add->RightColumnClass ?>"><div <?php echo $staffdisciplinary_appeal_add->DateConcluded->cellAttributes() ?>>
<span id="el_staffdisciplinary_appeal_DateConcluded">
<input type="text" data-table="staffdisciplinary_appeal" data-field="x_DateConcluded" name="x_DateConcluded" id="x_DateConcluded" placeholder="<?php echo HtmlEncode($staffdisciplinary_appeal_add->DateConcluded->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_appeal_add->DateConcluded->EditValue ?>"<?php echo $staffdisciplinary_appeal_add->DateConcluded->editAttributes() ?>>
<?php if (!$staffdisciplinary_appeal_add->DateConcluded->ReadOnly && !$staffdisciplinary_appeal_add->DateConcluded->Disabled && !isset($staffdisciplinary_appeal_add->DateConcluded->EditAttrs["readonly"]) && !isset($staffdisciplinary_appeal_add->DateConcluded->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_appealadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_appealadd", "x_DateConcluded", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $staffdisciplinary_appeal_add->DateConcluded->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffdisciplinary_appeal_add->AppealStatus->Visible) { // AppealStatus ?>
	<div id="r_AppealStatus" class="form-group row">
		<label id="elh_staffdisciplinary_appeal_AppealStatus" for="x_AppealStatus" class="<?php echo $staffdisciplinary_appeal_add->LeftColumnClass ?>"><?php echo $staffdisciplinary_appeal_add->AppealStatus->caption() ?><?php echo $staffdisciplinary_appeal_add->AppealStatus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffdisciplinary_appeal_add->RightColumnClass ?>"><div <?php echo $staffdisciplinary_appeal_add->AppealStatus->cellAttributes() ?>>
<span id="el_staffdisciplinary_appeal_AppealStatus">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffdisciplinary_appeal" data-field="x_AppealStatus" data-value-separator="<?php echo $staffdisciplinary_appeal_add->AppealStatus->displayValueSeparatorAttribute() ?>" id="x_AppealStatus" name="x_AppealStatus"<?php echo $staffdisciplinary_appeal_add->AppealStatus->editAttributes() ?>>
			<?php echo $staffdisciplinary_appeal_add->AppealStatus->selectOptionListHtml("x_AppealStatus") ?>
		</select>
</div>
<?php echo $staffdisciplinary_appeal_add->AppealStatus->Lookup->getParamTag($staffdisciplinary_appeal_add, "p_x_AppealStatus") ?>
</span>
<?php echo $staffdisciplinary_appeal_add->AppealStatus->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffdisciplinary_appeal_add->LastUpdate->Visible) { // LastUpdate ?>
	<div id="r_LastUpdate" class="form-group row">
		<label id="elh_staffdisciplinary_appeal_LastUpdate" for="x_LastUpdate" class="<?php echo $staffdisciplinary_appeal_add->LeftColumnClass ?>"><?php echo $staffdisciplinary_appeal_add->LastUpdate->caption() ?><?php echo $staffdisciplinary_appeal_add->LastUpdate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffdisciplinary_appeal_add->RightColumnClass ?>"><div <?php echo $staffdisciplinary_appeal_add->LastUpdate->cellAttributes() ?>>
<span id="el_staffdisciplinary_appeal_LastUpdate">
<input type="text" data-table="staffdisciplinary_appeal" data-field="x_LastUpdate" name="x_LastUpdate" id="x_LastUpdate" placeholder="<?php echo HtmlEncode($staffdisciplinary_appeal_add->LastUpdate->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_appeal_add->LastUpdate->EditValue ?>"<?php echo $staffdisciplinary_appeal_add->LastUpdate->editAttributes() ?>>
<?php if (!$staffdisciplinary_appeal_add->LastUpdate->ReadOnly && !$staffdisciplinary_appeal_add->LastUpdate->Disabled && !isset($staffdisciplinary_appeal_add->LastUpdate->EditAttrs["readonly"]) && !isset($staffdisciplinary_appeal_add->LastUpdate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_appealadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_appealadd", "x_LastUpdate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $staffdisciplinary_appeal_add->LastUpdate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffdisciplinary_appeal_add->AppealNotes->Visible) { // AppealNotes ?>
	<div id="r_AppealNotes" class="form-group row">
		<label id="elh_staffdisciplinary_appeal_AppealNotes" for="x_AppealNotes" class="<?php echo $staffdisciplinary_appeal_add->LeftColumnClass ?>"><?php echo $staffdisciplinary_appeal_add->AppealNotes->caption() ?><?php echo $staffdisciplinary_appeal_add->AppealNotes->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffdisciplinary_appeal_add->RightColumnClass ?>"><div <?php echo $staffdisciplinary_appeal_add->AppealNotes->cellAttributes() ?>>
<span id="el_staffdisciplinary_appeal_AppealNotes">
<textarea data-table="staffdisciplinary_appeal" data-field="x_AppealNotes" name="x_AppealNotes" id="x_AppealNotes" cols="35" rows="4" placeholder="<?php echo HtmlEncode($staffdisciplinary_appeal_add->AppealNotes->getPlaceHolder()) ?>"<?php echo $staffdisciplinary_appeal_add->AppealNotes->editAttributes() ?>><?php echo $staffdisciplinary_appeal_add->AppealNotes->EditValue ?></textarea>
</span>
<?php echo $staffdisciplinary_appeal_add->AppealNotes->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<?php if (strval($staffdisciplinary_appeal_add->CaseNo->getSessionValue()) != "") { ?>
	<input type="hidden" name="x_CaseNo" id="x_CaseNo" value="<?php echo HtmlEncode(strval($staffdisciplinary_appeal_add->CaseNo->getSessionValue())) ?>">
	<?php } ?>
<?php if (!$staffdisciplinary_appeal_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $staffdisciplinary_appeal_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $staffdisciplinary_appeal_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$staffdisciplinary_appeal_add->showPageFooter();
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
$staffdisciplinary_appeal_add->terminate();
?>