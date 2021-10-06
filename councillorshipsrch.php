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
$councillorship_search = new councillorship_search();

// Run the page
$councillorship_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$councillorship_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcouncillorshipsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($councillorship_search->IsModal) { ?>
	fcouncillorshipsearch = currentAdvancedSearchForm = new ew.Form("fcouncillorshipsearch", "search");
	<?php } else { ?>
	fcouncillorshipsearch = currentForm = new ew.Form("fcouncillorshipsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fcouncillorshipsearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_EmployeeID");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($councillorship_search->EmployeeID->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ProvinceCode");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($councillorship_search->ProvinceCode->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_DateOfExit");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($councillorship_search->DateOfExit->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fcouncillorshipsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcouncillorshipsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fcouncillorshipsearch.lists["x_EmployeeID"] = <?php echo $councillorship_search->EmployeeID->Lookup->toClientList($councillorship_search) ?>;
	fcouncillorshipsearch.lists["x_EmployeeID"].options = <?php echo JsonEncode($councillorship_search->EmployeeID->lookupOptions()) ?>;
	fcouncillorshipsearch.autoSuggests["x_EmployeeID"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fcouncillorshipsearch.lists["x_ProvinceCode"] = <?php echo $councillorship_search->ProvinceCode->Lookup->toClientList($councillorship_search) ?>;
	fcouncillorshipsearch.lists["x_ProvinceCode"].options = <?php echo JsonEncode($councillorship_search->ProvinceCode->lookupOptions()) ?>;
	fcouncillorshipsearch.autoSuggests["x_ProvinceCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fcouncillorshipsearch.lists["x_LACode"] = <?php echo $councillorship_search->LACode->Lookup->toClientList($councillorship_search) ?>;
	fcouncillorshipsearch.lists["x_LACode"].options = <?php echo JsonEncode($councillorship_search->LACode->lookupOptions()) ?>;
	fcouncillorshipsearch.lists["x_PoliticalParty"] = <?php echo $councillorship_search->PoliticalParty->Lookup->toClientList($councillorship_search) ?>;
	fcouncillorshipsearch.lists["x_PoliticalParty"].options = <?php echo JsonEncode($councillorship_search->PoliticalParty->lookupOptions()) ?>;
	fcouncillorshipsearch.lists["x_Occupation"] = <?php echo $councillorship_search->Occupation->Lookup->toClientList($councillorship_search) ?>;
	fcouncillorshipsearch.lists["x_Occupation"].options = <?php echo JsonEncode($councillorship_search->Occupation->lookupOptions()) ?>;
	fcouncillorshipsearch.lists["x_PositionInCouncil"] = <?php echo $councillorship_search->PositionInCouncil->Lookup->toClientList($councillorship_search) ?>;
	fcouncillorshipsearch.lists["x_PositionInCouncil"].options = <?php echo JsonEncode($councillorship_search->PositionInCouncil->lookupOptions()) ?>;
	fcouncillorshipsearch.lists["x_Committee"] = <?php echo $councillorship_search->Committee->Lookup->toClientList($councillorship_search) ?>;
	fcouncillorshipsearch.lists["x_Committee"].options = <?php echo JsonEncode($councillorship_search->Committee->lookupOptions()) ?>;
	fcouncillorshipsearch.lists["x_CommitteeRole"] = <?php echo $councillorship_search->CommitteeRole->Lookup->toClientList($councillorship_search) ?>;
	fcouncillorshipsearch.lists["x_CommitteeRole"].options = <?php echo JsonEncode($councillorship_search->CommitteeRole->lookupOptions()) ?>;
	fcouncillorshipsearch.lists["x_CouncilTerm"] = <?php echo $councillorship_search->CouncilTerm->Lookup->toClientList($councillorship_search) ?>;
	fcouncillorshipsearch.lists["x_CouncilTerm"].options = <?php echo JsonEncode($councillorship_search->CouncilTerm->lookupOptions()) ?>;
	fcouncillorshipsearch.lists["x_CouncillorTypeType"] = <?php echo $councillorship_search->CouncillorTypeType->Lookup->toClientList($councillorship_search) ?>;
	fcouncillorshipsearch.lists["x_CouncillorTypeType"].options = <?php echo JsonEncode($councillorship_search->CouncillorTypeType->lookupOptions()) ?>;
	fcouncillorshipsearch.lists["x_ExitReason"] = <?php echo $councillorship_search->ExitReason->Lookup->toClientList($councillorship_search) ?>;
	fcouncillorshipsearch.lists["x_ExitReason"].options = <?php echo JsonEncode($councillorship_search->ExitReason->lookupOptions()) ?>;
	loadjs.done("fcouncillorshipsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $councillorship_search->showPageHeader(); ?>
<?php
$councillorship_search->showMessage();
?>
<form name="fcouncillorshipsearch" id="fcouncillorshipsearch" class="<?php echo $councillorship_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="councillorship">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$councillorship_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($councillorship_search->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label class="<?php echo $councillorship_search->LeftColumnClass ?>"><span id="elh_councillorship_EmployeeID"><?php echo $councillorship_search->EmployeeID->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_EmployeeID" id="z_EmployeeID" value="=">
</span>
		</label>
		<div class="<?php echo $councillorship_search->RightColumnClass ?>"><div <?php echo $councillorship_search->EmployeeID->cellAttributes() ?>>
			<span id="el_councillorship_EmployeeID" class="ew-search-field">
<?php
$onchange = $councillorship_search->EmployeeID->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$councillorship_search->EmployeeID->EditAttrs["onchange"] = "";
?>
<span id="as_x_EmployeeID">
	<input type="text" class="form-control" name="sv_x_EmployeeID" id="sv_x_EmployeeID" value="<?php echo RemoveHtml($councillorship_search->EmployeeID->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($councillorship_search->EmployeeID->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($councillorship_search->EmployeeID->getPlaceHolder()) ?>"<?php echo $councillorship_search->EmployeeID->editAttributes() ?>>
</span>
<input type="hidden" data-table="councillorship" data-field="x_EmployeeID" data-value-separator="<?php echo $councillorship_search->EmployeeID->displayValueSeparatorAttribute() ?>" name="x_EmployeeID" id="x_EmployeeID" value="<?php echo HtmlEncode($councillorship_search->EmployeeID->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fcouncillorshipsearch"], function() {
	fcouncillorshipsearch.createAutoSuggest({"id":"x_EmployeeID","forceSelect":false});
});
</script>
<?php echo $councillorship_search->EmployeeID->Lookup->getParamTag($councillorship_search, "p_x_EmployeeID") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($councillorship_search->ProvinceCode->Visible) { // ProvinceCode ?>
	<div id="r_ProvinceCode" class="form-group row">
		<label class="<?php echo $councillorship_search->LeftColumnClass ?>"><span id="elh_councillorship_ProvinceCode"><?php echo $councillorship_search->ProvinceCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ProvinceCode" id="z_ProvinceCode" value="=">
</span>
		</label>
		<div class="<?php echo $councillorship_search->RightColumnClass ?>"><div <?php echo $councillorship_search->ProvinceCode->cellAttributes() ?>>
			<span id="el_councillorship_ProvinceCode" class="ew-search-field">
<?php
$onchange = $councillorship_search->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$councillorship_search->ProvinceCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_ProvinceCode">
	<input type="text" class="form-control" name="sv_x_ProvinceCode" id="sv_x_ProvinceCode" value="<?php echo RemoveHtml($councillorship_search->ProvinceCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($councillorship_search->ProvinceCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($councillorship_search->ProvinceCode->getPlaceHolder()) ?>"<?php echo $councillorship_search->ProvinceCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="councillorship" data-field="x_ProvinceCode" data-value-separator="<?php echo $councillorship_search->ProvinceCode->displayValueSeparatorAttribute() ?>" name="x_ProvinceCode" id="x_ProvinceCode" value="<?php echo HtmlEncode($councillorship_search->ProvinceCode->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fcouncillorshipsearch"], function() {
	fcouncillorshipsearch.createAutoSuggest({"id":"x_ProvinceCode","forceSelect":false});
});
</script>
<?php echo $councillorship_search->ProvinceCode->Lookup->getParamTag($councillorship_search, "p_x_ProvinceCode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($councillorship_search->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label for="x_LACode" class="<?php echo $councillorship_search->LeftColumnClass ?>"><span id="elh_councillorship_LACode"><?php echo $councillorship_search->LACode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_LACode" id="z_LACode" value="LIKE">
</span>
		</label>
		<div class="<?php echo $councillorship_search->RightColumnClass ?>"><div <?php echo $councillorship_search->LACode->cellAttributes() ?>>
			<span id="el_councillorship_LACode" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_LACode" data-value-separator="<?php echo $councillorship_search->LACode->displayValueSeparatorAttribute() ?>" id="x_LACode" name="x_LACode"<?php echo $councillorship_search->LACode->editAttributes() ?>>
			<?php echo $councillorship_search->LACode->selectOptionListHtml("x_LACode") ?>
		</select>
</div>
<?php echo $councillorship_search->LACode->Lookup->getParamTag($councillorship_search, "p_x_LACode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($councillorship_search->PoliticalParty->Visible) { // PoliticalParty ?>
	<div id="r_PoliticalParty" class="form-group row">
		<label for="x_PoliticalParty" class="<?php echo $councillorship_search->LeftColumnClass ?>"><span id="elh_councillorship_PoliticalParty"><?php echo $councillorship_search->PoliticalParty->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_PoliticalParty" id="z_PoliticalParty" value="=">
</span>
		</label>
		<div class="<?php echo $councillorship_search->RightColumnClass ?>"><div <?php echo $councillorship_search->PoliticalParty->cellAttributes() ?>>
			<span id="el_councillorship_PoliticalParty" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_PoliticalParty" data-value-separator="<?php echo $councillorship_search->PoliticalParty->displayValueSeparatorAttribute() ?>" id="x_PoliticalParty" name="x_PoliticalParty"<?php echo $councillorship_search->PoliticalParty->editAttributes() ?>>
			<?php echo $councillorship_search->PoliticalParty->selectOptionListHtml("x_PoliticalParty") ?>
		</select>
</div>
<?php echo $councillorship_search->PoliticalParty->Lookup->getParamTag($councillorship_search, "p_x_PoliticalParty") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($councillorship_search->Occupation->Visible) { // Occupation ?>
	<div id="r_Occupation" class="form-group row">
		<label for="x_Occupation" class="<?php echo $councillorship_search->LeftColumnClass ?>"><span id="elh_councillorship_Occupation"><?php echo $councillorship_search->Occupation->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Occupation" id="z_Occupation" value="=">
</span>
		</label>
		<div class="<?php echo $councillorship_search->RightColumnClass ?>"><div <?php echo $councillorship_search->Occupation->cellAttributes() ?>>
			<span id="el_councillorship_Occupation" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_Occupation" data-value-separator="<?php echo $councillorship_search->Occupation->displayValueSeparatorAttribute() ?>" id="x_Occupation" name="x_Occupation"<?php echo $councillorship_search->Occupation->editAttributes() ?>>
			<?php echo $councillorship_search->Occupation->selectOptionListHtml("x_Occupation") ?>
		</select>
</div>
<?php echo $councillorship_search->Occupation->Lookup->getParamTag($councillorship_search, "p_x_Occupation") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($councillorship_search->PositionInCouncil->Visible) { // PositionInCouncil ?>
	<div id="r_PositionInCouncil" class="form-group row">
		<label for="x_PositionInCouncil" class="<?php echo $councillorship_search->LeftColumnClass ?>"><span id="elh_councillorship_PositionInCouncil"><?php echo $councillorship_search->PositionInCouncil->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_PositionInCouncil" id="z_PositionInCouncil" value="=">
</span>
		</label>
		<div class="<?php echo $councillorship_search->RightColumnClass ?>"><div <?php echo $councillorship_search->PositionInCouncil->cellAttributes() ?>>
			<span id="el_councillorship_PositionInCouncil" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_PositionInCouncil" data-value-separator="<?php echo $councillorship_search->PositionInCouncil->displayValueSeparatorAttribute() ?>" id="x_PositionInCouncil" name="x_PositionInCouncil"<?php echo $councillorship_search->PositionInCouncil->editAttributes() ?>>
			<?php echo $councillorship_search->PositionInCouncil->selectOptionListHtml("x_PositionInCouncil") ?>
		</select>
</div>
<?php echo $councillorship_search->PositionInCouncil->Lookup->getParamTag($councillorship_search, "p_x_PositionInCouncil") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($councillorship_search->Committee->Visible) { // Committee ?>
	<div id="r_Committee" class="form-group row">
		<label for="x_Committee" class="<?php echo $councillorship_search->LeftColumnClass ?>"><span id="elh_councillorship_Committee"><?php echo $councillorship_search->Committee->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Committee" id="z_Committee" value="LIKE">
</span>
		</label>
		<div class="<?php echo $councillorship_search->RightColumnClass ?>"><div <?php echo $councillorship_search->Committee->cellAttributes() ?>>
			<span id="el_councillorship_Committee" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_Committee" data-value-separator="<?php echo $councillorship_search->Committee->displayValueSeparatorAttribute() ?>" id="x_Committee" name="x_Committee"<?php echo $councillorship_search->Committee->editAttributes() ?>>
			<?php echo $councillorship_search->Committee->selectOptionListHtml("x_Committee") ?>
		</select>
</div>
<?php echo $councillorship_search->Committee->Lookup->getParamTag($councillorship_search, "p_x_Committee") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($councillorship_search->CommitteeRole->Visible) { // CommitteeRole ?>
	<div id="r_CommitteeRole" class="form-group row">
		<label for="x_CommitteeRole" class="<?php echo $councillorship_search->LeftColumnClass ?>"><span id="elh_councillorship_CommitteeRole"><?php echo $councillorship_search->CommitteeRole->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_CommitteeRole" id="z_CommitteeRole" value="=">
</span>
		</label>
		<div class="<?php echo $councillorship_search->RightColumnClass ?>"><div <?php echo $councillorship_search->CommitteeRole->cellAttributes() ?>>
			<span id="el_councillorship_CommitteeRole" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_CommitteeRole" data-value-separator="<?php echo $councillorship_search->CommitteeRole->displayValueSeparatorAttribute() ?>" id="x_CommitteeRole" name="x_CommitteeRole"<?php echo $councillorship_search->CommitteeRole->editAttributes() ?>>
			<?php echo $councillorship_search->CommitteeRole->selectOptionListHtml("x_CommitteeRole") ?>
		</select>
</div>
<?php echo $councillorship_search->CommitteeRole->Lookup->getParamTag($councillorship_search, "p_x_CommitteeRole") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($councillorship_search->CouncilTerm->Visible) { // CouncilTerm ?>
	<div id="r_CouncilTerm" class="form-group row">
		<label for="x_CouncilTerm" class="<?php echo $councillorship_search->LeftColumnClass ?>"><span id="elh_councillorship_CouncilTerm"><?php echo $councillorship_search->CouncilTerm->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_CouncilTerm" id="z_CouncilTerm" value="=">
</span>
		</label>
		<div class="<?php echo $councillorship_search->RightColumnClass ?>"><div <?php echo $councillorship_search->CouncilTerm->cellAttributes() ?>>
			<span id="el_councillorship_CouncilTerm" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_CouncilTerm" data-value-separator="<?php echo $councillorship_search->CouncilTerm->displayValueSeparatorAttribute() ?>" id="x_CouncilTerm" name="x_CouncilTerm"<?php echo $councillorship_search->CouncilTerm->editAttributes() ?>>
			<?php echo $councillorship_search->CouncilTerm->selectOptionListHtml("x_CouncilTerm") ?>
		</select>
</div>
<?php echo $councillorship_search->CouncilTerm->Lookup->getParamTag($councillorship_search, "p_x_CouncilTerm") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($councillorship_search->DateOfExit->Visible) { // DateOfExit ?>
	<div id="r_DateOfExit" class="form-group row">
		<label for="x_DateOfExit" class="<?php echo $councillorship_search->LeftColumnClass ?>"><span id="elh_councillorship_DateOfExit"><?php echo $councillorship_search->DateOfExit->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_DateOfExit" id="z_DateOfExit" value="=">
</span>
		</label>
		<div class="<?php echo $councillorship_search->RightColumnClass ?>"><div <?php echo $councillorship_search->DateOfExit->cellAttributes() ?>>
			<span id="el_councillorship_DateOfExit" class="ew-search-field">
<input type="text" data-table="councillorship" data-field="x_DateOfExit" name="x_DateOfExit" id="x_DateOfExit" placeholder="<?php echo HtmlEncode($councillorship_search->DateOfExit->getPlaceHolder()) ?>" value="<?php echo $councillorship_search->DateOfExit->EditValue ?>"<?php echo $councillorship_search->DateOfExit->editAttributes() ?>>
<?php if (!$councillorship_search->DateOfExit->ReadOnly && !$councillorship_search->DateOfExit->Disabled && !isset($councillorship_search->DateOfExit->EditAttrs["readonly"]) && !isset($councillorship_search->DateOfExit->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcouncillorshipsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fcouncillorshipsearch", "x_DateOfExit", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($councillorship_search->Allowance->Visible) { // Allowance ?>
	<div id="r_Allowance" class="form-group row">
		<label for="x_Allowance" class="<?php echo $councillorship_search->LeftColumnClass ?>"><span id="elh_councillorship_Allowance"><?php echo $councillorship_search->Allowance->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Allowance" id="z_Allowance" value="LIKE">
</span>
		</label>
		<div class="<?php echo $councillorship_search->RightColumnClass ?>"><div <?php echo $councillorship_search->Allowance->cellAttributes() ?>>
			<span id="el_councillorship_Allowance" class="ew-search-field">
<input type="text" data-table="councillorship" data-field="x_Allowance" name="x_Allowance" id="x_Allowance" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($councillorship_search->Allowance->getPlaceHolder()) ?>" value="<?php echo $councillorship_search->Allowance->EditValue ?>"<?php echo $councillorship_search->Allowance->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($councillorship_search->CouncillorTypeType->Visible) { // CouncillorTypeType ?>
	<div id="r_CouncillorTypeType" class="form-group row">
		<label for="x_CouncillorTypeType" class="<?php echo $councillorship_search->LeftColumnClass ?>"><span id="elh_councillorship_CouncillorTypeType"><?php echo $councillorship_search->CouncillorTypeType->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_CouncillorTypeType" id="z_CouncillorTypeType" value="=">
</span>
		</label>
		<div class="<?php echo $councillorship_search->RightColumnClass ?>"><div <?php echo $councillorship_search->CouncillorTypeType->cellAttributes() ?>>
			<span id="el_councillorship_CouncillorTypeType" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_CouncillorTypeType" data-value-separator="<?php echo $councillorship_search->CouncillorTypeType->displayValueSeparatorAttribute() ?>" id="x_CouncillorTypeType" name="x_CouncillorTypeType"<?php echo $councillorship_search->CouncillorTypeType->editAttributes() ?>>
			<?php echo $councillorship_search->CouncillorTypeType->selectOptionListHtml("x_CouncillorTypeType") ?>
		</select>
</div>
<?php echo $councillorship_search->CouncillorTypeType->Lookup->getParamTag($councillorship_search, "p_x_CouncillorTypeType") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($councillorship_search->ExitReason->Visible) { // ExitReason ?>
	<div id="r_ExitReason" class="form-group row">
		<label for="x_ExitReason" class="<?php echo $councillorship_search->LeftColumnClass ?>"><span id="elh_councillorship_ExitReason"><?php echo $councillorship_search->ExitReason->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ExitReason" id="z_ExitReason" value="=">
</span>
		</label>
		<div class="<?php echo $councillorship_search->RightColumnClass ?>"><div <?php echo $councillorship_search->ExitReason->cellAttributes() ?>>
			<span id="el_councillorship_ExitReason" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_ExitReason" data-value-separator="<?php echo $councillorship_search->ExitReason->displayValueSeparatorAttribute() ?>" id="x_ExitReason" name="x_ExitReason"<?php echo $councillorship_search->ExitReason->editAttributes() ?>>
			<?php echo $councillorship_search->ExitReason->selectOptionListHtml("x_ExitReason") ?>
		</select>
</div>
<?php echo $councillorship_search->ExitReason->Lookup->getParamTag($councillorship_search, "p_x_ExitReason") ?>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$councillorship_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $councillorship_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$councillorship_search->showPageFooter();
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
$councillorship_search->terminate();
?>