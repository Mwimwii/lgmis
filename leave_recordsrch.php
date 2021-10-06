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
$leave_record_search = new leave_record_search();

// Run the page
$leave_record_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$leave_record_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fleave_recordsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($leave_record_search->IsModal) { ?>
	fleave_recordsearch = currentAdvancedSearchForm = new ew.Form("fleave_recordsearch", "search");
	<?php } else { ?>
	fleave_recordsearch = currentForm = new ew.Form("fleave_recordsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fleave_recordsearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_EmployeeID");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($leave_record_search->EmployeeID->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_EffectiveDate");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($leave_record_search->EffectiveDate->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_OpeningBalance");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($leave_record_search->OpeningBalance->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_LeaveAccrued");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($leave_record_search->LeaveAccrued->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_LastAccrualDate");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($leave_record_search->LastAccrualDate->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fleave_recordsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fleave_recordsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fleave_recordsearch.lists["x_LeaveTypeCode"] = <?php echo $leave_record_search->LeaveTypeCode->Lookup->toClientList($leave_record_search) ?>;
	fleave_recordsearch.lists["x_LeaveTypeCode"].options = <?php echo JsonEncode($leave_record_search->LeaveTypeCode->lookupOptions()) ?>;
	loadjs.done("fleave_recordsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $leave_record_search->showPageHeader(); ?>
<?php
$leave_record_search->showMessage();
?>
<form name="fleave_recordsearch" id="fleave_recordsearch" class="<?php echo $leave_record_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="leave_record">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$leave_record_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($leave_record_search->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label for="x_EmployeeID" class="<?php echo $leave_record_search->LeftColumnClass ?>"><span id="elh_leave_record_EmployeeID"><?php echo $leave_record_search->EmployeeID->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_EmployeeID" id="z_EmployeeID" value="=">
</span>
		</label>
		<div class="<?php echo $leave_record_search->RightColumnClass ?>"><div <?php echo $leave_record_search->EmployeeID->cellAttributes() ?>>
			<span id="el_leave_record_EmployeeID" class="ew-search-field">
<input type="text" data-table="leave_record" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($leave_record_search->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $leave_record_search->EmployeeID->EditValue ?>"<?php echo $leave_record_search->EmployeeID->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($leave_record_search->LeaveTypeCode->Visible) { // LeaveTypeCode ?>
	<div id="r_LeaveTypeCode" class="form-group row">
		<label for="x_LeaveTypeCode" class="<?php echo $leave_record_search->LeftColumnClass ?>"><span id="elh_leave_record_LeaveTypeCode"><?php echo $leave_record_search->LeaveTypeCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_LeaveTypeCode" id="z_LeaveTypeCode" value="=">
</span>
		</label>
		<div class="<?php echo $leave_record_search->RightColumnClass ?>"><div <?php echo $leave_record_search->LeaveTypeCode->cellAttributes() ?>>
			<span id="el_leave_record_LeaveTypeCode" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="leave_record" data-field="x_LeaveTypeCode" data-value-separator="<?php echo $leave_record_search->LeaveTypeCode->displayValueSeparatorAttribute() ?>" id="x_LeaveTypeCode" name="x_LeaveTypeCode"<?php echo $leave_record_search->LeaveTypeCode->editAttributes() ?>>
			<?php echo $leave_record_search->LeaveTypeCode->selectOptionListHtml("x_LeaveTypeCode") ?>
		</select>
</div>
<?php echo $leave_record_search->LeaveTypeCode->Lookup->getParamTag($leave_record_search, "p_x_LeaveTypeCode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($leave_record_search->EffectiveDate->Visible) { // EffectiveDate ?>
	<div id="r_EffectiveDate" class="form-group row">
		<label for="x_EffectiveDate" class="<?php echo $leave_record_search->LeftColumnClass ?>"><span id="elh_leave_record_EffectiveDate"><?php echo $leave_record_search->EffectiveDate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_EffectiveDate" id="z_EffectiveDate" value="=">
</span>
		</label>
		<div class="<?php echo $leave_record_search->RightColumnClass ?>"><div <?php echo $leave_record_search->EffectiveDate->cellAttributes() ?>>
			<span id="el_leave_record_EffectiveDate" class="ew-search-field">
<input type="text" data-table="leave_record" data-field="x_EffectiveDate" name="x_EffectiveDate" id="x_EffectiveDate" placeholder="<?php echo HtmlEncode($leave_record_search->EffectiveDate->getPlaceHolder()) ?>" value="<?php echo $leave_record_search->EffectiveDate->EditValue ?>"<?php echo $leave_record_search->EffectiveDate->editAttributes() ?>>
<?php if (!$leave_record_search->EffectiveDate->ReadOnly && !$leave_record_search->EffectiveDate->Disabled && !isset($leave_record_search->EffectiveDate->EditAttrs["readonly"]) && !isset($leave_record_search->EffectiveDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fleave_recordsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fleave_recordsearch", "x_EffectiveDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($leave_record_search->OpeningBalance->Visible) { // OpeningBalance ?>
	<div id="r_OpeningBalance" class="form-group row">
		<label for="x_OpeningBalance" class="<?php echo $leave_record_search->LeftColumnClass ?>"><span id="elh_leave_record_OpeningBalance"><?php echo $leave_record_search->OpeningBalance->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_OpeningBalance" id="z_OpeningBalance" value="=">
</span>
		</label>
		<div class="<?php echo $leave_record_search->RightColumnClass ?>"><div <?php echo $leave_record_search->OpeningBalance->cellAttributes() ?>>
			<span id="el_leave_record_OpeningBalance" class="ew-search-field">
<input type="text" data-table="leave_record" data-field="x_OpeningBalance" name="x_OpeningBalance" id="x_OpeningBalance" size="30" placeholder="<?php echo HtmlEncode($leave_record_search->OpeningBalance->getPlaceHolder()) ?>" value="<?php echo $leave_record_search->OpeningBalance->EditValue ?>"<?php echo $leave_record_search->OpeningBalance->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($leave_record_search->LeaveAccrued->Visible) { // LeaveAccrued ?>
	<div id="r_LeaveAccrued" class="form-group row">
		<label for="x_LeaveAccrued" class="<?php echo $leave_record_search->LeftColumnClass ?>"><span id="elh_leave_record_LeaveAccrued"><?php echo $leave_record_search->LeaveAccrued->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_LeaveAccrued" id="z_LeaveAccrued" value="=">
</span>
		</label>
		<div class="<?php echo $leave_record_search->RightColumnClass ?>"><div <?php echo $leave_record_search->LeaveAccrued->cellAttributes() ?>>
			<span id="el_leave_record_LeaveAccrued" class="ew-search-field">
<input type="text" data-table="leave_record" data-field="x_LeaveAccrued" name="x_LeaveAccrued" id="x_LeaveAccrued" size="30" placeholder="<?php echo HtmlEncode($leave_record_search->LeaveAccrued->getPlaceHolder()) ?>" value="<?php echo $leave_record_search->LeaveAccrued->EditValue ?>"<?php echo $leave_record_search->LeaveAccrued->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($leave_record_search->LastAccrualDate->Visible) { // LastAccrualDate ?>
	<div id="r_LastAccrualDate" class="form-group row">
		<label for="x_LastAccrualDate" class="<?php echo $leave_record_search->LeftColumnClass ?>"><span id="elh_leave_record_LastAccrualDate"><?php echo $leave_record_search->LastAccrualDate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_LastAccrualDate" id="z_LastAccrualDate" value="=">
</span>
		</label>
		<div class="<?php echo $leave_record_search->RightColumnClass ?>"><div <?php echo $leave_record_search->LastAccrualDate->cellAttributes() ?>>
			<span id="el_leave_record_LastAccrualDate" class="ew-search-field">
<input type="text" data-table="leave_record" data-field="x_LastAccrualDate" name="x_LastAccrualDate" id="x_LastAccrualDate" placeholder="<?php echo HtmlEncode($leave_record_search->LastAccrualDate->getPlaceHolder()) ?>" value="<?php echo $leave_record_search->LastAccrualDate->EditValue ?>"<?php echo $leave_record_search->LastAccrualDate->editAttributes() ?>>
<?php if (!$leave_record_search->LastAccrualDate->ReadOnly && !$leave_record_search->LastAccrualDate->Disabled && !isset($leave_record_search->LastAccrualDate->EditAttrs["readonly"]) && !isset($leave_record_search->LastAccrualDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fleave_recordsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fleave_recordsearch", "x_LastAccrualDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$leave_record_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $leave_record_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$leave_record_search->showPageFooter();
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
$leave_record_search->terminate();
?>