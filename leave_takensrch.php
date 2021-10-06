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
$leave_taken_search = new leave_taken_search();

// Run the page
$leave_taken_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$leave_taken_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fleave_takensearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($leave_taken_search->IsModal) { ?>
	fleave_takensearch = currentAdvancedSearchForm = new ew.Form("fleave_takensearch", "search");
	<?php } else { ?>
	fleave_takensearch = currentForm = new ew.Form("fleave_takensearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fleave_takensearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_EmployeeID");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($leave_taken_search->EmployeeID->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_StartDate");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($leave_taken_search->StartDate->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_EndDate");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($leave_taken_search->EndDate->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_Commuted");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($leave_taken_search->Commuted->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_LeaveDays");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($leave_taken_search->LeaveDays->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fleave_takensearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fleave_takensearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fleave_takensearch.lists["x_LeaveTypeCode"] = <?php echo $leave_taken_search->LeaveTypeCode->Lookup->toClientList($leave_taken_search) ?>;
	fleave_takensearch.lists["x_LeaveTypeCode"].options = <?php echo JsonEncode($leave_taken_search->LeaveTypeCode->lookupOptions()) ?>;
	loadjs.done("fleave_takensearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $leave_taken_search->showPageHeader(); ?>
<?php
$leave_taken_search->showMessage();
?>
<form name="fleave_takensearch" id="fleave_takensearch" class="<?php echo $leave_taken_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="leave_taken">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$leave_taken_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($leave_taken_search->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label for="x_EmployeeID" class="<?php echo $leave_taken_search->LeftColumnClass ?>"><span id="elh_leave_taken_EmployeeID"><?php echo $leave_taken_search->EmployeeID->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_EmployeeID" id="z_EmployeeID" value="=">
</span>
		</label>
		<div class="<?php echo $leave_taken_search->RightColumnClass ?>"><div <?php echo $leave_taken_search->EmployeeID->cellAttributes() ?>>
			<span id="el_leave_taken_EmployeeID" class="ew-search-field">
<input type="text" data-table="leave_taken" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($leave_taken_search->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $leave_taken_search->EmployeeID->EditValue ?>"<?php echo $leave_taken_search->EmployeeID->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($leave_taken_search->LeaveTypeCode->Visible) { // LeaveTypeCode ?>
	<div id="r_LeaveTypeCode" class="form-group row">
		<label for="x_LeaveTypeCode" class="<?php echo $leave_taken_search->LeftColumnClass ?>"><span id="elh_leave_taken_LeaveTypeCode"><?php echo $leave_taken_search->LeaveTypeCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_LeaveTypeCode" id="z_LeaveTypeCode" value="=">
</span>
		</label>
		<div class="<?php echo $leave_taken_search->RightColumnClass ?>"><div <?php echo $leave_taken_search->LeaveTypeCode->cellAttributes() ?>>
			<span id="el_leave_taken_LeaveTypeCode" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="leave_taken" data-field="x_LeaveTypeCode" data-value-separator="<?php echo $leave_taken_search->LeaveTypeCode->displayValueSeparatorAttribute() ?>" id="x_LeaveTypeCode" name="x_LeaveTypeCode"<?php echo $leave_taken_search->LeaveTypeCode->editAttributes() ?>>
			<?php echo $leave_taken_search->LeaveTypeCode->selectOptionListHtml("x_LeaveTypeCode") ?>
		</select>
</div>
<?php echo $leave_taken_search->LeaveTypeCode->Lookup->getParamTag($leave_taken_search, "p_x_LeaveTypeCode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($leave_taken_search->StartDate->Visible) { // StartDate ?>
	<div id="r_StartDate" class="form-group row">
		<label for="x_StartDate" class="<?php echo $leave_taken_search->LeftColumnClass ?>"><span id="elh_leave_taken_StartDate"><?php echo $leave_taken_search->StartDate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_StartDate" id="z_StartDate" value="=">
</span>
		</label>
		<div class="<?php echo $leave_taken_search->RightColumnClass ?>"><div <?php echo $leave_taken_search->StartDate->cellAttributes() ?>>
			<span id="el_leave_taken_StartDate" class="ew-search-field">
<input type="text" data-table="leave_taken" data-field="x_StartDate" name="x_StartDate" id="x_StartDate" placeholder="<?php echo HtmlEncode($leave_taken_search->StartDate->getPlaceHolder()) ?>" value="<?php echo $leave_taken_search->StartDate->EditValue ?>"<?php echo $leave_taken_search->StartDate->editAttributes() ?>>
<?php if (!$leave_taken_search->StartDate->ReadOnly && !$leave_taken_search->StartDate->Disabled && !isset($leave_taken_search->StartDate->EditAttrs["readonly"]) && !isset($leave_taken_search->StartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fleave_takensearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fleave_takensearch", "x_StartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($leave_taken_search->EndDate->Visible) { // EndDate ?>
	<div id="r_EndDate" class="form-group row">
		<label for="x_EndDate" class="<?php echo $leave_taken_search->LeftColumnClass ?>"><span id="elh_leave_taken_EndDate"><?php echo $leave_taken_search->EndDate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_EndDate" id="z_EndDate" value="=">
</span>
		</label>
		<div class="<?php echo $leave_taken_search->RightColumnClass ?>"><div <?php echo $leave_taken_search->EndDate->cellAttributes() ?>>
			<span id="el_leave_taken_EndDate" class="ew-search-field">
<input type="text" data-table="leave_taken" data-field="x_EndDate" name="x_EndDate" id="x_EndDate" placeholder="<?php echo HtmlEncode($leave_taken_search->EndDate->getPlaceHolder()) ?>" value="<?php echo $leave_taken_search->EndDate->EditValue ?>"<?php echo $leave_taken_search->EndDate->editAttributes() ?>>
<?php if (!$leave_taken_search->EndDate->ReadOnly && !$leave_taken_search->EndDate->Disabled && !isset($leave_taken_search->EndDate->EditAttrs["readonly"]) && !isset($leave_taken_search->EndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fleave_takensearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fleave_takensearch", "x_EndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($leave_taken_search->Commuted->Visible) { // Commuted ?>
	<div id="r_Commuted" class="form-group row">
		<label for="x_Commuted" class="<?php echo $leave_taken_search->LeftColumnClass ?>"><span id="elh_leave_taken_Commuted"><?php echo $leave_taken_search->Commuted->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Commuted" id="z_Commuted" value="=">
</span>
		</label>
		<div class="<?php echo $leave_taken_search->RightColumnClass ?>"><div <?php echo $leave_taken_search->Commuted->cellAttributes() ?>>
			<span id="el_leave_taken_Commuted" class="ew-search-field">
<input type="text" data-table="leave_taken" data-field="x_Commuted" name="x_Commuted" id="x_Commuted" size="30" placeholder="<?php echo HtmlEncode($leave_taken_search->Commuted->getPlaceHolder()) ?>" value="<?php echo $leave_taken_search->Commuted->EditValue ?>"<?php echo $leave_taken_search->Commuted->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($leave_taken_search->LeaveDays->Visible) { // LeaveDays ?>
	<div id="r_LeaveDays" class="form-group row">
		<label for="x_LeaveDays" class="<?php echo $leave_taken_search->LeftColumnClass ?>"><span id="elh_leave_taken_LeaveDays"><?php echo $leave_taken_search->LeaveDays->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_LeaveDays" id="z_LeaveDays" value="=">
</span>
		</label>
		<div class="<?php echo $leave_taken_search->RightColumnClass ?>"><div <?php echo $leave_taken_search->LeaveDays->cellAttributes() ?>>
			<span id="el_leave_taken_LeaveDays" class="ew-search-field">
<input type="text" data-table="leave_taken" data-field="x_LeaveDays" name="x_LeaveDays" id="x_LeaveDays" size="30" placeholder="<?php echo HtmlEncode($leave_taken_search->LeaveDays->getPlaceHolder()) ?>" value="<?php echo $leave_taken_search->LeaveDays->EditValue ?>"<?php echo $leave_taken_search->LeaveDays->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($leave_taken_search->Location->Visible) { // Location ?>
	<div id="r_Location" class="form-group row">
		<label for="x_Location" class="<?php echo $leave_taken_search->LeftColumnClass ?>"><span id="elh_leave_taken_Location"><?php echo $leave_taken_search->Location->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Location" id="z_Location" value="LIKE">
</span>
		</label>
		<div class="<?php echo $leave_taken_search->RightColumnClass ?>"><div <?php echo $leave_taken_search->Location->cellAttributes() ?>>
			<span id="el_leave_taken_Location" class="ew-search-field">
<input type="text" data-table="leave_taken" data-field="x_Location" name="x_Location" id="x_Location" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($leave_taken_search->Location->getPlaceHolder()) ?>" value="<?php echo $leave_taken_search->Location->EditValue ?>"<?php echo $leave_taken_search->Location->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($leave_taken_search->Remarks->Visible) { // Remarks ?>
	<div id="r_Remarks" class="form-group row">
		<label for="x_Remarks" class="<?php echo $leave_taken_search->LeftColumnClass ?>"><span id="elh_leave_taken_Remarks"><?php echo $leave_taken_search->Remarks->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Remarks" id="z_Remarks" value="LIKE">
</span>
		</label>
		<div class="<?php echo $leave_taken_search->RightColumnClass ?>"><div <?php echo $leave_taken_search->Remarks->cellAttributes() ?>>
			<span id="el_leave_taken_Remarks" class="ew-search-field">
<input type="text" data-table="leave_taken" data-field="x_Remarks" name="x_Remarks" id="x_Remarks" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($leave_taken_search->Remarks->getPlaceHolder()) ?>" value="<?php echo $leave_taken_search->Remarks->EditValue ?>"<?php echo $leave_taken_search->Remarks->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$leave_taken_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $leave_taken_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$leave_taken_search->showPageFooter();
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
$leave_taken_search->terminate();
?>