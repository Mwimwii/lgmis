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
$staffqualifications_prof_search = new staffqualifications_prof_search();

// Run the page
$staffqualifications_prof_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$staffqualifications_prof_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fstaffqualifications_profsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($staffqualifications_prof_search->IsModal) { ?>
	fstaffqualifications_profsearch = currentAdvancedSearchForm = new ew.Form("fstaffqualifications_profsearch", "search");
	<?php } else { ?>
	fstaffqualifications_profsearch = currentForm = new ew.Form("fstaffqualifications_profsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fstaffqualifications_profsearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_EmployeeID");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($staffqualifications_prof_search->EmployeeID->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_FromYear");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($staffqualifications_prof_search->FromYear->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_YearObtained");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($staffqualifications_prof_search->YearObtained->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fstaffqualifications_profsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fstaffqualifications_profsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fstaffqualifications_profsearch.lists["x_ProfQualificationLevel"] = <?php echo $staffqualifications_prof_search->ProfQualificationLevel->Lookup->toClientList($staffqualifications_prof_search) ?>;
	fstaffqualifications_profsearch.lists["x_ProfQualificationLevel"].options = <?php echo JsonEncode($staffqualifications_prof_search->ProfQualificationLevel->lookupOptions()) ?>;
	fstaffqualifications_profsearch.lists["x_QualificationCode"] = <?php echo $staffqualifications_prof_search->QualificationCode->Lookup->toClientList($staffqualifications_prof_search) ?>;
	fstaffqualifications_profsearch.lists["x_QualificationCode"].options = <?php echo JsonEncode($staffqualifications_prof_search->QualificationCode->lookupOptions()) ?>;
	loadjs.done("fstaffqualifications_profsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $staffqualifications_prof_search->showPageHeader(); ?>
<?php
$staffqualifications_prof_search->showMessage();
?>
<form name="fstaffqualifications_profsearch" id="fstaffqualifications_profsearch" class="<?php echo $staffqualifications_prof_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="staffqualifications_prof">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$staffqualifications_prof_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($staffqualifications_prof_search->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label for="x_EmployeeID" class="<?php echo $staffqualifications_prof_search->LeftColumnClass ?>"><span id="elh_staffqualifications_prof_EmployeeID"><?php echo $staffqualifications_prof_search->EmployeeID->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_EmployeeID" id="z_EmployeeID" value="=">
</span>
		</label>
		<div class="<?php echo $staffqualifications_prof_search->RightColumnClass ?>"><div <?php echo $staffqualifications_prof_search->EmployeeID->cellAttributes() ?>>
			<span id="el_staffqualifications_prof_EmployeeID" class="ew-search-field">
<input type="text" data-table="staffqualifications_prof" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($staffqualifications_prof_search->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $staffqualifications_prof_search->EmployeeID->EditValue ?>"<?php echo $staffqualifications_prof_search->EmployeeID->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staffqualifications_prof_search->ProfQualificationLevel->Visible) { // ProfQualificationLevel ?>
	<div id="r_ProfQualificationLevel" class="form-group row">
		<label for="x_ProfQualificationLevel" class="<?php echo $staffqualifications_prof_search->LeftColumnClass ?>"><span id="elh_staffqualifications_prof_ProfQualificationLevel"><?php echo $staffqualifications_prof_search->ProfQualificationLevel->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ProfQualificationLevel" id="z_ProfQualificationLevel" value="LIKE">
</span>
		</label>
		<div class="<?php echo $staffqualifications_prof_search->RightColumnClass ?>"><div <?php echo $staffqualifications_prof_search->ProfQualificationLevel->cellAttributes() ?>>
			<span id="el_staffqualifications_prof_ProfQualificationLevel" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_ProfQualificationLevel"><?php echo EmptyValue(strval($staffqualifications_prof_search->ProfQualificationLevel->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $staffqualifications_prof_search->ProfQualificationLevel->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staffqualifications_prof_search->ProfQualificationLevel->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staffqualifications_prof_search->ProfQualificationLevel->ReadOnly || $staffqualifications_prof_search->ProfQualificationLevel->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_ProfQualificationLevel',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staffqualifications_prof_search->ProfQualificationLevel->Lookup->getParamTag($staffqualifications_prof_search, "p_x_ProfQualificationLevel") ?>
<input type="hidden" data-table="staffqualifications_prof" data-field="x_ProfQualificationLevel" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staffqualifications_prof_search->ProfQualificationLevel->displayValueSeparatorAttribute() ?>" name="x_ProfQualificationLevel" id="x_ProfQualificationLevel" value="<?php echo $staffqualifications_prof_search->ProfQualificationLevel->AdvancedSearch->SearchValue ?>"<?php echo $staffqualifications_prof_search->ProfQualificationLevel->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staffqualifications_prof_search->QualificationCode->Visible) { // QualificationCode ?>
	<div id="r_QualificationCode" class="form-group row">
		<label for="x_QualificationCode" class="<?php echo $staffqualifications_prof_search->LeftColumnClass ?>"><span id="elh_staffqualifications_prof_QualificationCode"><?php echo $staffqualifications_prof_search->QualificationCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_QualificationCode" id="z_QualificationCode" value="=">
</span>
		</label>
		<div class="<?php echo $staffqualifications_prof_search->RightColumnClass ?>"><div <?php echo $staffqualifications_prof_search->QualificationCode->cellAttributes() ?>>
			<span id="el_staffqualifications_prof_QualificationCode" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffqualifications_prof" data-field="x_QualificationCode" data-value-separator="<?php echo $staffqualifications_prof_search->QualificationCode->displayValueSeparatorAttribute() ?>" id="x_QualificationCode" name="x_QualificationCode"<?php echo $staffqualifications_prof_search->QualificationCode->editAttributes() ?>>
			<?php echo $staffqualifications_prof_search->QualificationCode->selectOptionListHtml("x_QualificationCode") ?>
		</select>
</div>
<?php echo $staffqualifications_prof_search->QualificationCode->Lookup->getParamTag($staffqualifications_prof_search, "p_x_QualificationCode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staffqualifications_prof_search->QualificationRemarks->Visible) { // QualificationRemarks ?>
	<div id="r_QualificationRemarks" class="form-group row">
		<label for="x_QualificationRemarks" class="<?php echo $staffqualifications_prof_search->LeftColumnClass ?>"><span id="elh_staffqualifications_prof_QualificationRemarks"><?php echo $staffqualifications_prof_search->QualificationRemarks->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_QualificationRemarks" id="z_QualificationRemarks" value="LIKE">
</span>
		</label>
		<div class="<?php echo $staffqualifications_prof_search->RightColumnClass ?>"><div <?php echo $staffqualifications_prof_search->QualificationRemarks->cellAttributes() ?>>
			<span id="el_staffqualifications_prof_QualificationRemarks" class="ew-search-field">
<input type="text" data-table="staffqualifications_prof" data-field="x_QualificationRemarks" name="x_QualificationRemarks" id="x_QualificationRemarks" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staffqualifications_prof_search->QualificationRemarks->getPlaceHolder()) ?>" value="<?php echo $staffqualifications_prof_search->QualificationRemarks->EditValue ?>"<?php echo $staffqualifications_prof_search->QualificationRemarks->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staffqualifications_prof_search->AwardingInstitution->Visible) { // AwardingInstitution ?>
	<div id="r_AwardingInstitution" class="form-group row">
		<label for="x_AwardingInstitution" class="<?php echo $staffqualifications_prof_search->LeftColumnClass ?>"><span id="elh_staffqualifications_prof_AwardingInstitution"><?php echo $staffqualifications_prof_search->AwardingInstitution->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_AwardingInstitution" id="z_AwardingInstitution" value="LIKE">
</span>
		</label>
		<div class="<?php echo $staffqualifications_prof_search->RightColumnClass ?>"><div <?php echo $staffqualifications_prof_search->AwardingInstitution->cellAttributes() ?>>
			<span id="el_staffqualifications_prof_AwardingInstitution" class="ew-search-field">
<input type="text" data-table="staffqualifications_prof" data-field="x_AwardingInstitution" name="x_AwardingInstitution" id="x_AwardingInstitution" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staffqualifications_prof_search->AwardingInstitution->getPlaceHolder()) ?>" value="<?php echo $staffqualifications_prof_search->AwardingInstitution->EditValue ?>"<?php echo $staffqualifications_prof_search->AwardingInstitution->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staffqualifications_prof_search->FromYear->Visible) { // FromYear ?>
	<div id="r_FromYear" class="form-group row">
		<label for="x_FromYear" class="<?php echo $staffqualifications_prof_search->LeftColumnClass ?>"><span id="elh_staffqualifications_prof_FromYear"><?php echo $staffqualifications_prof_search->FromYear->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_FromYear" id="z_FromYear" value="=">
</span>
		</label>
		<div class="<?php echo $staffqualifications_prof_search->RightColumnClass ?>"><div <?php echo $staffqualifications_prof_search->FromYear->cellAttributes() ?>>
			<span id="el_staffqualifications_prof_FromYear" class="ew-search-field">
<input type="text" data-table="staffqualifications_prof" data-field="x_FromYear" name="x_FromYear" id="x_FromYear" size="30" placeholder="<?php echo HtmlEncode($staffqualifications_prof_search->FromYear->getPlaceHolder()) ?>" value="<?php echo $staffqualifications_prof_search->FromYear->EditValue ?>"<?php echo $staffqualifications_prof_search->FromYear->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staffqualifications_prof_search->YearObtained->Visible) { // YearObtained ?>
	<div id="r_YearObtained" class="form-group row">
		<label for="x_YearObtained" class="<?php echo $staffqualifications_prof_search->LeftColumnClass ?>"><span id="elh_staffqualifications_prof_YearObtained"><?php echo $staffqualifications_prof_search->YearObtained->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_YearObtained" id="z_YearObtained" value="=">
</span>
		</label>
		<div class="<?php echo $staffqualifications_prof_search->RightColumnClass ?>"><div <?php echo $staffqualifications_prof_search->YearObtained->cellAttributes() ?>>
			<span id="el_staffqualifications_prof_YearObtained" class="ew-search-field">
<input type="text" data-table="staffqualifications_prof" data-field="x_YearObtained" name="x_YearObtained" id="x_YearObtained" size="30" placeholder="<?php echo HtmlEncode($staffqualifications_prof_search->YearObtained->getPlaceHolder()) ?>" value="<?php echo $staffqualifications_prof_search->YearObtained->EditValue ?>"<?php echo $staffqualifications_prof_search->YearObtained->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$staffqualifications_prof_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $staffqualifications_prof_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$staffqualifications_prof_search->showPageFooter();
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
$staffqualifications_prof_search->terminate();
?>