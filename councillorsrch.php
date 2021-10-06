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
$councillor_search = new councillor_search();

// Run the page
$councillor_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$councillor_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcouncillorsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($councillor_search->IsModal) { ?>
	fcouncillorsearch = currentAdvancedSearchForm = new ew.Form("fcouncillorsearch", "search");
	<?php } else { ?>
	fcouncillorsearch = currentForm = new ew.Form("fcouncillorsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fcouncillorsearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_EmployeeID");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($councillor_search->EmployeeID->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_DateOfBirth");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($councillor_search->DateOfBirth->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fcouncillorsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcouncillorsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fcouncillorsearch.lists["x_LACode"] = <?php echo $councillor_search->LACode->Lookup->toClientList($councillor_search) ?>;
	fcouncillorsearch.lists["x_LACode"].options = <?php echo JsonEncode($councillor_search->LACode->lookupOptions()) ?>;
	fcouncillorsearch.autoSuggests["x_LACode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fcouncillorsearch.lists["x_Sex"] = <?php echo $councillor_search->Sex->Lookup->toClientList($councillor_search) ?>;
	fcouncillorsearch.lists["x_Sex"].options = <?php echo JsonEncode($councillor_search->Sex->lookupOptions()) ?>;
	fcouncillorsearch.lists["x_Title"] = <?php echo $councillor_search->Title->Lookup->toClientList($councillor_search) ?>;
	fcouncillorsearch.lists["x_Title"].options = <?php echo JsonEncode($councillor_search->Title->lookupOptions()) ?>;
	fcouncillorsearch.lists["x_MaritalStatus"] = <?php echo $councillor_search->MaritalStatus->Lookup->toClientList($councillor_search) ?>;
	fcouncillorsearch.lists["x_MaritalStatus"].options = <?php echo JsonEncode($councillor_search->MaritalStatus->lookupOptions()) ?>;
	fcouncillorsearch.lists["x_AcademicQualification"] = <?php echo $councillor_search->AcademicQualification->Lookup->toClientList($councillor_search) ?>;
	fcouncillorsearch.lists["x_AcademicQualification"].options = <?php echo JsonEncode($councillor_search->AcademicQualification->lookupOptions()) ?>;
	fcouncillorsearch.lists["x_ProfessionalQualification"] = <?php echo $councillor_search->ProfessionalQualification->Lookup->toClientList($councillor_search) ?>;
	fcouncillorsearch.lists["x_ProfessionalQualification"].options = <?php echo JsonEncode($councillor_search->ProfessionalQualification->lookupOptions()) ?>;
	loadjs.done("fcouncillorsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $councillor_search->showPageHeader(); ?>
<?php
$councillor_search->showMessage();
?>
<form name="fcouncillorsearch" id="fcouncillorsearch" class="<?php echo $councillor_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="councillor">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$councillor_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($councillor_search->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label for="x_EmployeeID" class="<?php echo $councillor_search->LeftColumnClass ?>"><span id="elh_councillor_EmployeeID"><?php echo $councillor_search->EmployeeID->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_EmployeeID" id="z_EmployeeID" value="=">
</span>
		</label>
		<div class="<?php echo $councillor_search->RightColumnClass ?>"><div <?php echo $councillor_search->EmployeeID->cellAttributes() ?>>
			<span id="el_councillor_EmployeeID" class="ew-search-field">
<input type="text" data-table="councillor" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" placeholder="<?php echo HtmlEncode($councillor_search->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $councillor_search->EmployeeID->EditValue ?>"<?php echo $councillor_search->EmployeeID->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($councillor_search->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label class="<?php echo $councillor_search->LeftColumnClass ?>"><span id="elh_councillor_LACode"><?php echo $councillor_search->LACode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_LACode" id="z_LACode" value="LIKE">
</span>
		</label>
		<div class="<?php echo $councillor_search->RightColumnClass ?>"><div <?php echo $councillor_search->LACode->cellAttributes() ?>>
			<span id="el_councillor_LACode" class="ew-search-field">
<?php
$onchange = $councillor_search->LACode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$councillor_search->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x_LACode">
	<input type="text" class="form-control" name="sv_x_LACode" id="sv_x_LACode" value="<?php echo RemoveHtml($councillor_search->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($councillor_search->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($councillor_search->LACode->getPlaceHolder()) ?>"<?php echo $councillor_search->LACode->editAttributes() ?>>
</span>
<input type="hidden" data-table="councillor" data-field="x_LACode" data-value-separator="<?php echo $councillor_search->LACode->displayValueSeparatorAttribute() ?>" name="x_LACode" id="x_LACode" value="<?php echo HtmlEncode($councillor_search->LACode->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fcouncillorsearch"], function() {
	fcouncillorsearch.createAutoSuggest({"id":"x_LACode","forceSelect":false});
});
</script>
<?php echo $councillor_search->LACode->Lookup->getParamTag($councillor_search, "p_x_LACode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($councillor_search->NRC->Visible) { // NRC ?>
	<div id="r_NRC" class="form-group row">
		<label for="x_NRC" class="<?php echo $councillor_search->LeftColumnClass ?>"><span id="elh_councillor_NRC"><?php echo $councillor_search->NRC->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_NRC" id="z_NRC" value="LIKE">
</span>
		</label>
		<div class="<?php echo $councillor_search->RightColumnClass ?>"><div <?php echo $councillor_search->NRC->cellAttributes() ?>>
			<span id="el_councillor_NRC" class="ew-search-field">
<input type="text" data-table="councillor" data-field="x_NRC" name="x_NRC" id="x_NRC" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($councillor_search->NRC->getPlaceHolder()) ?>" value="<?php echo $councillor_search->NRC->EditValue ?>"<?php echo $councillor_search->NRC->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($councillor_search->Sex->Visible) { // Sex ?>
	<div id="r_Sex" class="form-group row">
		<label for="x_Sex" class="<?php echo $councillor_search->LeftColumnClass ?>"><span id="elh_councillor_Sex"><?php echo $councillor_search->Sex->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Sex" id="z_Sex" value="LIKE">
</span>
		</label>
		<div class="<?php echo $councillor_search->RightColumnClass ?>"><div <?php echo $councillor_search->Sex->cellAttributes() ?>>
			<span id="el_councillor_Sex" class="ew-search-field">
<?php $councillor_search->Sex->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillor" data-field="x_Sex" data-value-separator="<?php echo $councillor_search->Sex->displayValueSeparatorAttribute() ?>" id="x_Sex" name="x_Sex"<?php echo $councillor_search->Sex->editAttributes() ?>>
			<?php echo $councillor_search->Sex->selectOptionListHtml("x_Sex") ?>
		</select>
</div>
<?php echo $councillor_search->Sex->Lookup->getParamTag($councillor_search, "p_x_Sex") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($councillor_search->Title->Visible) { // Title ?>
	<div id="r_Title" class="form-group row">
		<label for="x_Title" class="<?php echo $councillor_search->LeftColumnClass ?>"><span id="elh_councillor_Title"><?php echo $councillor_search->Title->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Title" id="z_Title" value="LIKE">
</span>
		</label>
		<div class="<?php echo $councillor_search->RightColumnClass ?>"><div <?php echo $councillor_search->Title->cellAttributes() ?>>
			<span id="el_councillor_Title" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillor" data-field="x_Title" data-value-separator="<?php echo $councillor_search->Title->displayValueSeparatorAttribute() ?>" id="x_Title" name="x_Title"<?php echo $councillor_search->Title->editAttributes() ?>>
			<?php echo $councillor_search->Title->selectOptionListHtml("x_Title") ?>
		</select>
</div>
<?php echo $councillor_search->Title->Lookup->getParamTag($councillor_search, "p_x_Title") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($councillor_search->Surname->Visible) { // Surname ?>
	<div id="r_Surname" class="form-group row">
		<label for="x_Surname" class="<?php echo $councillor_search->LeftColumnClass ?>"><span id="elh_councillor_Surname"><?php echo $councillor_search->Surname->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Surname" id="z_Surname" value="LIKE">
</span>
		</label>
		<div class="<?php echo $councillor_search->RightColumnClass ?>"><div <?php echo $councillor_search->Surname->cellAttributes() ?>>
			<span id="el_councillor_Surname" class="ew-search-field">
<input type="text" data-table="councillor" data-field="x_Surname" name="x_Surname" id="x_Surname" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($councillor_search->Surname->getPlaceHolder()) ?>" value="<?php echo $councillor_search->Surname->EditValue ?>"<?php echo $councillor_search->Surname->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($councillor_search->FirstName->Visible) { // FirstName ?>
	<div id="r_FirstName" class="form-group row">
		<label for="x_FirstName" class="<?php echo $councillor_search->LeftColumnClass ?>"><span id="elh_councillor_FirstName"><?php echo $councillor_search->FirstName->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_FirstName" id="z_FirstName" value="LIKE">
</span>
		</label>
		<div class="<?php echo $councillor_search->RightColumnClass ?>"><div <?php echo $councillor_search->FirstName->cellAttributes() ?>>
			<span id="el_councillor_FirstName" class="ew-search-field">
<input type="text" data-table="councillor" data-field="x_FirstName" name="x_FirstName" id="x_FirstName" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($councillor_search->FirstName->getPlaceHolder()) ?>" value="<?php echo $councillor_search->FirstName->EditValue ?>"<?php echo $councillor_search->FirstName->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($councillor_search->MiddleName->Visible) { // MiddleName ?>
	<div id="r_MiddleName" class="form-group row">
		<label for="x_MiddleName" class="<?php echo $councillor_search->LeftColumnClass ?>"><span id="elh_councillor_MiddleName"><?php echo $councillor_search->MiddleName->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_MiddleName" id="z_MiddleName" value="LIKE">
</span>
		</label>
		<div class="<?php echo $councillor_search->RightColumnClass ?>"><div <?php echo $councillor_search->MiddleName->cellAttributes() ?>>
			<span id="el_councillor_MiddleName" class="ew-search-field">
<input type="text" data-table="councillor" data-field="x_MiddleName" name="x_MiddleName" id="x_MiddleName" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($councillor_search->MiddleName->getPlaceHolder()) ?>" value="<?php echo $councillor_search->MiddleName->EditValue ?>"<?php echo $councillor_search->MiddleName->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($councillor_search->MaritalStatus->Visible) { // MaritalStatus ?>
	<div id="r_MaritalStatus" class="form-group row">
		<label for="x_MaritalStatus" class="<?php echo $councillor_search->LeftColumnClass ?>"><span id="elh_councillor_MaritalStatus"><?php echo $councillor_search->MaritalStatus->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_MaritalStatus" id="z_MaritalStatus" value="=">
</span>
		</label>
		<div class="<?php echo $councillor_search->RightColumnClass ?>"><div <?php echo $councillor_search->MaritalStatus->cellAttributes() ?>>
			<span id="el_councillor_MaritalStatus" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillor" data-field="x_MaritalStatus" data-value-separator="<?php echo $councillor_search->MaritalStatus->displayValueSeparatorAttribute() ?>" id="x_MaritalStatus" name="x_MaritalStatus"<?php echo $councillor_search->MaritalStatus->editAttributes() ?>>
			<?php echo $councillor_search->MaritalStatus->selectOptionListHtml("x_MaritalStatus") ?>
		</select>
</div>
<?php echo $councillor_search->MaritalStatus->Lookup->getParamTag($councillor_search, "p_x_MaritalStatus") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($councillor_search->DateOfBirth->Visible) { // DateOfBirth ?>
	<div id="r_DateOfBirth" class="form-group row">
		<label for="x_DateOfBirth" class="<?php echo $councillor_search->LeftColumnClass ?>"><span id="elh_councillor_DateOfBirth"><?php echo $councillor_search->DateOfBirth->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_DateOfBirth" id="z_DateOfBirth" value="=">
</span>
		</label>
		<div class="<?php echo $councillor_search->RightColumnClass ?>"><div <?php echo $councillor_search->DateOfBirth->cellAttributes() ?>>
			<span id="el_councillor_DateOfBirth" class="ew-search-field">
<input type="text" data-table="councillor" data-field="x_DateOfBirth" name="x_DateOfBirth" id="x_DateOfBirth" placeholder="<?php echo HtmlEncode($councillor_search->DateOfBirth->getPlaceHolder()) ?>" value="<?php echo $councillor_search->DateOfBirth->EditValue ?>"<?php echo $councillor_search->DateOfBirth->editAttributes() ?>>
<?php if (!$councillor_search->DateOfBirth->ReadOnly && !$councillor_search->DateOfBirth->Disabled && !isset($councillor_search->DateOfBirth->EditAttrs["readonly"]) && !isset($councillor_search->DateOfBirth->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcouncillorsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fcouncillorsearch", "x_DateOfBirth", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($councillor_search->AcademicQualification->Visible) { // AcademicQualification ?>
	<div id="r_AcademicQualification" class="form-group row">
		<label for="x_AcademicQualification" class="<?php echo $councillor_search->LeftColumnClass ?>"><span id="elh_councillor_AcademicQualification"><?php echo $councillor_search->AcademicQualification->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_AcademicQualification" id="z_AcademicQualification" value="LIKE">
</span>
		</label>
		<div class="<?php echo $councillor_search->RightColumnClass ?>"><div <?php echo $councillor_search->AcademicQualification->cellAttributes() ?>>
			<span id="el_councillor_AcademicQualification" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillor" data-field="x_AcademicQualification" data-value-separator="<?php echo $councillor_search->AcademicQualification->displayValueSeparatorAttribute() ?>" id="x_AcademicQualification" name="x_AcademicQualification"<?php echo $councillor_search->AcademicQualification->editAttributes() ?>>
			<?php echo $councillor_search->AcademicQualification->selectOptionListHtml("x_AcademicQualification") ?>
		</select>
</div>
<?php echo $councillor_search->AcademicQualification->Lookup->getParamTag($councillor_search, "p_x_AcademicQualification") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($councillor_search->ProfessionalQualification->Visible) { // ProfessionalQualification ?>
	<div id="r_ProfessionalQualification" class="form-group row">
		<label for="x_ProfessionalQualification" class="<?php echo $councillor_search->LeftColumnClass ?>"><span id="elh_councillor_ProfessionalQualification"><?php echo $councillor_search->ProfessionalQualification->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ProfessionalQualification" id="z_ProfessionalQualification" value="LIKE">
</span>
		</label>
		<div class="<?php echo $councillor_search->RightColumnClass ?>"><div <?php echo $councillor_search->ProfessionalQualification->cellAttributes() ?>>
			<span id="el_councillor_ProfessionalQualification" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillor" data-field="x_ProfessionalQualification" data-value-separator="<?php echo $councillor_search->ProfessionalQualification->displayValueSeparatorAttribute() ?>" id="x_ProfessionalQualification" name="x_ProfessionalQualification"<?php echo $councillor_search->ProfessionalQualification->editAttributes() ?>>
			<?php echo $councillor_search->ProfessionalQualification->selectOptionListHtml("x_ProfessionalQualification") ?>
		</select>
</div>
<?php echo $councillor_search->ProfessionalQualification->Lookup->getParamTag($councillor_search, "p_x_ProfessionalQualification") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($councillor_search->PostalAddress->Visible) { // PostalAddress ?>
	<div id="r_PostalAddress" class="form-group row">
		<label for="x_PostalAddress" class="<?php echo $councillor_search->LeftColumnClass ?>"><span id="elh_councillor_PostalAddress"><?php echo $councillor_search->PostalAddress->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PostalAddress" id="z_PostalAddress" value="LIKE">
</span>
		</label>
		<div class="<?php echo $councillor_search->RightColumnClass ?>"><div <?php echo $councillor_search->PostalAddress->cellAttributes() ?>>
			<span id="el_councillor_PostalAddress" class="ew-search-field">
<input type="text" data-table="councillor" data-field="x_PostalAddress" name="x_PostalAddress" id="x_PostalAddress" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($councillor_search->PostalAddress->getPlaceHolder()) ?>" value="<?php echo $councillor_search->PostalAddress->EditValue ?>"<?php echo $councillor_search->PostalAddress->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($councillor_search->PhysicalAddress->Visible) { // PhysicalAddress ?>
	<div id="r_PhysicalAddress" class="form-group row">
		<label for="x_PhysicalAddress" class="<?php echo $councillor_search->LeftColumnClass ?>"><span id="elh_councillor_PhysicalAddress"><?php echo $councillor_search->PhysicalAddress->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PhysicalAddress" id="z_PhysicalAddress" value="LIKE">
</span>
		</label>
		<div class="<?php echo $councillor_search->RightColumnClass ?>"><div <?php echo $councillor_search->PhysicalAddress->cellAttributes() ?>>
			<span id="el_councillor_PhysicalAddress" class="ew-search-field">
<input type="text" data-table="councillor" data-field="x_PhysicalAddress" name="x_PhysicalAddress" id="x_PhysicalAddress" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($councillor_search->PhysicalAddress->getPlaceHolder()) ?>" value="<?php echo $councillor_search->PhysicalAddress->EditValue ?>"<?php echo $councillor_search->PhysicalAddress->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($councillor_search->TownOrVillage->Visible) { // TownOrVillage ?>
	<div id="r_TownOrVillage" class="form-group row">
		<label for="x_TownOrVillage" class="<?php echo $councillor_search->LeftColumnClass ?>"><span id="elh_councillor_TownOrVillage"><?php echo $councillor_search->TownOrVillage->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_TownOrVillage" id="z_TownOrVillage" value="LIKE">
</span>
		</label>
		<div class="<?php echo $councillor_search->RightColumnClass ?>"><div <?php echo $councillor_search->TownOrVillage->cellAttributes() ?>>
			<span id="el_councillor_TownOrVillage" class="ew-search-field">
<input type="text" data-table="councillor" data-field="x_TownOrVillage" name="x_TownOrVillage" id="x_TownOrVillage" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($councillor_search->TownOrVillage->getPlaceHolder()) ?>" value="<?php echo $councillor_search->TownOrVillage->EditValue ?>"<?php echo $councillor_search->TownOrVillage->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($councillor_search->Telephone->Visible) { // Telephone ?>
	<div id="r_Telephone" class="form-group row">
		<label for="x_Telephone" class="<?php echo $councillor_search->LeftColumnClass ?>"><span id="elh_councillor_Telephone"><?php echo $councillor_search->Telephone->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Telephone" id="z_Telephone" value="LIKE">
</span>
		</label>
		<div class="<?php echo $councillor_search->RightColumnClass ?>"><div <?php echo $councillor_search->Telephone->cellAttributes() ?>>
			<span id="el_councillor_Telephone" class="ew-search-field">
<input type="text" data-table="councillor" data-field="x_Telephone" name="x_Telephone" id="x_Telephone" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($councillor_search->Telephone->getPlaceHolder()) ?>" value="<?php echo $councillor_search->Telephone->EditValue ?>"<?php echo $councillor_search->Telephone->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($councillor_search->Mobile->Visible) { // Mobile ?>
	<div id="r_Mobile" class="form-group row">
		<label for="x_Mobile" class="<?php echo $councillor_search->LeftColumnClass ?>"><span id="elh_councillor_Mobile"><?php echo $councillor_search->Mobile->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Mobile" id="z_Mobile" value="LIKE">
</span>
		</label>
		<div class="<?php echo $councillor_search->RightColumnClass ?>"><div <?php echo $councillor_search->Mobile->cellAttributes() ?>>
			<span id="el_councillor_Mobile" class="ew-search-field">
<input type="text" data-table="councillor" data-field="x_Mobile" name="x_Mobile" id="x_Mobile" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($councillor_search->Mobile->getPlaceHolder()) ?>" value="<?php echo $councillor_search->Mobile->EditValue ?>"<?php echo $councillor_search->Mobile->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($councillor_search->Fax->Visible) { // Fax ?>
	<div id="r_Fax" class="form-group row">
		<label for="x_Fax" class="<?php echo $councillor_search->LeftColumnClass ?>"><span id="elh_councillor_Fax"><?php echo $councillor_search->Fax->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Fax" id="z_Fax" value="LIKE">
</span>
		</label>
		<div class="<?php echo $councillor_search->RightColumnClass ?>"><div <?php echo $councillor_search->Fax->cellAttributes() ?>>
			<span id="el_councillor_Fax" class="ew-search-field">
<input type="text" data-table="councillor" data-field="x_Fax" name="x_Fax" id="x_Fax" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($councillor_search->Fax->getPlaceHolder()) ?>" value="<?php echo $councillor_search->Fax->EditValue ?>"<?php echo $councillor_search->Fax->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($councillor_search->_Email->Visible) { // Email ?>
	<div id="r__Email" class="form-group row">
		<label for="x__Email" class="<?php echo $councillor_search->LeftColumnClass ?>"><span id="elh_councillor__Email"><?php echo $councillor_search->_Email->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z__Email" id="z__Email" value="LIKE">
</span>
		</label>
		<div class="<?php echo $councillor_search->RightColumnClass ?>"><div <?php echo $councillor_search->_Email->cellAttributes() ?>>
			<span id="el_councillor__Email" class="ew-search-field">
<input type="text" data-table="councillor" data-field="x__Email" name="x__Email" id="x__Email" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($councillor_search->_Email->getPlaceHolder()) ?>" value="<?php echo $councillor_search->_Email->EditValue ?>"<?php echo $councillor_search->_Email->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$councillor_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $councillor_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$councillor_search->showPageFooter();
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
$councillor_search->terminate();
?>