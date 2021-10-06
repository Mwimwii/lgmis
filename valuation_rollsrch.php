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
$valuation_roll_search = new valuation_roll_search();

// Run the page
$valuation_roll_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$valuation_roll_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fvaluation_rollsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($valuation_roll_search->IsModal) { ?>
	fvaluation_rollsearch = currentAdvancedSearchForm = new ew.Form("fvaluation_rollsearch", "search");
	<?php } else { ?>
	fvaluation_rollsearch = currentForm = new ew.Form("fvaluation_rollsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fvaluation_rollsearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_LandExtent");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($valuation_roll_search->LandExtent->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_LandValue");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($valuation_roll_search->LandValue->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ImprovementsValue");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($valuation_roll_search->ImprovementsValue->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ValuationDate");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($valuation_roll_search->ValuationDate->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fvaluation_rollsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fvaluation_rollsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fvaluation_rollsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $valuation_roll_search->showPageHeader(); ?>
<?php
$valuation_roll_search->showMessage();
?>
<form name="fvaluation_rollsearch" id="fvaluation_rollsearch" class="<?php echo $valuation_roll_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="valuation_roll">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$valuation_roll_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($valuation_roll_search->PropertyNo->Visible) { // PropertyNo ?>
	<div id="r_PropertyNo" class="form-group row">
		<label for="x_PropertyNo" class="<?php echo $valuation_roll_search->LeftColumnClass ?>"><span id="elh_valuation_roll_PropertyNo"><?php echo $valuation_roll_search->PropertyNo->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PropertyNo" id="z_PropertyNo" value="LIKE">
</span>
		</label>
		<div class="<?php echo $valuation_roll_search->RightColumnClass ?>"><div <?php echo $valuation_roll_search->PropertyNo->cellAttributes() ?>>
			<span id="el_valuation_roll_PropertyNo" class="ew-search-field">
<input type="text" data-table="valuation_roll" data-field="x_PropertyNo" name="x_PropertyNo" id="x_PropertyNo" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($valuation_roll_search->PropertyNo->getPlaceHolder()) ?>" value="<?php echo $valuation_roll_search->PropertyNo->EditValue ?>"<?php echo $valuation_roll_search->PropertyNo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($valuation_roll_search->Description->Visible) { // Description ?>
	<div id="r_Description" class="form-group row">
		<label for="x_Description" class="<?php echo $valuation_roll_search->LeftColumnClass ?>"><span id="elh_valuation_roll_Description"><?php echo $valuation_roll_search->Description->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Description" id="z_Description" value="LIKE">
</span>
		</label>
		<div class="<?php echo $valuation_roll_search->RightColumnClass ?>"><div <?php echo $valuation_roll_search->Description->cellAttributes() ?>>
			<span id="el_valuation_roll_Description" class="ew-search-field">
<input type="text" data-table="valuation_roll" data-field="x_Description" name="x_Description" id="x_Description" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($valuation_roll_search->Description->getPlaceHolder()) ?>" value="<?php echo $valuation_roll_search->Description->EditValue ?>"<?php echo $valuation_roll_search->Description->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($valuation_roll_search->Location->Visible) { // Location ?>
	<div id="r_Location" class="form-group row">
		<label for="x_Location" class="<?php echo $valuation_roll_search->LeftColumnClass ?>"><span id="elh_valuation_roll_Location"><?php echo $valuation_roll_search->Location->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Location" id="z_Location" value="LIKE">
</span>
		</label>
		<div class="<?php echo $valuation_roll_search->RightColumnClass ?>"><div <?php echo $valuation_roll_search->Location->cellAttributes() ?>>
			<span id="el_valuation_roll_Location" class="ew-search-field">
<input type="text" data-table="valuation_roll" data-field="x_Location" name="x_Location" id="x_Location" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($valuation_roll_search->Location->getPlaceHolder()) ?>" value="<?php echo $valuation_roll_search->Location->EditValue ?>"<?php echo $valuation_roll_search->Location->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($valuation_roll_search->Leaseholder->Visible) { // Leaseholder ?>
	<div id="r_Leaseholder" class="form-group row">
		<label for="x_Leaseholder" class="<?php echo $valuation_roll_search->LeftColumnClass ?>"><span id="elh_valuation_roll_Leaseholder"><?php echo $valuation_roll_search->Leaseholder->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Leaseholder" id="z_Leaseholder" value="LIKE">
</span>
		</label>
		<div class="<?php echo $valuation_roll_search->RightColumnClass ?>"><div <?php echo $valuation_roll_search->Leaseholder->cellAttributes() ?>>
			<span id="el_valuation_roll_Leaseholder" class="ew-search-field">
<input type="text" data-table="valuation_roll" data-field="x_Leaseholder" name="x_Leaseholder" id="x_Leaseholder" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($valuation_roll_search->Leaseholder->getPlaceHolder()) ?>" value="<?php echo $valuation_roll_search->Leaseholder->EditValue ?>"<?php echo $valuation_roll_search->Leaseholder->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($valuation_roll_search->PropertyUse->Visible) { // PropertyUse ?>
	<div id="r_PropertyUse" class="form-group row">
		<label for="x_PropertyUse" class="<?php echo $valuation_roll_search->LeftColumnClass ?>"><span id="elh_valuation_roll_PropertyUse"><?php echo $valuation_roll_search->PropertyUse->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PropertyUse" id="z_PropertyUse" value="LIKE">
</span>
		</label>
		<div class="<?php echo $valuation_roll_search->RightColumnClass ?>"><div <?php echo $valuation_roll_search->PropertyUse->cellAttributes() ?>>
			<span id="el_valuation_roll_PropertyUse" class="ew-search-field">
<input type="text" data-table="valuation_roll" data-field="x_PropertyUse" name="x_PropertyUse" id="x_PropertyUse" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($valuation_roll_search->PropertyUse->getPlaceHolder()) ?>" value="<?php echo $valuation_roll_search->PropertyUse->EditValue ?>"<?php echo $valuation_roll_search->PropertyUse->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($valuation_roll_search->LandExtent->Visible) { // LandExtent ?>
	<div id="r_LandExtent" class="form-group row">
		<label for="x_LandExtent" class="<?php echo $valuation_roll_search->LeftColumnClass ?>"><span id="elh_valuation_roll_LandExtent"><?php echo $valuation_roll_search->LandExtent->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_LandExtent" id="z_LandExtent" value="=">
</span>
		</label>
		<div class="<?php echo $valuation_roll_search->RightColumnClass ?>"><div <?php echo $valuation_roll_search->LandExtent->cellAttributes() ?>>
			<span id="el_valuation_roll_LandExtent" class="ew-search-field">
<input type="text" data-table="valuation_roll" data-field="x_LandExtent" name="x_LandExtent" id="x_LandExtent" size="30" placeholder="<?php echo HtmlEncode($valuation_roll_search->LandExtent->getPlaceHolder()) ?>" value="<?php echo $valuation_roll_search->LandExtent->EditValue ?>"<?php echo $valuation_roll_search->LandExtent->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($valuation_roll_search->LandValue->Visible) { // LandValue ?>
	<div id="r_LandValue" class="form-group row">
		<label for="x_LandValue" class="<?php echo $valuation_roll_search->LeftColumnClass ?>"><span id="elh_valuation_roll_LandValue"><?php echo $valuation_roll_search->LandValue->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_LandValue" id="z_LandValue" value="=">
</span>
		</label>
		<div class="<?php echo $valuation_roll_search->RightColumnClass ?>"><div <?php echo $valuation_roll_search->LandValue->cellAttributes() ?>>
			<span id="el_valuation_roll_LandValue" class="ew-search-field">
<input type="text" data-table="valuation_roll" data-field="x_LandValue" name="x_LandValue" id="x_LandValue" size="30" placeholder="<?php echo HtmlEncode($valuation_roll_search->LandValue->getPlaceHolder()) ?>" value="<?php echo $valuation_roll_search->LandValue->EditValue ?>"<?php echo $valuation_roll_search->LandValue->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($valuation_roll_search->ImprovementsValue->Visible) { // ImprovementsValue ?>
	<div id="r_ImprovementsValue" class="form-group row">
		<label for="x_ImprovementsValue" class="<?php echo $valuation_roll_search->LeftColumnClass ?>"><span id="elh_valuation_roll_ImprovementsValue"><?php echo $valuation_roll_search->ImprovementsValue->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ImprovementsValue" id="z_ImprovementsValue" value="=">
</span>
		</label>
		<div class="<?php echo $valuation_roll_search->RightColumnClass ?>"><div <?php echo $valuation_roll_search->ImprovementsValue->cellAttributes() ?>>
			<span id="el_valuation_roll_ImprovementsValue" class="ew-search-field">
<input type="text" data-table="valuation_roll" data-field="x_ImprovementsValue" name="x_ImprovementsValue" id="x_ImprovementsValue" size="30" placeholder="<?php echo HtmlEncode($valuation_roll_search->ImprovementsValue->getPlaceHolder()) ?>" value="<?php echo $valuation_roll_search->ImprovementsValue->EditValue ?>"<?php echo $valuation_roll_search->ImprovementsValue->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($valuation_roll_search->RateableValue->Visible) { // RateableValue ?>
	<div id="r_RateableValue" class="form-group row">
		<label for="x_RateableValue" class="<?php echo $valuation_roll_search->LeftColumnClass ?>"><span id="elh_valuation_roll_RateableValue"><?php echo $valuation_roll_search->RateableValue->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_RateableValue" id="z_RateableValue" value="LIKE">
</span>
		</label>
		<div class="<?php echo $valuation_roll_search->RightColumnClass ?>"><div <?php echo $valuation_roll_search->RateableValue->cellAttributes() ?>>
			<span id="el_valuation_roll_RateableValue" class="ew-search-field">
<input type="text" data-table="valuation_roll" data-field="x_RateableValue" name="x_RateableValue" id="x_RateableValue" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($valuation_roll_search->RateableValue->getPlaceHolder()) ?>" value="<?php echo $valuation_roll_search->RateableValue->EditValue ?>"<?php echo $valuation_roll_search->RateableValue->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($valuation_roll_search->Remarks->Visible) { // Remarks ?>
	<div id="r_Remarks" class="form-group row">
		<label for="x_Remarks" class="<?php echo $valuation_roll_search->LeftColumnClass ?>"><span id="elh_valuation_roll_Remarks"><?php echo $valuation_roll_search->Remarks->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Remarks" id="z_Remarks" value="LIKE">
</span>
		</label>
		<div class="<?php echo $valuation_roll_search->RightColumnClass ?>"><div <?php echo $valuation_roll_search->Remarks->cellAttributes() ?>>
			<span id="el_valuation_roll_Remarks" class="ew-search-field">
<input type="text" data-table="valuation_roll" data-field="x_Remarks" name="x_Remarks" id="x_Remarks" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($valuation_roll_search->Remarks->getPlaceHolder()) ?>" value="<?php echo $valuation_roll_search->Remarks->EditValue ?>"<?php echo $valuation_roll_search->Remarks->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($valuation_roll_search->ValuationDate->Visible) { // ValuationDate ?>
	<div id="r_ValuationDate" class="form-group row">
		<label for="x_ValuationDate" class="<?php echo $valuation_roll_search->LeftColumnClass ?>"><span id="elh_valuation_roll_ValuationDate"><?php echo $valuation_roll_search->ValuationDate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ValuationDate" id="z_ValuationDate" value="=">
</span>
		</label>
		<div class="<?php echo $valuation_roll_search->RightColumnClass ?>"><div <?php echo $valuation_roll_search->ValuationDate->cellAttributes() ?>>
			<span id="el_valuation_roll_ValuationDate" class="ew-search-field">
<input type="text" data-table="valuation_roll" data-field="x_ValuationDate" name="x_ValuationDate" id="x_ValuationDate" placeholder="<?php echo HtmlEncode($valuation_roll_search->ValuationDate->getPlaceHolder()) ?>" value="<?php echo $valuation_roll_search->ValuationDate->EditValue ?>"<?php echo $valuation_roll_search->ValuationDate->editAttributes() ?>>
<?php if (!$valuation_roll_search->ValuationDate->ReadOnly && !$valuation_roll_search->ValuationDate->Disabled && !isset($valuation_roll_search->ValuationDate->EditAttrs["readonly"]) && !isset($valuation_roll_search->ValuationDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fvaluation_rollsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fvaluation_rollsearch", "x_ValuationDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($valuation_roll_search->ValuationReference->Visible) { // ValuationReference ?>
	<div id="r_ValuationReference" class="form-group row">
		<label for="x_ValuationReference" class="<?php echo $valuation_roll_search->LeftColumnClass ?>"><span id="elh_valuation_roll_ValuationReference"><?php echo $valuation_roll_search->ValuationReference->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ValuationReference" id="z_ValuationReference" value="LIKE">
</span>
		</label>
		<div class="<?php echo $valuation_roll_search->RightColumnClass ?>"><div <?php echo $valuation_roll_search->ValuationReference->cellAttributes() ?>>
			<span id="el_valuation_roll_ValuationReference" class="ew-search-field">
<input type="text" data-table="valuation_roll" data-field="x_ValuationReference" name="x_ValuationReference" id="x_ValuationReference" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($valuation_roll_search->ValuationReference->getPlaceHolder()) ?>" value="<?php echo $valuation_roll_search->ValuationReference->EditValue ?>"<?php echo $valuation_roll_search->ValuationReference->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$valuation_roll_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $valuation_roll_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$valuation_roll_search->showPageFooter();
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
$valuation_roll_search->terminate();
?>