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
$ndp_search = new ndp_search();

// Run the page
$ndp_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ndp_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fndpsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($ndp_search->IsModal) { ?>
	fndpsearch = currentAdvancedSearchForm = new ew.Form("fndpsearch", "search");
	<?php } else { ?>
	fndpsearch = currentForm = new ew.Form("fndpsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fndpsearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_NDP");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($ndp_search->NDP->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_FromYear");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($ndp_search->FromYear->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ToYear");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($ndp_search->ToYear->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_EffectiveDate");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($ndp_search->EffectiveDate->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fndpsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fndpsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fndpsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $ndp_search->showPageHeader(); ?>
<?php
$ndp_search->showMessage();
?>
<form name="fndpsearch" id="fndpsearch" class="<?php echo $ndp_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ndp">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$ndp_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($ndp_search->NDP->Visible) { // NDP ?>
	<div id="r_NDP" class="form-group row">
		<label for="x_NDP" class="<?php echo $ndp_search->LeftColumnClass ?>"><span id="elh_ndp_NDP"><?php echo $ndp_search->NDP->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_NDP" id="z_NDP" value="=">
</span>
		</label>
		<div class="<?php echo $ndp_search->RightColumnClass ?>"><div <?php echo $ndp_search->NDP->cellAttributes() ?>>
			<span id="el_ndp_NDP" class="ew-search-field">
<input type="text" data-table="ndp" data-field="x_NDP" name="x_NDP" id="x_NDP" size="30" placeholder="<?php echo HtmlEncode($ndp_search->NDP->getPlaceHolder()) ?>" value="<?php echo $ndp_search->NDP->EditValue ?>"<?php echo $ndp_search->NDP->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($ndp_search->NDPShortName->Visible) { // NDPShortName ?>
	<div id="r_NDPShortName" class="form-group row">
		<label for="x_NDPShortName" class="<?php echo $ndp_search->LeftColumnClass ?>"><span id="elh_ndp_NDPShortName"><?php echo $ndp_search->NDPShortName->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_NDPShortName" id="z_NDPShortName" value="LIKE">
</span>
		</label>
		<div class="<?php echo $ndp_search->RightColumnClass ?>"><div <?php echo $ndp_search->NDPShortName->cellAttributes() ?>>
			<span id="el_ndp_NDPShortName" class="ew-search-field">
<input type="text" data-table="ndp" data-field="x_NDPShortName" name="x_NDPShortName" id="x_NDPShortName" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($ndp_search->NDPShortName->getPlaceHolder()) ?>" value="<?php echo $ndp_search->NDPShortName->EditValue ?>"<?php echo $ndp_search->NDPShortName->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($ndp_search->FromYear->Visible) { // FromYear ?>
	<div id="r_FromYear" class="form-group row">
		<label for="x_FromYear" class="<?php echo $ndp_search->LeftColumnClass ?>"><span id="elh_ndp_FromYear"><?php echo $ndp_search->FromYear->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_FromYear" id="z_FromYear" value="=">
</span>
		</label>
		<div class="<?php echo $ndp_search->RightColumnClass ?>"><div <?php echo $ndp_search->FromYear->cellAttributes() ?>>
			<span id="el_ndp_FromYear" class="ew-search-field">
<input type="text" data-table="ndp" data-field="x_FromYear" name="x_FromYear" id="x_FromYear" size="30" placeholder="<?php echo HtmlEncode($ndp_search->FromYear->getPlaceHolder()) ?>" value="<?php echo $ndp_search->FromYear->EditValue ?>"<?php echo $ndp_search->FromYear->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($ndp_search->ToYear->Visible) { // ToYear ?>
	<div id="r_ToYear" class="form-group row">
		<label for="x_ToYear" class="<?php echo $ndp_search->LeftColumnClass ?>"><span id="elh_ndp_ToYear"><?php echo $ndp_search->ToYear->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ToYear" id="z_ToYear" value="=">
</span>
		</label>
		<div class="<?php echo $ndp_search->RightColumnClass ?>"><div <?php echo $ndp_search->ToYear->cellAttributes() ?>>
			<span id="el_ndp_ToYear" class="ew-search-field">
<input type="text" data-table="ndp" data-field="x_ToYear" name="x_ToYear" id="x_ToYear" size="30" placeholder="<?php echo HtmlEncode($ndp_search->ToYear->getPlaceHolder()) ?>" value="<?php echo $ndp_search->ToYear->EditValue ?>"<?php echo $ndp_search->ToYear->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($ndp_search->NDPDeascription->Visible) { // NDPDeascription ?>
	<div id="r_NDPDeascription" class="form-group row">
		<label for="x_NDPDeascription" class="<?php echo $ndp_search->LeftColumnClass ?>"><span id="elh_ndp_NDPDeascription"><?php echo $ndp_search->NDPDeascription->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_NDPDeascription" id="z_NDPDeascription" value="LIKE">
</span>
		</label>
		<div class="<?php echo $ndp_search->RightColumnClass ?>"><div <?php echo $ndp_search->NDPDeascription->cellAttributes() ?>>
			<span id="el_ndp_NDPDeascription" class="ew-search-field">
<input type="text" data-table="ndp" data-field="x_NDPDeascription" name="x_NDPDeascription" id="x_NDPDeascription" size="35" placeholder="<?php echo HtmlEncode($ndp_search->NDPDeascription->getPlaceHolder()) ?>" value="<?php echo $ndp_search->NDPDeascription->EditValue ?>"<?php echo $ndp_search->NDPDeascription->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($ndp_search->NDPObjectives->Visible) { // NDPObjectives ?>
	<div id="r_NDPObjectives" class="form-group row">
		<label for="x_NDPObjectives" class="<?php echo $ndp_search->LeftColumnClass ?>"><span id="elh_ndp_NDPObjectives"><?php echo $ndp_search->NDPObjectives->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_NDPObjectives" id="z_NDPObjectives" value="LIKE">
</span>
		</label>
		<div class="<?php echo $ndp_search->RightColumnClass ?>"><div <?php echo $ndp_search->NDPObjectives->cellAttributes() ?>>
			<span id="el_ndp_NDPObjectives" class="ew-search-field">
<input type="text" data-table="ndp" data-field="x_NDPObjectives" name="x_NDPObjectives" id="x_NDPObjectives" size="35" maxlength="255" placeholder="<?php echo HtmlEncode($ndp_search->NDPObjectives->getPlaceHolder()) ?>" value="<?php echo $ndp_search->NDPObjectives->EditValue ?>"<?php echo $ndp_search->NDPObjectives->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($ndp_search->EffectiveDate->Visible) { // EffectiveDate ?>
	<div id="r_EffectiveDate" class="form-group row">
		<label for="x_EffectiveDate" class="<?php echo $ndp_search->LeftColumnClass ?>"><span id="elh_ndp_EffectiveDate"><?php echo $ndp_search->EffectiveDate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_EffectiveDate" id="z_EffectiveDate" value="=">
</span>
		</label>
		<div class="<?php echo $ndp_search->RightColumnClass ?>"><div <?php echo $ndp_search->EffectiveDate->cellAttributes() ?>>
			<span id="el_ndp_EffectiveDate" class="ew-search-field">
<input type="text" data-table="ndp" data-field="x_EffectiveDate" name="x_EffectiveDate" id="x_EffectiveDate" placeholder="<?php echo HtmlEncode($ndp_search->EffectiveDate->getPlaceHolder()) ?>" value="<?php echo $ndp_search->EffectiveDate->EditValue ?>"<?php echo $ndp_search->EffectiveDate->editAttributes() ?>>
<?php if (!$ndp_search->EffectiveDate->ReadOnly && !$ndp_search->EffectiveDate->Disabled && !isset($ndp_search->EffectiveDate->EditAttrs["readonly"]) && !isset($ndp_search->EffectiveDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fndpsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fndpsearch", "x_EffectiveDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($ndp_search->NDPURL->Visible) { // NDPURL ?>
	<div id="r_NDPURL" class="form-group row">
		<label for="x_NDPURL" class="<?php echo $ndp_search->LeftColumnClass ?>"><span id="elh_ndp_NDPURL"><?php echo $ndp_search->NDPURL->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_NDPURL" id="z_NDPURL" value="LIKE">
</span>
		</label>
		<div class="<?php echo $ndp_search->RightColumnClass ?>"><div <?php echo $ndp_search->NDPURL->cellAttributes() ?>>
			<span id="el_ndp_NDPURL" class="ew-search-field">
<input type="text" data-table="ndp" data-field="x_NDPURL" name="x_NDPURL" id="x_NDPURL" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($ndp_search->NDPURL->getPlaceHolder()) ?>" value="<?php echo $ndp_search->NDPURL->EditValue ?>"<?php echo $ndp_search->NDPURL->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$ndp_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $ndp_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$ndp_search->showPageFooter();
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
$ndp_search->terminate();
?>