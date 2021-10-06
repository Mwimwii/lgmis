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
$staffprofbodies_search = new staffprofbodies_search();

// Run the page
$staffprofbodies_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$staffprofbodies_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fstaffprofbodiessearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($staffprofbodies_search->IsModal) { ?>
	fstaffprofbodiessearch = currentAdvancedSearchForm = new ew.Form("fstaffprofbodiessearch", "search");
	<?php } else { ?>
	fstaffprofbodiessearch = currentForm = new ew.Form("fstaffprofbodiessearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fstaffprofbodiessearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_EmployeeID");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($staffprofbodies_search->EmployeeID->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_DateJoined");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($staffprofbodies_search->DateJoined->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_DateRenewed");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($staffprofbodies_search->DateRenewed->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ValidTo");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($staffprofbodies_search->ValidTo->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fstaffprofbodiessearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fstaffprofbodiessearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fstaffprofbodiessearch.lists["x_ProfessionalBody"] = <?php echo $staffprofbodies_search->ProfessionalBody->Lookup->toClientList($staffprofbodies_search) ?>;
	fstaffprofbodiessearch.lists["x_ProfessionalBody"].options = <?php echo JsonEncode($staffprofbodies_search->ProfessionalBody->lookupOptions()) ?>;
	fstaffprofbodiessearch.lists["x_MemberStatus"] = <?php echo $staffprofbodies_search->MemberStatus->Lookup->toClientList($staffprofbodies_search) ?>;
	fstaffprofbodiessearch.lists["x_MemberStatus"].options = <?php echo JsonEncode($staffprofbodies_search->MemberStatus->lookupOptions()) ?>;
	loadjs.done("fstaffprofbodiessearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $staffprofbodies_search->showPageHeader(); ?>
<?php
$staffprofbodies_search->showMessage();
?>
<form name="fstaffprofbodiessearch" id="fstaffprofbodiessearch" class="<?php echo $staffprofbodies_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="staffprofbodies">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$staffprofbodies_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($staffprofbodies_search->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label for="x_EmployeeID" class="<?php echo $staffprofbodies_search->LeftColumnClass ?>"><span id="elh_staffprofbodies_EmployeeID"><?php echo $staffprofbodies_search->EmployeeID->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_EmployeeID" id="z_EmployeeID" value="=">
</span>
		</label>
		<div class="<?php echo $staffprofbodies_search->RightColumnClass ?>"><div <?php echo $staffprofbodies_search->EmployeeID->cellAttributes() ?>>
			<span id="el_staffprofbodies_EmployeeID" class="ew-search-field">
<input type="text" data-table="staffprofbodies" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($staffprofbodies_search->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $staffprofbodies_search->EmployeeID->EditValue ?>"<?php echo $staffprofbodies_search->EmployeeID->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staffprofbodies_search->ProfessionalBody->Visible) { // ProfessionalBody ?>
	<div id="r_ProfessionalBody" class="form-group row">
		<label for="x_ProfessionalBody" class="<?php echo $staffprofbodies_search->LeftColumnClass ?>"><span id="elh_staffprofbodies_ProfessionalBody"><?php echo $staffprofbodies_search->ProfessionalBody->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ProfessionalBody" id="z_ProfessionalBody" value="LIKE">
</span>
		</label>
		<div class="<?php echo $staffprofbodies_search->RightColumnClass ?>"><div <?php echo $staffprofbodies_search->ProfessionalBody->cellAttributes() ?>>
			<span id="el_staffprofbodies_ProfessionalBody" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_ProfessionalBody"><?php echo EmptyValue(strval($staffprofbodies_search->ProfessionalBody->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $staffprofbodies_search->ProfessionalBody->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staffprofbodies_search->ProfessionalBody->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staffprofbodies_search->ProfessionalBody->ReadOnly || $staffprofbodies_search->ProfessionalBody->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_ProfessionalBody',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staffprofbodies_search->ProfessionalBody->Lookup->getParamTag($staffprofbodies_search, "p_x_ProfessionalBody") ?>
<input type="hidden" data-table="staffprofbodies" data-field="x_ProfessionalBody" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staffprofbodies_search->ProfessionalBody->displayValueSeparatorAttribute() ?>" name="x_ProfessionalBody" id="x_ProfessionalBody" value="<?php echo $staffprofbodies_search->ProfessionalBody->AdvancedSearch->SearchValue ?>"<?php echo $staffprofbodies_search->ProfessionalBody->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staffprofbodies_search->MembershipNo->Visible) { // MembershipNo ?>
	<div id="r_MembershipNo" class="form-group row">
		<label for="x_MembershipNo" class="<?php echo $staffprofbodies_search->LeftColumnClass ?>"><span id="elh_staffprofbodies_MembershipNo"><?php echo $staffprofbodies_search->MembershipNo->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_MembershipNo" id="z_MembershipNo" value="LIKE">
</span>
		</label>
		<div class="<?php echo $staffprofbodies_search->RightColumnClass ?>"><div <?php echo $staffprofbodies_search->MembershipNo->cellAttributes() ?>>
			<span id="el_staffprofbodies_MembershipNo" class="ew-search-field">
<input type="text" data-table="staffprofbodies" data-field="x_MembershipNo" name="x_MembershipNo" id="x_MembershipNo" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($staffprofbodies_search->MembershipNo->getPlaceHolder()) ?>" value="<?php echo $staffprofbodies_search->MembershipNo->EditValue ?>"<?php echo $staffprofbodies_search->MembershipNo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staffprofbodies_search->DateJoined->Visible) { // DateJoined ?>
	<div id="r_DateJoined" class="form-group row">
		<label for="x_DateJoined" class="<?php echo $staffprofbodies_search->LeftColumnClass ?>"><span id="elh_staffprofbodies_DateJoined"><?php echo $staffprofbodies_search->DateJoined->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_DateJoined" id="z_DateJoined" value="=">
</span>
		</label>
		<div class="<?php echo $staffprofbodies_search->RightColumnClass ?>"><div <?php echo $staffprofbodies_search->DateJoined->cellAttributes() ?>>
			<span id="el_staffprofbodies_DateJoined" class="ew-search-field">
<input type="text" data-table="staffprofbodies" data-field="x_DateJoined" name="x_DateJoined" id="x_DateJoined" placeholder="<?php echo HtmlEncode($staffprofbodies_search->DateJoined->getPlaceHolder()) ?>" value="<?php echo $staffprofbodies_search->DateJoined->EditValue ?>"<?php echo $staffprofbodies_search->DateJoined->editAttributes() ?>>
<?php if (!$staffprofbodies_search->DateJoined->ReadOnly && !$staffprofbodies_search->DateJoined->Disabled && !isset($staffprofbodies_search->DateJoined->EditAttrs["readonly"]) && !isset($staffprofbodies_search->DateJoined->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffprofbodiessearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffprofbodiessearch", "x_DateJoined", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staffprofbodies_search->DateRenewed->Visible) { // DateRenewed ?>
	<div id="r_DateRenewed" class="form-group row">
		<label for="x_DateRenewed" class="<?php echo $staffprofbodies_search->LeftColumnClass ?>"><span id="elh_staffprofbodies_DateRenewed"><?php echo $staffprofbodies_search->DateRenewed->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_DateRenewed" id="z_DateRenewed" value="=">
</span>
		</label>
		<div class="<?php echo $staffprofbodies_search->RightColumnClass ?>"><div <?php echo $staffprofbodies_search->DateRenewed->cellAttributes() ?>>
			<span id="el_staffprofbodies_DateRenewed" class="ew-search-field">
<input type="text" data-table="staffprofbodies" data-field="x_DateRenewed" name="x_DateRenewed" id="x_DateRenewed" placeholder="<?php echo HtmlEncode($staffprofbodies_search->DateRenewed->getPlaceHolder()) ?>" value="<?php echo $staffprofbodies_search->DateRenewed->EditValue ?>"<?php echo $staffprofbodies_search->DateRenewed->editAttributes() ?>>
<?php if (!$staffprofbodies_search->DateRenewed->ReadOnly && !$staffprofbodies_search->DateRenewed->Disabled && !isset($staffprofbodies_search->DateRenewed->EditAttrs["readonly"]) && !isset($staffprofbodies_search->DateRenewed->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffprofbodiessearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffprofbodiessearch", "x_DateRenewed", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staffprofbodies_search->ValidTo->Visible) { // ValidTo ?>
	<div id="r_ValidTo" class="form-group row">
		<label for="x_ValidTo" class="<?php echo $staffprofbodies_search->LeftColumnClass ?>"><span id="elh_staffprofbodies_ValidTo"><?php echo $staffprofbodies_search->ValidTo->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ValidTo" id="z_ValidTo" value="=">
</span>
		</label>
		<div class="<?php echo $staffprofbodies_search->RightColumnClass ?>"><div <?php echo $staffprofbodies_search->ValidTo->cellAttributes() ?>>
			<span id="el_staffprofbodies_ValidTo" class="ew-search-field">
<input type="text" data-table="staffprofbodies" data-field="x_ValidTo" name="x_ValidTo" id="x_ValidTo" placeholder="<?php echo HtmlEncode($staffprofbodies_search->ValidTo->getPlaceHolder()) ?>" value="<?php echo $staffprofbodies_search->ValidTo->EditValue ?>"<?php echo $staffprofbodies_search->ValidTo->editAttributes() ?>>
<?php if (!$staffprofbodies_search->ValidTo->ReadOnly && !$staffprofbodies_search->ValidTo->Disabled && !isset($staffprofbodies_search->ValidTo->EditAttrs["readonly"]) && !isset($staffprofbodies_search->ValidTo->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffprofbodiessearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffprofbodiessearch", "x_ValidTo", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($staffprofbodies_search->MemberStatus->Visible) { // MemberStatus ?>
	<div id="r_MemberStatus" class="form-group row">
		<label for="x_MemberStatus" class="<?php echo $staffprofbodies_search->LeftColumnClass ?>"><span id="elh_staffprofbodies_MemberStatus"><?php echo $staffprofbodies_search->MemberStatus->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_MemberStatus" id="z_MemberStatus" value="=">
</span>
		</label>
		<div class="<?php echo $staffprofbodies_search->RightColumnClass ?>"><div <?php echo $staffprofbodies_search->MemberStatus->cellAttributes() ?>>
			<span id="el_staffprofbodies_MemberStatus" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffprofbodies" data-field="x_MemberStatus" data-value-separator="<?php echo $staffprofbodies_search->MemberStatus->displayValueSeparatorAttribute() ?>" id="x_MemberStatus" name="x_MemberStatus"<?php echo $staffprofbodies_search->MemberStatus->editAttributes() ?>>
			<?php echo $staffprofbodies_search->MemberStatus->selectOptionListHtml("x_MemberStatus") ?>
		</select>
</div>
<?php echo $staffprofbodies_search->MemberStatus->Lookup->getParamTag($staffprofbodies_search, "p_x_MemberStatus") ?>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$staffprofbodies_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $staffprofbodies_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$staffprofbodies_search->showPageFooter();
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
$staffprofbodies_search->terminate();
?>