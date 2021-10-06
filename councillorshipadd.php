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
$councillorship_add = new councillorship_add();

// Run the page
$councillorship_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$councillorship_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcouncillorshipadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fcouncillorshipadd = currentForm = new ew.Form("fcouncillorshipadd", "add");

	// Validate form
	fcouncillorshipadd.validate = function() {
		if (!this.validateRequired)
			return true; // Ignore validation
		var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
		if ($fobj.find("#confirm").val() == "confirm")
			return true;
		var elm, felm, uelm, addcnt = 0;
		var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
		var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
		var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
		var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
		for (var i = startcnt; i <= rowcnt; i++) {
			var infix = ($k[0]) ? String(i) : "";
			$fobj.data("rowindex", infix);
			<?php if ($councillorship_add->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_add->EmployeeID->caption(), $councillorship_add->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($councillorship_add->EmployeeID->errorMessage()) ?>");
			<?php if ($councillorship_add->ProvinceCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_add->ProvinceCode->caption(), $councillorship_add->ProvinceCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($councillorship_add->ProvinceCode->errorMessage()) ?>");
			<?php if ($councillorship_add->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_add->LACode->caption(), $councillorship_add->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillorship_add->PoliticalParty->Required) { ?>
				elm = this.getElements("x" + infix + "_PoliticalParty");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_add->PoliticalParty->caption(), $councillorship_add->PoliticalParty->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillorship_add->Occupation->Required) { ?>
				elm = this.getElements("x" + infix + "_Occupation");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_add->Occupation->caption(), $councillorship_add->Occupation->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillorship_add->PositionInCouncil->Required) { ?>
				elm = this.getElements("x" + infix + "_PositionInCouncil");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_add->PositionInCouncil->caption(), $councillorship_add->PositionInCouncil->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillorship_add->Committee->Required) { ?>
				elm = this.getElements("x" + infix + "_Committee");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_add->Committee->caption(), $councillorship_add->Committee->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillorship_add->CommitteeRole->Required) { ?>
				elm = this.getElements("x" + infix + "_CommitteeRole");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_add->CommitteeRole->caption(), $councillorship_add->CommitteeRole->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillorship_add->CouncilTerm->Required) { ?>
				elm = this.getElements("x" + infix + "_CouncilTerm");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_add->CouncilTerm->caption(), $councillorship_add->CouncilTerm->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillorship_add->DateOfExit->Required) { ?>
				elm = this.getElements("x" + infix + "_DateOfExit");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_add->DateOfExit->caption(), $councillorship_add->DateOfExit->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateOfExit");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($councillorship_add->DateOfExit->errorMessage()) ?>");
			<?php if ($councillorship_add->Allowance->Required) { ?>
				elm = this.getElements("x" + infix + "_Allowance");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_add->Allowance->caption(), $councillorship_add->Allowance->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillorship_add->CouncillorTypeType->Required) { ?>
				elm = this.getElements("x" + infix + "_CouncillorTypeType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_add->CouncillorTypeType->caption(), $councillorship_add->CouncillorTypeType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillorship_add->ExitReason->Required) { ?>
				elm = this.getElements("x" + infix + "_ExitReason");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_add->ExitReason->caption(), $councillorship_add->ExitReason->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillorship_add->CouncillorPhoto->Required) { ?>
				felm = this.getElements("x" + infix + "_CouncillorPhoto");
				elm = this.getElements("fn_x" + infix + "_CouncillorPhoto");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $councillorship_add->CouncillorPhoto->caption(), $councillorship_add->CouncillorPhoto->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}

		// Process detail forms
		var dfs = $fobj.find("input[name='detailpage']").get();
		for (var i = 0; i < dfs.length; i++) {
			var df = dfs[i], val = df.value;
			if (val && ew.forms[val])
				if (!ew.forms[val].validate())
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	fcouncillorshipadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcouncillorshipadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fcouncillorshipadd.lists["x_EmployeeID"] = <?php echo $councillorship_add->EmployeeID->Lookup->toClientList($councillorship_add) ?>;
	fcouncillorshipadd.lists["x_EmployeeID"].options = <?php echo JsonEncode($councillorship_add->EmployeeID->lookupOptions()) ?>;
	fcouncillorshipadd.autoSuggests["x_EmployeeID"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fcouncillorshipadd.lists["x_ProvinceCode"] = <?php echo $councillorship_add->ProvinceCode->Lookup->toClientList($councillorship_add) ?>;
	fcouncillorshipadd.lists["x_ProvinceCode"].options = <?php echo JsonEncode($councillorship_add->ProvinceCode->lookupOptions()) ?>;
	fcouncillorshipadd.autoSuggests["x_ProvinceCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fcouncillorshipadd.lists["x_LACode"] = <?php echo $councillorship_add->LACode->Lookup->toClientList($councillorship_add) ?>;
	fcouncillorshipadd.lists["x_LACode"].options = <?php echo JsonEncode($councillorship_add->LACode->lookupOptions()) ?>;
	fcouncillorshipadd.lists["x_PoliticalParty"] = <?php echo $councillorship_add->PoliticalParty->Lookup->toClientList($councillorship_add) ?>;
	fcouncillorshipadd.lists["x_PoliticalParty"].options = <?php echo JsonEncode($councillorship_add->PoliticalParty->lookupOptions()) ?>;
	fcouncillorshipadd.lists["x_Occupation"] = <?php echo $councillorship_add->Occupation->Lookup->toClientList($councillorship_add) ?>;
	fcouncillorshipadd.lists["x_Occupation"].options = <?php echo JsonEncode($councillorship_add->Occupation->lookupOptions()) ?>;
	fcouncillorshipadd.lists["x_PositionInCouncil"] = <?php echo $councillorship_add->PositionInCouncil->Lookup->toClientList($councillorship_add) ?>;
	fcouncillorshipadd.lists["x_PositionInCouncil"].options = <?php echo JsonEncode($councillorship_add->PositionInCouncil->lookupOptions()) ?>;
	fcouncillorshipadd.lists["x_Committee"] = <?php echo $councillorship_add->Committee->Lookup->toClientList($councillorship_add) ?>;
	fcouncillorshipadd.lists["x_Committee"].options = <?php echo JsonEncode($councillorship_add->Committee->lookupOptions()) ?>;
	fcouncillorshipadd.lists["x_CommitteeRole"] = <?php echo $councillorship_add->CommitteeRole->Lookup->toClientList($councillorship_add) ?>;
	fcouncillorshipadd.lists["x_CommitteeRole"].options = <?php echo JsonEncode($councillorship_add->CommitteeRole->lookupOptions()) ?>;
	fcouncillorshipadd.lists["x_CouncilTerm"] = <?php echo $councillorship_add->CouncilTerm->Lookup->toClientList($councillorship_add) ?>;
	fcouncillorshipadd.lists["x_CouncilTerm"].options = <?php echo JsonEncode($councillorship_add->CouncilTerm->lookupOptions()) ?>;
	fcouncillorshipadd.lists["x_CouncillorTypeType"] = <?php echo $councillorship_add->CouncillorTypeType->Lookup->toClientList($councillorship_add) ?>;
	fcouncillorshipadd.lists["x_CouncillorTypeType"].options = <?php echo JsonEncode($councillorship_add->CouncillorTypeType->lookupOptions()) ?>;
	fcouncillorshipadd.lists["x_ExitReason"] = <?php echo $councillorship_add->ExitReason->Lookup->toClientList($councillorship_add) ?>;
	fcouncillorshipadd.lists["x_ExitReason"].options = <?php echo JsonEncode($councillorship_add->ExitReason->lookupOptions()) ?>;
	loadjs.done("fcouncillorshipadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $councillorship_add->showPageHeader(); ?>
<?php
$councillorship_add->showMessage();
?>
<form name="fcouncillorshipadd" id="fcouncillorshipadd" class="<?php echo $councillorship_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="councillorship">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$councillorship_add->IsModal ?>">
<?php if ($councillorship->getCurrentMasterTable() == "councillor") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="councillor">
<input type="hidden" name="fk_EmployeeID" value="<?php echo HtmlEncode($councillorship_add->EmployeeID->getSessionValue()) ?>">
<?php } ?>
<?php if ($councillorship->getCurrentMasterTable() == "local_authority") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="local_authority">
<input type="hidden" name="fk_LACode" value="<?php echo HtmlEncode($councillorship_add->LACode->getSessionValue()) ?>">
<input type="hidden" name="fk_ProvinceCode" value="<?php echo HtmlEncode($councillorship_add->ProvinceCode->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($councillorship_add->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label id="elh_councillorship_EmployeeID" class="<?php echo $councillorship_add->LeftColumnClass ?>"><?php echo $councillorship_add->EmployeeID->caption() ?><?php echo $councillorship_add->EmployeeID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillorship_add->RightColumnClass ?>"><div <?php echo $councillorship_add->EmployeeID->cellAttributes() ?>>
<?php if ($councillorship_add->EmployeeID->getSessionValue() != "") { ?>
<span id="el_councillorship_EmployeeID">
<span<?php echo $councillorship_add->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($councillorship_add->EmployeeID->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_EmployeeID" name="x_EmployeeID" value="<?php echo HtmlEncode($councillorship_add->EmployeeID->CurrentValue) ?>">
<?php } else { ?>
<span id="el_councillorship_EmployeeID">
<?php
$onchange = $councillorship_add->EmployeeID->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$councillorship_add->EmployeeID->EditAttrs["onchange"] = "";
?>
<span id="as_x_EmployeeID">
	<input type="text" class="form-control" name="sv_x_EmployeeID" id="sv_x_EmployeeID" value="<?php echo RemoveHtml($councillorship_add->EmployeeID->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($councillorship_add->EmployeeID->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($councillorship_add->EmployeeID->getPlaceHolder()) ?>"<?php echo $councillorship_add->EmployeeID->editAttributes() ?>>
</span>
<input type="hidden" data-table="councillorship" data-field="x_EmployeeID" data-value-separator="<?php echo $councillorship_add->EmployeeID->displayValueSeparatorAttribute() ?>" name="x_EmployeeID" id="x_EmployeeID" value="<?php echo HtmlEncode($councillorship_add->EmployeeID->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fcouncillorshipadd"], function() {
	fcouncillorshipadd.createAutoSuggest({"id":"x_EmployeeID","forceSelect":false});
});
</script>
<?php echo $councillorship_add->EmployeeID->Lookup->getParamTag($councillorship_add, "p_x_EmployeeID") ?>
</span>
<?php } ?>
<?php echo $councillorship_add->EmployeeID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillorship_add->ProvinceCode->Visible) { // ProvinceCode ?>
	<div id="r_ProvinceCode" class="form-group row">
		<label id="elh_councillorship_ProvinceCode" class="<?php echo $councillorship_add->LeftColumnClass ?>"><?php echo $councillorship_add->ProvinceCode->caption() ?><?php echo $councillorship_add->ProvinceCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillorship_add->RightColumnClass ?>"><div <?php echo $councillorship_add->ProvinceCode->cellAttributes() ?>>
<?php if ($councillorship_add->ProvinceCode->getSessionValue() != "") { ?>
<span id="el_councillorship_ProvinceCode">
<span<?php echo $councillorship_add->ProvinceCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($councillorship_add->ProvinceCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_ProvinceCode" name="x_ProvinceCode" value="<?php echo HtmlEncode($councillorship_add->ProvinceCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_councillorship_ProvinceCode">
<?php
$onchange = $councillorship_add->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$councillorship_add->ProvinceCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_ProvinceCode">
	<input type="text" class="form-control" name="sv_x_ProvinceCode" id="sv_x_ProvinceCode" value="<?php echo RemoveHtml($councillorship_add->ProvinceCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($councillorship_add->ProvinceCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($councillorship_add->ProvinceCode->getPlaceHolder()) ?>"<?php echo $councillorship_add->ProvinceCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="councillorship" data-field="x_ProvinceCode" data-value-separator="<?php echo $councillorship_add->ProvinceCode->displayValueSeparatorAttribute() ?>" name="x_ProvinceCode" id="x_ProvinceCode" value="<?php echo HtmlEncode($councillorship_add->ProvinceCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fcouncillorshipadd"], function() {
	fcouncillorshipadd.createAutoSuggest({"id":"x_ProvinceCode","forceSelect":false});
});
</script>
<?php echo $councillorship_add->ProvinceCode->Lookup->getParamTag($councillorship_add, "p_x_ProvinceCode") ?>
</span>
<?php } ?>
<?php echo $councillorship_add->ProvinceCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillorship_add->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label id="elh_councillorship_LACode" for="x_LACode" class="<?php echo $councillorship_add->LeftColumnClass ?>"><?php echo $councillorship_add->LACode->caption() ?><?php echo $councillorship_add->LACode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillorship_add->RightColumnClass ?>"><div <?php echo $councillorship_add->LACode->cellAttributes() ?>>
<?php if ($councillorship_add->LACode->getSessionValue() != "") { ?>
<span id="el_councillorship_LACode">
<span<?php echo $councillorship_add->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($councillorship_add->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_LACode" name="x_LACode" value="<?php echo HtmlEncode($councillorship_add->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_councillorship_LACode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_LACode" data-value-separator="<?php echo $councillorship_add->LACode->displayValueSeparatorAttribute() ?>" id="x_LACode" name="x_LACode"<?php echo $councillorship_add->LACode->editAttributes() ?>>
			<?php echo $councillorship_add->LACode->selectOptionListHtml("x_LACode") ?>
		</select>
</div>
<?php echo $councillorship_add->LACode->Lookup->getParamTag($councillorship_add, "p_x_LACode") ?>
</span>
<?php } ?>
<?php echo $councillorship_add->LACode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillorship_add->PoliticalParty->Visible) { // PoliticalParty ?>
	<div id="r_PoliticalParty" class="form-group row">
		<label id="elh_councillorship_PoliticalParty" for="x_PoliticalParty" class="<?php echo $councillorship_add->LeftColumnClass ?>"><?php echo $councillorship_add->PoliticalParty->caption() ?><?php echo $councillorship_add->PoliticalParty->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillorship_add->RightColumnClass ?>"><div <?php echo $councillorship_add->PoliticalParty->cellAttributes() ?>>
<span id="el_councillorship_PoliticalParty">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_PoliticalParty" data-value-separator="<?php echo $councillorship_add->PoliticalParty->displayValueSeparatorAttribute() ?>" id="x_PoliticalParty" name="x_PoliticalParty"<?php echo $councillorship_add->PoliticalParty->editAttributes() ?>>
			<?php echo $councillorship_add->PoliticalParty->selectOptionListHtml("x_PoliticalParty") ?>
		</select>
</div>
<?php echo $councillorship_add->PoliticalParty->Lookup->getParamTag($councillorship_add, "p_x_PoliticalParty") ?>
</span>
<?php echo $councillorship_add->PoliticalParty->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillorship_add->Occupation->Visible) { // Occupation ?>
	<div id="r_Occupation" class="form-group row">
		<label id="elh_councillorship_Occupation" for="x_Occupation" class="<?php echo $councillorship_add->LeftColumnClass ?>"><?php echo $councillorship_add->Occupation->caption() ?><?php echo $councillorship_add->Occupation->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillorship_add->RightColumnClass ?>"><div <?php echo $councillorship_add->Occupation->cellAttributes() ?>>
<span id="el_councillorship_Occupation">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_Occupation" data-value-separator="<?php echo $councillorship_add->Occupation->displayValueSeparatorAttribute() ?>" id="x_Occupation" name="x_Occupation"<?php echo $councillorship_add->Occupation->editAttributes() ?>>
			<?php echo $councillorship_add->Occupation->selectOptionListHtml("x_Occupation") ?>
		</select>
</div>
<?php echo $councillorship_add->Occupation->Lookup->getParamTag($councillorship_add, "p_x_Occupation") ?>
</span>
<?php echo $councillorship_add->Occupation->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillorship_add->PositionInCouncil->Visible) { // PositionInCouncil ?>
	<div id="r_PositionInCouncil" class="form-group row">
		<label id="elh_councillorship_PositionInCouncil" for="x_PositionInCouncil" class="<?php echo $councillorship_add->LeftColumnClass ?>"><?php echo $councillorship_add->PositionInCouncil->caption() ?><?php echo $councillorship_add->PositionInCouncil->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillorship_add->RightColumnClass ?>"><div <?php echo $councillorship_add->PositionInCouncil->cellAttributes() ?>>
<span id="el_councillorship_PositionInCouncil">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_PositionInCouncil" data-value-separator="<?php echo $councillorship_add->PositionInCouncil->displayValueSeparatorAttribute() ?>" id="x_PositionInCouncil" name="x_PositionInCouncil"<?php echo $councillorship_add->PositionInCouncil->editAttributes() ?>>
			<?php echo $councillorship_add->PositionInCouncil->selectOptionListHtml("x_PositionInCouncil") ?>
		</select>
</div>
<?php echo $councillorship_add->PositionInCouncil->Lookup->getParamTag($councillorship_add, "p_x_PositionInCouncil") ?>
</span>
<?php echo $councillorship_add->PositionInCouncil->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillorship_add->Committee->Visible) { // Committee ?>
	<div id="r_Committee" class="form-group row">
		<label id="elh_councillorship_Committee" for="x_Committee" class="<?php echo $councillorship_add->LeftColumnClass ?>"><?php echo $councillorship_add->Committee->caption() ?><?php echo $councillorship_add->Committee->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillorship_add->RightColumnClass ?>"><div <?php echo $councillorship_add->Committee->cellAttributes() ?>>
<span id="el_councillorship_Committee">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_Committee" data-value-separator="<?php echo $councillorship_add->Committee->displayValueSeparatorAttribute() ?>" id="x_Committee" name="x_Committee"<?php echo $councillorship_add->Committee->editAttributes() ?>>
			<?php echo $councillorship_add->Committee->selectOptionListHtml("x_Committee") ?>
		</select>
</div>
<?php echo $councillorship_add->Committee->Lookup->getParamTag($councillorship_add, "p_x_Committee") ?>
</span>
<?php echo $councillorship_add->Committee->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillorship_add->CommitteeRole->Visible) { // CommitteeRole ?>
	<div id="r_CommitteeRole" class="form-group row">
		<label id="elh_councillorship_CommitteeRole" for="x_CommitteeRole" class="<?php echo $councillorship_add->LeftColumnClass ?>"><?php echo $councillorship_add->CommitteeRole->caption() ?><?php echo $councillorship_add->CommitteeRole->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillorship_add->RightColumnClass ?>"><div <?php echo $councillorship_add->CommitteeRole->cellAttributes() ?>>
<span id="el_councillorship_CommitteeRole">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_CommitteeRole" data-value-separator="<?php echo $councillorship_add->CommitteeRole->displayValueSeparatorAttribute() ?>" id="x_CommitteeRole" name="x_CommitteeRole"<?php echo $councillorship_add->CommitteeRole->editAttributes() ?>>
			<?php echo $councillorship_add->CommitteeRole->selectOptionListHtml("x_CommitteeRole") ?>
		</select>
</div>
<?php echo $councillorship_add->CommitteeRole->Lookup->getParamTag($councillorship_add, "p_x_CommitteeRole") ?>
</span>
<?php echo $councillorship_add->CommitteeRole->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillorship_add->CouncilTerm->Visible) { // CouncilTerm ?>
	<div id="r_CouncilTerm" class="form-group row">
		<label id="elh_councillorship_CouncilTerm" for="x_CouncilTerm" class="<?php echo $councillorship_add->LeftColumnClass ?>"><?php echo $councillorship_add->CouncilTerm->caption() ?><?php echo $councillorship_add->CouncilTerm->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillorship_add->RightColumnClass ?>"><div <?php echo $councillorship_add->CouncilTerm->cellAttributes() ?>>
<span id="el_councillorship_CouncilTerm">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_CouncilTerm" data-value-separator="<?php echo $councillorship_add->CouncilTerm->displayValueSeparatorAttribute() ?>" id="x_CouncilTerm" name="x_CouncilTerm"<?php echo $councillorship_add->CouncilTerm->editAttributes() ?>>
			<?php echo $councillorship_add->CouncilTerm->selectOptionListHtml("x_CouncilTerm") ?>
		</select>
</div>
<?php echo $councillorship_add->CouncilTerm->Lookup->getParamTag($councillorship_add, "p_x_CouncilTerm") ?>
</span>
<?php echo $councillorship_add->CouncilTerm->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillorship_add->DateOfExit->Visible) { // DateOfExit ?>
	<div id="r_DateOfExit" class="form-group row">
		<label id="elh_councillorship_DateOfExit" for="x_DateOfExit" class="<?php echo $councillorship_add->LeftColumnClass ?>"><?php echo $councillorship_add->DateOfExit->caption() ?><?php echo $councillorship_add->DateOfExit->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillorship_add->RightColumnClass ?>"><div <?php echo $councillorship_add->DateOfExit->cellAttributes() ?>>
<span id="el_councillorship_DateOfExit">
<input type="text" data-table="councillorship" data-field="x_DateOfExit" name="x_DateOfExit" id="x_DateOfExit" placeholder="<?php echo HtmlEncode($councillorship_add->DateOfExit->getPlaceHolder()) ?>" value="<?php echo $councillorship_add->DateOfExit->EditValue ?>"<?php echo $councillorship_add->DateOfExit->editAttributes() ?>>
<?php if (!$councillorship_add->DateOfExit->ReadOnly && !$councillorship_add->DateOfExit->Disabled && !isset($councillorship_add->DateOfExit->EditAttrs["readonly"]) && !isset($councillorship_add->DateOfExit->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcouncillorshipadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fcouncillorshipadd", "x_DateOfExit", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $councillorship_add->DateOfExit->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillorship_add->Allowance->Visible) { // Allowance ?>
	<div id="r_Allowance" class="form-group row">
		<label id="elh_councillorship_Allowance" for="x_Allowance" class="<?php echo $councillorship_add->LeftColumnClass ?>"><?php echo $councillorship_add->Allowance->caption() ?><?php echo $councillorship_add->Allowance->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillorship_add->RightColumnClass ?>"><div <?php echo $councillorship_add->Allowance->cellAttributes() ?>>
<span id="el_councillorship_Allowance">
<input type="text" data-table="councillorship" data-field="x_Allowance" name="x_Allowance" id="x_Allowance" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($councillorship_add->Allowance->getPlaceHolder()) ?>" value="<?php echo $councillorship_add->Allowance->EditValue ?>"<?php echo $councillorship_add->Allowance->editAttributes() ?>>
</span>
<?php echo $councillorship_add->Allowance->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillorship_add->CouncillorTypeType->Visible) { // CouncillorTypeType ?>
	<div id="r_CouncillorTypeType" class="form-group row">
		<label id="elh_councillorship_CouncillorTypeType" for="x_CouncillorTypeType" class="<?php echo $councillorship_add->LeftColumnClass ?>"><?php echo $councillorship_add->CouncillorTypeType->caption() ?><?php echo $councillorship_add->CouncillorTypeType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillorship_add->RightColumnClass ?>"><div <?php echo $councillorship_add->CouncillorTypeType->cellAttributes() ?>>
<span id="el_councillorship_CouncillorTypeType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_CouncillorTypeType" data-value-separator="<?php echo $councillorship_add->CouncillorTypeType->displayValueSeparatorAttribute() ?>" id="x_CouncillorTypeType" name="x_CouncillorTypeType"<?php echo $councillorship_add->CouncillorTypeType->editAttributes() ?>>
			<?php echo $councillorship_add->CouncillorTypeType->selectOptionListHtml("x_CouncillorTypeType") ?>
		</select>
</div>
<?php echo $councillorship_add->CouncillorTypeType->Lookup->getParamTag($councillorship_add, "p_x_CouncillorTypeType") ?>
</span>
<?php echo $councillorship_add->CouncillorTypeType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillorship_add->ExitReason->Visible) { // ExitReason ?>
	<div id="r_ExitReason" class="form-group row">
		<label id="elh_councillorship_ExitReason" for="x_ExitReason" class="<?php echo $councillorship_add->LeftColumnClass ?>"><?php echo $councillorship_add->ExitReason->caption() ?><?php echo $councillorship_add->ExitReason->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillorship_add->RightColumnClass ?>"><div <?php echo $councillorship_add->ExitReason->cellAttributes() ?>>
<span id="el_councillorship_ExitReason">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_ExitReason" data-value-separator="<?php echo $councillorship_add->ExitReason->displayValueSeparatorAttribute() ?>" id="x_ExitReason" name="x_ExitReason"<?php echo $councillorship_add->ExitReason->editAttributes() ?>>
			<?php echo $councillorship_add->ExitReason->selectOptionListHtml("x_ExitReason") ?>
		</select>
</div>
<?php echo $councillorship_add->ExitReason->Lookup->getParamTag($councillorship_add, "p_x_ExitReason") ?>
</span>
<?php echo $councillorship_add->ExitReason->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillorship_add->CouncillorPhoto->Visible) { // CouncillorPhoto ?>
	<div id="r_CouncillorPhoto" class="form-group row">
		<label id="elh_councillorship_CouncillorPhoto" class="<?php echo $councillorship_add->LeftColumnClass ?>"><?php echo $councillorship_add->CouncillorPhoto->caption() ?><?php echo $councillorship_add->CouncillorPhoto->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillorship_add->RightColumnClass ?>"><div <?php echo $councillorship_add->CouncillorPhoto->cellAttributes() ?>>
<span id="el_councillorship_CouncillorPhoto">
<div id="fd_x_CouncillorPhoto">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $councillorship_add->CouncillorPhoto->title() ?>" data-table="councillorship" data-field="x_CouncillorPhoto" name="x_CouncillorPhoto" id="x_CouncillorPhoto" lang="<?php echo CurrentLanguageID() ?>"<?php echo $councillorship_add->CouncillorPhoto->editAttributes() ?><?php if ($councillorship_add->CouncillorPhoto->ReadOnly || $councillorship_add->CouncillorPhoto->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_CouncillorPhoto"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_CouncillorPhoto" id= "fn_x_CouncillorPhoto" value="<?php echo $councillorship_add->CouncillorPhoto->Upload->FileName ?>">
<input type="hidden" name="fa_x_CouncillorPhoto" id= "fa_x_CouncillorPhoto" value="0">
<input type="hidden" name="fs_x_CouncillorPhoto" id= "fs_x_CouncillorPhoto" value="0">
<input type="hidden" name="fx_x_CouncillorPhoto" id= "fx_x_CouncillorPhoto" value="<?php echo $councillorship_add->CouncillorPhoto->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_CouncillorPhoto" id= "fm_x_CouncillorPhoto" value="<?php echo $councillorship_add->CouncillorPhoto->UploadMaxFileSize ?>">
</div>
<table id="ft_x_CouncillorPhoto" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $councillorship_add->CouncillorPhoto->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("councillor_allowance", explode(",", $councillorship->getCurrentDetailTable())) && $councillor_allowance->DetailAdd) {
?>
<?php if ($councillorship->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("councillor_allowance", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "councillor_allowancegrid.php" ?>
<?php } ?>
<?php
	if (in_array("committee_appointed", explode(",", $councillorship->getCurrentDetailTable())) && $committee_appointed->DetailAdd) {
?>
<?php if ($councillorship->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("committee_appointed", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "committee_appointedgrid.php" ?>
<?php } ?>
<?php if (!$councillorship_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $councillorship_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $councillorship_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$councillorship_add->showPageFooter();
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
$councillorship_add->terminate();
?>