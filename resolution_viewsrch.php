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
$resolution_view_search = new resolution_view_search();

// Run the page
$resolution_view_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$resolution_view_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fresolution_viewsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($resolution_view_search->IsModal) { ?>
	fresolution_viewsearch = currentAdvancedSearchForm = new ew.Form("fresolution_viewsearch", "search");
	<?php } else { ?>
	fresolution_viewsearch = currentForm = new ew.Form("fresolution_viewsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fresolution_viewsearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_MeetingNo");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($resolution_view_search->MeetingNo->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_MeetingType");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($resolution_view_search->MeetingType->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ActualDate");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($resolution_view_search->ActualDate->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ResolutionNo");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($resolution_view_search->ResolutionNo->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ActionDate");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($resolution_view_search->ActionDate->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fresolution_viewsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fresolution_viewsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fresolution_viewsearch.lists["x_ProvinceCode"] = <?php echo $resolution_view_search->ProvinceCode->Lookup->toClientList($resolution_view_search) ?>;
	fresolution_viewsearch.lists["x_ProvinceCode"].options = <?php echo JsonEncode($resolution_view_search->ProvinceCode->lookupOptions()) ?>;
	loadjs.done("fresolution_viewsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $resolution_view_search->showPageHeader(); ?>
<?php
$resolution_view_search->showMessage();
?>
<form name="fresolution_viewsearch" id="fresolution_viewsearch" class="<?php echo $resolution_view_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="resolution_view">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$resolution_view_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($resolution_view_search->ProvinceCode->Visible) { // ProvinceCode ?>
	<div id="r_ProvinceCode" class="form-group row">
		<label for="x_ProvinceCode" class="<?php echo $resolution_view_search->LeftColumnClass ?>"><span id="elh_resolution_view_ProvinceCode"><?php echo $resolution_view_search->ProvinceCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ProvinceCode" id="z_ProvinceCode" value="=">
</span>
		</label>
		<div class="<?php echo $resolution_view_search->RightColumnClass ?>"><div <?php echo $resolution_view_search->ProvinceCode->cellAttributes() ?>>
			<span id="el_resolution_view_ProvinceCode" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="resolution_view" data-field="x_ProvinceCode" data-value-separator="<?php echo $resolution_view_search->ProvinceCode->displayValueSeparatorAttribute() ?>" id="x_ProvinceCode" name="x_ProvinceCode"<?php echo $resolution_view_search->ProvinceCode->editAttributes() ?>>
			<?php echo $resolution_view_search->ProvinceCode->selectOptionListHtml("x_ProvinceCode") ?>
		</select>
</div>
<?php echo $resolution_view_search->ProvinceCode->Lookup->getParamTag($resolution_view_search, "p_x_ProvinceCode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($resolution_view_search->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label for="x_LACode" class="<?php echo $resolution_view_search->LeftColumnClass ?>"><span id="elh_resolution_view_LACode"><?php echo $resolution_view_search->LACode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_LACode" id="z_LACode" value="LIKE">
</span>
		</label>
		<div class="<?php echo $resolution_view_search->RightColumnClass ?>"><div <?php echo $resolution_view_search->LACode->cellAttributes() ?>>
			<span id="el_resolution_view_LACode" class="ew-search-field">
<input type="text" data-table="resolution_view" data-field="x_LACode" name="x_LACode" id="x_LACode" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($resolution_view_search->LACode->getPlaceHolder()) ?>" value="<?php echo $resolution_view_search->LACode->EditValue ?>"<?php echo $resolution_view_search->LACode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($resolution_view_search->LAName->Visible) { // LAName ?>
	<div id="r_LAName" class="form-group row">
		<label for="x_LAName" class="<?php echo $resolution_view_search->LeftColumnClass ?>"><span id="elh_resolution_view_LAName"><?php echo $resolution_view_search->LAName->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_LAName" id="z_LAName" value="LIKE">
</span>
		</label>
		<div class="<?php echo $resolution_view_search->RightColumnClass ?>"><div <?php echo $resolution_view_search->LAName->cellAttributes() ?>>
			<span id="el_resolution_view_LAName" class="ew-search-field">
<input type="text" data-table="resolution_view" data-field="x_LAName" name="x_LAName" id="x_LAName" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($resolution_view_search->LAName->getPlaceHolder()) ?>" value="<?php echo $resolution_view_search->LAName->EditValue ?>"<?php echo $resolution_view_search->LAName->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($resolution_view_search->MeetingNo->Visible) { // MeetingNo ?>
	<div id="r_MeetingNo" class="form-group row">
		<label for="x_MeetingNo" class="<?php echo $resolution_view_search->LeftColumnClass ?>"><span id="elh_resolution_view_MeetingNo"><?php echo $resolution_view_search->MeetingNo->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_MeetingNo" id="z_MeetingNo" value="=">
</span>
		</label>
		<div class="<?php echo $resolution_view_search->RightColumnClass ?>"><div <?php echo $resolution_view_search->MeetingNo->cellAttributes() ?>>
			<span id="el_resolution_view_MeetingNo" class="ew-search-field">
<input type="text" data-table="resolution_view" data-field="x_MeetingNo" name="x_MeetingNo" id="x_MeetingNo" placeholder="<?php echo HtmlEncode($resolution_view_search->MeetingNo->getPlaceHolder()) ?>" value="<?php echo $resolution_view_search->MeetingNo->EditValue ?>"<?php echo $resolution_view_search->MeetingNo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($resolution_view_search->MeetingRef->Visible) { // MeetingRef ?>
	<div id="r_MeetingRef" class="form-group row">
		<label for="x_MeetingRef" class="<?php echo $resolution_view_search->LeftColumnClass ?>"><span id="elh_resolution_view_MeetingRef"><?php echo $resolution_view_search->MeetingRef->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_MeetingRef" id="z_MeetingRef" value="LIKE">
</span>
		</label>
		<div class="<?php echo $resolution_view_search->RightColumnClass ?>"><div <?php echo $resolution_view_search->MeetingRef->cellAttributes() ?>>
			<span id="el_resolution_view_MeetingRef" class="ew-search-field">
<input type="text" data-table="resolution_view" data-field="x_MeetingRef" name="x_MeetingRef" id="x_MeetingRef" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($resolution_view_search->MeetingRef->getPlaceHolder()) ?>" value="<?php echo $resolution_view_search->MeetingRef->EditValue ?>"<?php echo $resolution_view_search->MeetingRef->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($resolution_view_search->MeetingType->Visible) { // MeetingType ?>
	<div id="r_MeetingType" class="form-group row">
		<label for="x_MeetingType" class="<?php echo $resolution_view_search->LeftColumnClass ?>"><span id="elh_resolution_view_MeetingType"><?php echo $resolution_view_search->MeetingType->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_MeetingType" id="z_MeetingType" value="=">
</span>
		</label>
		<div class="<?php echo $resolution_view_search->RightColumnClass ?>"><div <?php echo $resolution_view_search->MeetingType->cellAttributes() ?>>
			<span id="el_resolution_view_MeetingType" class="ew-search-field">
<input type="text" data-table="resolution_view" data-field="x_MeetingType" name="x_MeetingType" id="x_MeetingType" size="30" placeholder="<?php echo HtmlEncode($resolution_view_search->MeetingType->getPlaceHolder()) ?>" value="<?php echo $resolution_view_search->MeetingType->EditValue ?>"<?php echo $resolution_view_search->MeetingType->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($resolution_view_search->ActualDate->Visible) { // ActualDate ?>
	<div id="r_ActualDate" class="form-group row">
		<label for="x_ActualDate" class="<?php echo $resolution_view_search->LeftColumnClass ?>"><span id="elh_resolution_view_ActualDate"><?php echo $resolution_view_search->ActualDate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ActualDate" id="z_ActualDate" value="=">
</span>
		</label>
		<div class="<?php echo $resolution_view_search->RightColumnClass ?>"><div <?php echo $resolution_view_search->ActualDate->cellAttributes() ?>>
			<span id="el_resolution_view_ActualDate" class="ew-search-field">
<input type="text" data-table="resolution_view" data-field="x_ActualDate" name="x_ActualDate" id="x_ActualDate" placeholder="<?php echo HtmlEncode($resolution_view_search->ActualDate->getPlaceHolder()) ?>" value="<?php echo $resolution_view_search->ActualDate->EditValue ?>"<?php echo $resolution_view_search->ActualDate->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($resolution_view_search->MeetingTypeName->Visible) { // MeetingTypeName ?>
	<div id="r_MeetingTypeName" class="form-group row">
		<label for="x_MeetingTypeName" class="<?php echo $resolution_view_search->LeftColumnClass ?>"><span id="elh_resolution_view_MeetingTypeName"><?php echo $resolution_view_search->MeetingTypeName->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_MeetingTypeName" id="z_MeetingTypeName" value="LIKE">
</span>
		</label>
		<div class="<?php echo $resolution_view_search->RightColumnClass ?>"><div <?php echo $resolution_view_search->MeetingTypeName->cellAttributes() ?>>
			<span id="el_resolution_view_MeetingTypeName" class="ew-search-field">
<input type="text" data-table="resolution_view" data-field="x_MeetingTypeName" name="x_MeetingTypeName" id="x_MeetingTypeName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($resolution_view_search->MeetingTypeName->getPlaceHolder()) ?>" value="<?php echo $resolution_view_search->MeetingTypeName->EditValue ?>"<?php echo $resolution_view_search->MeetingTypeName->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($resolution_view_search->ResolutionNo->Visible) { // ResolutionNo ?>
	<div id="r_ResolutionNo" class="form-group row">
		<label for="x_ResolutionNo" class="<?php echo $resolution_view_search->LeftColumnClass ?>"><span id="elh_resolution_view_ResolutionNo"><?php echo $resolution_view_search->ResolutionNo->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ResolutionNo" id="z_ResolutionNo" value="=">
</span>
		</label>
		<div class="<?php echo $resolution_view_search->RightColumnClass ?>"><div <?php echo $resolution_view_search->ResolutionNo->cellAttributes() ?>>
			<span id="el_resolution_view_ResolutionNo" class="ew-search-field">
<input type="text" data-table="resolution_view" data-field="x_ResolutionNo" name="x_ResolutionNo" id="x_ResolutionNo" placeholder="<?php echo HtmlEncode($resolution_view_search->ResolutionNo->getPlaceHolder()) ?>" value="<?php echo $resolution_view_search->ResolutionNo->EditValue ?>"<?php echo $resolution_view_search->ResolutionNo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($resolution_view_search->Resolution->Visible) { // Resolution ?>
	<div id="r_Resolution" class="form-group row">
		<label for="x_Resolution" class="<?php echo $resolution_view_search->LeftColumnClass ?>"><span id="elh_resolution_view_Resolution"><?php echo $resolution_view_search->Resolution->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Resolution" id="z_Resolution" value="LIKE">
</span>
		</label>
		<div class="<?php echo $resolution_view_search->RightColumnClass ?>"><div <?php echo $resolution_view_search->Resolution->cellAttributes() ?>>
			<span id="el_resolution_view_Resolution" class="ew-search-field">
<input type="text" data-table="resolution_view" data-field="x_Resolution" name="x_Resolution" id="x_Resolution" size="35" placeholder="<?php echo HtmlEncode($resolution_view_search->Resolution->getPlaceHolder()) ?>" value="<?php echo $resolution_view_search->Resolution->EditValue ?>"<?php echo $resolution_view_search->Resolution->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($resolution_view_search->Responsibility->Visible) { // Responsibility ?>
	<div id="r_Responsibility" class="form-group row">
		<label for="x_Responsibility" class="<?php echo $resolution_view_search->LeftColumnClass ?>"><span id="elh_resolution_view_Responsibility"><?php echo $resolution_view_search->Responsibility->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Responsibility" id="z_Responsibility" value="LIKE">
</span>
		</label>
		<div class="<?php echo $resolution_view_search->RightColumnClass ?>"><div <?php echo $resolution_view_search->Responsibility->cellAttributes() ?>>
			<span id="el_resolution_view_Responsibility" class="ew-search-field">
<input type="text" data-table="resolution_view" data-field="x_Responsibility" name="x_Responsibility" id="x_Responsibility" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($resolution_view_search->Responsibility->getPlaceHolder()) ?>" value="<?php echo $resolution_view_search->Responsibility->EditValue ?>"<?php echo $resolution_view_search->Responsibility->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($resolution_view_search->ActionDate->Visible) { // ActionDate ?>
	<div id="r_ActionDate" class="form-group row">
		<label for="x_ActionDate" class="<?php echo $resolution_view_search->LeftColumnClass ?>"><span id="elh_resolution_view_ActionDate"><?php echo $resolution_view_search->ActionDate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ActionDate" id="z_ActionDate" value="=">
</span>
		</label>
		<div class="<?php echo $resolution_view_search->RightColumnClass ?>"><div <?php echo $resolution_view_search->ActionDate->cellAttributes() ?>>
			<span id="el_resolution_view_ActionDate" class="ew-search-field">
<input type="text" data-table="resolution_view" data-field="x_ActionDate" name="x_ActionDate" id="x_ActionDate" placeholder="<?php echo HtmlEncode($resolution_view_search->ActionDate->getPlaceHolder()) ?>" value="<?php echo $resolution_view_search->ActionDate->EditValue ?>"<?php echo $resolution_view_search->ActionDate->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($resolution_view_search->ResolutionCategoryName->Visible) { // ResolutionCategoryName ?>
	<div id="r_ResolutionCategoryName" class="form-group row">
		<label for="x_ResolutionCategoryName" class="<?php echo $resolution_view_search->LeftColumnClass ?>"><span id="elh_resolution_view_ResolutionCategoryName"><?php echo $resolution_view_search->ResolutionCategoryName->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ResolutionCategoryName" id="z_ResolutionCategoryName" value="LIKE">
</span>
		</label>
		<div class="<?php echo $resolution_view_search->RightColumnClass ?>"><div <?php echo $resolution_view_search->ResolutionCategoryName->cellAttributes() ?>>
			<span id="el_resolution_view_ResolutionCategoryName" class="ew-search-field">
<input type="text" data-table="resolution_view" data-field="x_ResolutionCategoryName" name="x_ResolutionCategoryName" id="x_ResolutionCategoryName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($resolution_view_search->ResolutionCategoryName->getPlaceHolder()) ?>" value="<?php echo $resolution_view_search->ResolutionCategoryName->EditValue ?>"<?php echo $resolution_view_search->ResolutionCategoryName->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($resolution_view_search->MinuteNumber->Visible) { // MinuteNumber ?>
	<div id="r_MinuteNumber" class="form-group row">
		<label for="x_MinuteNumber" class="<?php echo $resolution_view_search->LeftColumnClass ?>"><span id="elh_resolution_view_MinuteNumber"><?php echo $resolution_view_search->MinuteNumber->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_MinuteNumber" id="z_MinuteNumber" value="LIKE">
</span>
		</label>
		<div class="<?php echo $resolution_view_search->RightColumnClass ?>"><div <?php echo $resolution_view_search->MinuteNumber->cellAttributes() ?>>
			<span id="el_resolution_view_MinuteNumber" class="ew-search-field">
<input type="text" data-table="resolution_view" data-field="x_MinuteNumber" name="x_MinuteNumber" id="x_MinuteNumber" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($resolution_view_search->MinuteNumber->getPlaceHolder()) ?>" value="<?php echo $resolution_view_search->MinuteNumber->EditValue ?>"<?php echo $resolution_view_search->MinuteNumber->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($resolution_view_search->Subject->Visible) { // Subject ?>
	<div id="r_Subject" class="form-group row">
		<label for="x_Subject" class="<?php echo $resolution_view_search->LeftColumnClass ?>"><span id="elh_resolution_view_Subject"><?php echo $resolution_view_search->Subject->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Subject" id="z_Subject" value="LIKE">
</span>
		</label>
		<div class="<?php echo $resolution_view_search->RightColumnClass ?>"><div <?php echo $resolution_view_search->Subject->cellAttributes() ?>>
			<span id="el_resolution_view_Subject" class="ew-search-field">
<input type="text" data-table="resolution_view" data-field="x_Subject" name="x_Subject" id="x_Subject" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($resolution_view_search->Subject->getPlaceHolder()) ?>" value="<?php echo $resolution_view_search->Subject->EditValue ?>"<?php echo $resolution_view_search->Subject->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$resolution_view_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $resolution_view_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$resolution_view_search->showPageFooter();
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
$resolution_view_search->terminate();
?>