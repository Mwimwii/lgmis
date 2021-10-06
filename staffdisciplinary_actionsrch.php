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
$staffdisciplinary_action_search = new staffdisciplinary_action_search();

// Run the page
$staffdisciplinary_action_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$staffdisciplinary_action_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fstaffdisciplinary_actionsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($staffdisciplinary_action_search->IsModal) { ?>
	fstaffdisciplinary_actionsearch = currentAdvancedSearchForm = new ew.Form("fstaffdisciplinary_actionsearch", "search");
	<?php } else { ?>
	fstaffdisciplinary_actionsearch = currentForm = new ew.Form("fstaffdisciplinary_actionsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fstaffdisciplinary_actionsearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_EmployeeID");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($staffdisciplinary_action_search->EmployeeID->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_CaseNo");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($staffdisciplinary_action_search->CaseNo->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_OffenseCode");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($staffdisciplinary_action_search->OffenseCode->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ActionDate");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($staffdisciplinary_action_search->ActionDate->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_FromDate");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($staffdisciplinary_action_search->FromDate->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ToDate");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($staffdisciplinary_action_search->ToDate->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fstaffdisciplinary_actionsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fstaffdisciplinary_actionsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fstaffdisciplinary_actionsearch.lists["x_ActionTaken"] = <?php echo $staffdisciplinary_action_search->ActionTaken->Lookup->toClientList($staffdisciplinary_action_search) ?>;
	fstaffdisciplinary_actionsearch.lists["x_ActionTaken"].options = <?php echo JsonEncode($staffdisciplinary_action_search->ActionTaken->lookupOptions()) ?>;
	loadjs.done("fstaffdisciplinary_actionsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $staffdisciplinary_action_search->showPageHeader(); ?>
<?php
$staffdisciplinary_action_search->showMessage();
?>
<form name="fstaffdisciplinary_actionsearch" id="fstaffdisciplinary_actionsearch" class="<?php echo $staffdisciplinary_action_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="staffdisciplinary_action">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$staffdisciplinary_action_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($staffdisciplinary_action_search->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label for="x_EmployeeID" class="<?php echo $staffdisciplinary_action_search->LeftColumnClass ?>"><span id="elh_staffdisciplinary_action_EmployeeID"><?php echo $staffdisciplinary_action_search->EmployeeID->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_EmployeeID" id="z_EmployeeID" value="=">
</span>
		</label>
		<div class="<?php echo $staffdisciplinary_action_search->RightColumnClass ?>"><div <?php echo $staffdisciplinary_action_search->EmployeeID->cellAttributes() ?>>
			<span id="el_staffdisciplinary_action_EmployeeID" class="ew-search-field">
<input type="text" data-table="staffdisciplinary_action" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($staffdisciplinary_action_search->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_action_search->EmployeeID->EditValue ?>"<?php echo $staffdisciplinary_action_search->EmployeeID->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staffdisciplinary_action_search->CaseNo->Visible) { // CaseNo ?>
	<div id="r_CaseNo" class="form-group row">
		<label for="x_CaseNo" class="<?php echo $staffdisciplinary_action_search->LeftColumnClass ?>"><span id="elh_staffdisciplinary_action_CaseNo"><?php echo $staffdisciplinary_action_search->CaseNo->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_CaseNo" id="z_CaseNo" value="=">
</span>
		</label>
		<div class="<?php echo $staffdisciplinary_action_search->RightColumnClass ?>"><div <?php echo $staffdisciplinary_action_search->CaseNo->cellAttributes() ?>>
			<span id="el_staffdisciplinary_action_CaseNo" class="ew-search-field">
<input type="text" data-table="staffdisciplinary_action" data-field="x_CaseNo" name="x_CaseNo" id="x_CaseNo" placeholder="<?php echo HtmlEncode($staffdisciplinary_action_search->CaseNo->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_action_search->CaseNo->EditValue ?>"<?php echo $staffdisciplinary_action_search->CaseNo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staffdisciplinary_action_search->OffenseCode->Visible) { // OffenseCode ?>
	<div id="r_OffenseCode" class="form-group row">
		<label for="x_OffenseCode" class="<?php echo $staffdisciplinary_action_search->LeftColumnClass ?>"><span id="elh_staffdisciplinary_action_OffenseCode"><?php echo $staffdisciplinary_action_search->OffenseCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_OffenseCode" id="z_OffenseCode" value="=">
</span>
		</label>
		<div class="<?php echo $staffdisciplinary_action_search->RightColumnClass ?>"><div <?php echo $staffdisciplinary_action_search->OffenseCode->cellAttributes() ?>>
			<span id="el_staffdisciplinary_action_OffenseCode" class="ew-search-field">
<input type="text" data-table="staffdisciplinary_action" data-field="x_OffenseCode" name="x_OffenseCode" id="x_OffenseCode" size="30" placeholder="<?php echo HtmlEncode($staffdisciplinary_action_search->OffenseCode->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_action_search->OffenseCode->EditValue ?>"<?php echo $staffdisciplinary_action_search->OffenseCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staffdisciplinary_action_search->ActionTaken->Visible) { // ActionTaken ?>
	<div id="r_ActionTaken" class="form-group row">
		<label for="x_ActionTaken" class="<?php echo $staffdisciplinary_action_search->LeftColumnClass ?>"><span id="elh_staffdisciplinary_action_ActionTaken"><?php echo $staffdisciplinary_action_search->ActionTaken->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ActionTaken" id="z_ActionTaken" value="=">
</span>
		</label>
		<div class="<?php echo $staffdisciplinary_action_search->RightColumnClass ?>"><div <?php echo $staffdisciplinary_action_search->ActionTaken->cellAttributes() ?>>
			<span id="el_staffdisciplinary_action_ActionTaken" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffdisciplinary_action" data-field="x_ActionTaken" data-value-separator="<?php echo $staffdisciplinary_action_search->ActionTaken->displayValueSeparatorAttribute() ?>" id="x_ActionTaken" name="x_ActionTaken"<?php echo $staffdisciplinary_action_search->ActionTaken->editAttributes() ?>>
			<?php echo $staffdisciplinary_action_search->ActionTaken->selectOptionListHtml("x_ActionTaken") ?>
		</select>
</div>
<?php echo $staffdisciplinary_action_search->ActionTaken->Lookup->getParamTag($staffdisciplinary_action_search, "p_x_ActionTaken") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staffdisciplinary_action_search->ActionDescription->Visible) { // ActionDescription ?>
	<div id="r_ActionDescription" class="form-group row">
		<label for="x_ActionDescription" class="<?php echo $staffdisciplinary_action_search->LeftColumnClass ?>"><span id="elh_staffdisciplinary_action_ActionDescription"><?php echo $staffdisciplinary_action_search->ActionDescription->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ActionDescription" id="z_ActionDescription" value="LIKE">
</span>
		</label>
		<div class="<?php echo $staffdisciplinary_action_search->RightColumnClass ?>"><div <?php echo $staffdisciplinary_action_search->ActionDescription->cellAttributes() ?>>
			<span id="el_staffdisciplinary_action_ActionDescription" class="ew-search-field">
<input type="text" data-table="staffdisciplinary_action" data-field="x_ActionDescription" name="x_ActionDescription" id="x_ActionDescription" size="35" placeholder="<?php echo HtmlEncode($staffdisciplinary_action_search->ActionDescription->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_action_search->ActionDescription->EditValue ?>"<?php echo $staffdisciplinary_action_search->ActionDescription->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staffdisciplinary_action_search->ActionDate->Visible) { // ActionDate ?>
	<div id="r_ActionDate" class="form-group row">
		<label for="x_ActionDate" class="<?php echo $staffdisciplinary_action_search->LeftColumnClass ?>"><span id="elh_staffdisciplinary_action_ActionDate"><?php echo $staffdisciplinary_action_search->ActionDate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ActionDate" id="z_ActionDate" value="=">
</span>
		</label>
		<div class="<?php echo $staffdisciplinary_action_search->RightColumnClass ?>"><div <?php echo $staffdisciplinary_action_search->ActionDate->cellAttributes() ?>>
			<span id="el_staffdisciplinary_action_ActionDate" class="ew-search-field">
<input type="text" data-table="staffdisciplinary_action" data-field="x_ActionDate" name="x_ActionDate" id="x_ActionDate" placeholder="<?php echo HtmlEncode($staffdisciplinary_action_search->ActionDate->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_action_search->ActionDate->EditValue ?>"<?php echo $staffdisciplinary_action_search->ActionDate->editAttributes() ?>>
<?php if (!$staffdisciplinary_action_search->ActionDate->ReadOnly && !$staffdisciplinary_action_search->ActionDate->Disabled && !isset($staffdisciplinary_action_search->ActionDate->EditAttrs["readonly"]) && !isset($staffdisciplinary_action_search->ActionDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_actionsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_actionsearch", "x_ActionDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staffdisciplinary_action_search->FromDate->Visible) { // FromDate ?>
	<div id="r_FromDate" class="form-group row">
		<label for="x_FromDate" class="<?php echo $staffdisciplinary_action_search->LeftColumnClass ?>"><span id="elh_staffdisciplinary_action_FromDate"><?php echo $staffdisciplinary_action_search->FromDate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_FromDate" id="z_FromDate" value="=">
</span>
		</label>
		<div class="<?php echo $staffdisciplinary_action_search->RightColumnClass ?>"><div <?php echo $staffdisciplinary_action_search->FromDate->cellAttributes() ?>>
			<span id="el_staffdisciplinary_action_FromDate" class="ew-search-field">
<input type="text" data-table="staffdisciplinary_action" data-field="x_FromDate" name="x_FromDate" id="x_FromDate" placeholder="<?php echo HtmlEncode($staffdisciplinary_action_search->FromDate->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_action_search->FromDate->EditValue ?>"<?php echo $staffdisciplinary_action_search->FromDate->editAttributes() ?>>
<?php if (!$staffdisciplinary_action_search->FromDate->ReadOnly && !$staffdisciplinary_action_search->FromDate->Disabled && !isset($staffdisciplinary_action_search->FromDate->EditAttrs["readonly"]) && !isset($staffdisciplinary_action_search->FromDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_actionsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_actionsearch", "x_FromDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staffdisciplinary_action_search->ToDate->Visible) { // ToDate ?>
	<div id="r_ToDate" class="form-group row">
		<label for="x_ToDate" class="<?php echo $staffdisciplinary_action_search->LeftColumnClass ?>"><span id="elh_staffdisciplinary_action_ToDate"><?php echo $staffdisciplinary_action_search->ToDate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ToDate" id="z_ToDate" value="=">
</span>
		</label>
		<div class="<?php echo $staffdisciplinary_action_search->RightColumnClass ?>"><div <?php echo $staffdisciplinary_action_search->ToDate->cellAttributes() ?>>
			<span id="el_staffdisciplinary_action_ToDate" class="ew-search-field">
<input type="text" data-table="staffdisciplinary_action" data-field="x_ToDate" name="x_ToDate" id="x_ToDate" placeholder="<?php echo HtmlEncode($staffdisciplinary_action_search->ToDate->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_action_search->ToDate->EditValue ?>"<?php echo $staffdisciplinary_action_search->ToDate->editAttributes() ?>>
<?php if (!$staffdisciplinary_action_search->ToDate->ReadOnly && !$staffdisciplinary_action_search->ToDate->Disabled && !isset($staffdisciplinary_action_search->ToDate->EditAttrs["readonly"]) && !isset($staffdisciplinary_action_search->ToDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_actionsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_actionsearch", "x_ToDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$staffdisciplinary_action_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $staffdisciplinary_action_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$staffdisciplinary_action_search->showPageFooter();
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
$staffdisciplinary_action_search->terminate();
?>