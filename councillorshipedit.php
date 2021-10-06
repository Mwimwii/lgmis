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
$councillorship_edit = new councillorship_edit();

// Run the page
$councillorship_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$councillorship_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcouncillorshipedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fcouncillorshipedit = currentForm = new ew.Form("fcouncillorshipedit", "edit");

	// Validate form
	fcouncillorshipedit.validate = function() {
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
			<?php if ($councillorship_edit->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_edit->EmployeeID->caption(), $councillorship_edit->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($councillorship_edit->EmployeeID->errorMessage()) ?>");
			<?php if ($councillorship_edit->ProvinceCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_edit->ProvinceCode->caption(), $councillorship_edit->ProvinceCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($councillorship_edit->ProvinceCode->errorMessage()) ?>");
			<?php if ($councillorship_edit->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_edit->LACode->caption(), $councillorship_edit->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillorship_edit->PoliticalParty->Required) { ?>
				elm = this.getElements("x" + infix + "_PoliticalParty");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_edit->PoliticalParty->caption(), $councillorship_edit->PoliticalParty->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillorship_edit->Occupation->Required) { ?>
				elm = this.getElements("x" + infix + "_Occupation");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_edit->Occupation->caption(), $councillorship_edit->Occupation->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillorship_edit->PositionInCouncil->Required) { ?>
				elm = this.getElements("x" + infix + "_PositionInCouncil");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_edit->PositionInCouncil->caption(), $councillorship_edit->PositionInCouncil->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillorship_edit->Committee->Required) { ?>
				elm = this.getElements("x" + infix + "_Committee");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_edit->Committee->caption(), $councillorship_edit->Committee->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillorship_edit->CommitteeRole->Required) { ?>
				elm = this.getElements("x" + infix + "_CommitteeRole");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_edit->CommitteeRole->caption(), $councillorship_edit->CommitteeRole->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillorship_edit->CouncilTerm->Required) { ?>
				elm = this.getElements("x" + infix + "_CouncilTerm");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_edit->CouncilTerm->caption(), $councillorship_edit->CouncilTerm->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillorship_edit->DateOfExit->Required) { ?>
				elm = this.getElements("x" + infix + "_DateOfExit");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_edit->DateOfExit->caption(), $councillorship_edit->DateOfExit->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateOfExit");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($councillorship_edit->DateOfExit->errorMessage()) ?>");
			<?php if ($councillorship_edit->Allowance->Required) { ?>
				elm = this.getElements("x" + infix + "_Allowance");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_edit->Allowance->caption(), $councillorship_edit->Allowance->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillorship_edit->CouncillorTypeType->Required) { ?>
				elm = this.getElements("x" + infix + "_CouncillorTypeType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_edit->CouncillorTypeType->caption(), $councillorship_edit->CouncillorTypeType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillorship_edit->ExitReason->Required) { ?>
				elm = this.getElements("x" + infix + "_ExitReason");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_edit->ExitReason->caption(), $councillorship_edit->ExitReason->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillorship_edit->CouncillorPhoto->Required) { ?>
				felm = this.getElements("x" + infix + "_CouncillorPhoto");
				elm = this.getElements("fn_x" + infix + "_CouncillorPhoto");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $councillorship_edit->CouncillorPhoto->caption(), $councillorship_edit->CouncillorPhoto->RequiredErrorMessage)) ?>");
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
	fcouncillorshipedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcouncillorshipedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fcouncillorshipedit.lists["x_EmployeeID"] = <?php echo $councillorship_edit->EmployeeID->Lookup->toClientList($councillorship_edit) ?>;
	fcouncillorshipedit.lists["x_EmployeeID"].options = <?php echo JsonEncode($councillorship_edit->EmployeeID->lookupOptions()) ?>;
	fcouncillorshipedit.autoSuggests["x_EmployeeID"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fcouncillorshipedit.lists["x_ProvinceCode"] = <?php echo $councillorship_edit->ProvinceCode->Lookup->toClientList($councillorship_edit) ?>;
	fcouncillorshipedit.lists["x_ProvinceCode"].options = <?php echo JsonEncode($councillorship_edit->ProvinceCode->lookupOptions()) ?>;
	fcouncillorshipedit.autoSuggests["x_ProvinceCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fcouncillorshipedit.lists["x_LACode"] = <?php echo $councillorship_edit->LACode->Lookup->toClientList($councillorship_edit) ?>;
	fcouncillorshipedit.lists["x_LACode"].options = <?php echo JsonEncode($councillorship_edit->LACode->lookupOptions()) ?>;
	fcouncillorshipedit.lists["x_PoliticalParty"] = <?php echo $councillorship_edit->PoliticalParty->Lookup->toClientList($councillorship_edit) ?>;
	fcouncillorshipedit.lists["x_PoliticalParty"].options = <?php echo JsonEncode($councillorship_edit->PoliticalParty->lookupOptions()) ?>;
	fcouncillorshipedit.lists["x_Occupation"] = <?php echo $councillorship_edit->Occupation->Lookup->toClientList($councillorship_edit) ?>;
	fcouncillorshipedit.lists["x_Occupation"].options = <?php echo JsonEncode($councillorship_edit->Occupation->lookupOptions()) ?>;
	fcouncillorshipedit.lists["x_PositionInCouncil"] = <?php echo $councillorship_edit->PositionInCouncil->Lookup->toClientList($councillorship_edit) ?>;
	fcouncillorshipedit.lists["x_PositionInCouncil"].options = <?php echo JsonEncode($councillorship_edit->PositionInCouncil->lookupOptions()) ?>;
	fcouncillorshipedit.lists["x_Committee"] = <?php echo $councillorship_edit->Committee->Lookup->toClientList($councillorship_edit) ?>;
	fcouncillorshipedit.lists["x_Committee"].options = <?php echo JsonEncode($councillorship_edit->Committee->lookupOptions()) ?>;
	fcouncillorshipedit.lists["x_CommitteeRole"] = <?php echo $councillorship_edit->CommitteeRole->Lookup->toClientList($councillorship_edit) ?>;
	fcouncillorshipedit.lists["x_CommitteeRole"].options = <?php echo JsonEncode($councillorship_edit->CommitteeRole->lookupOptions()) ?>;
	fcouncillorshipedit.lists["x_CouncilTerm"] = <?php echo $councillorship_edit->CouncilTerm->Lookup->toClientList($councillorship_edit) ?>;
	fcouncillorshipedit.lists["x_CouncilTerm"].options = <?php echo JsonEncode($councillorship_edit->CouncilTerm->lookupOptions()) ?>;
	fcouncillorshipedit.lists["x_CouncillorTypeType"] = <?php echo $councillorship_edit->CouncillorTypeType->Lookup->toClientList($councillorship_edit) ?>;
	fcouncillorshipedit.lists["x_CouncillorTypeType"].options = <?php echo JsonEncode($councillorship_edit->CouncillorTypeType->lookupOptions()) ?>;
	fcouncillorshipedit.lists["x_ExitReason"] = <?php echo $councillorship_edit->ExitReason->Lookup->toClientList($councillorship_edit) ?>;
	fcouncillorshipedit.lists["x_ExitReason"].options = <?php echo JsonEncode($councillorship_edit->ExitReason->lookupOptions()) ?>;
	loadjs.done("fcouncillorshipedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $councillorship_edit->showPageHeader(); ?>
<?php
$councillorship_edit->showMessage();
?>
<?php if (!$councillorship_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $councillorship_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fcouncillorshipedit" id="fcouncillorshipedit" class="<?php echo $councillorship_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="councillorship">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$councillorship_edit->IsModal ?>">
<?php if ($councillorship->getCurrentMasterTable() == "councillor") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="councillor">
<input type="hidden" name="fk_EmployeeID" value="<?php echo HtmlEncode($councillorship_edit->EmployeeID->getSessionValue()) ?>">
<?php } ?>
<?php if ($councillorship->getCurrentMasterTable() == "local_authority") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="local_authority">
<input type="hidden" name="fk_LACode" value="<?php echo HtmlEncode($councillorship_edit->LACode->getSessionValue()) ?>">
<input type="hidden" name="fk_ProvinceCode" value="<?php echo HtmlEncode($councillorship_edit->ProvinceCode->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($councillorship_edit->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label id="elh_councillorship_EmployeeID" class="<?php echo $councillorship_edit->LeftColumnClass ?>"><?php echo $councillorship_edit->EmployeeID->caption() ?><?php echo $councillorship_edit->EmployeeID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillorship_edit->RightColumnClass ?>"><div <?php echo $councillorship_edit->EmployeeID->cellAttributes() ?>>
<?php if ($councillorship_edit->EmployeeID->getSessionValue() != "") { ?>

<span id="el_councillorship_EmployeeID">
<span<?php echo $councillorship_edit->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($councillorship_edit->EmployeeID->EditValue)) ?>"></span>
</span>

<input type="hidden" id="x_EmployeeID" name="x_EmployeeID" value="<?php echo HtmlEncode($councillorship_edit->EmployeeID->CurrentValue) ?>">
<?php } else { ?>

<?php
$onchange = $councillorship_edit->EmployeeID->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$councillorship_edit->EmployeeID->EditAttrs["onchange"] = "";
?>
<span id="as_x_EmployeeID">
	<input type="text" class="form-control" name="sv_x_EmployeeID" id="sv_x_EmployeeID" value="<?php echo RemoveHtml($councillorship_edit->EmployeeID->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($councillorship_edit->EmployeeID->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($councillorship_edit->EmployeeID->getPlaceHolder()) ?>"<?php echo $councillorship_edit->EmployeeID->editAttributes() ?>>
</span>
<input type="hidden" data-table="councillorship" data-field="x_EmployeeID" data-value-separator="<?php echo $councillorship_edit->EmployeeID->displayValueSeparatorAttribute() ?>" name="x_EmployeeID" id="x_EmployeeID" value="<?php echo HtmlEncode($councillorship_edit->EmployeeID->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fcouncillorshipedit"], function() {
	fcouncillorshipedit.createAutoSuggest({"id":"x_EmployeeID","forceSelect":false});
});
</script>
<?php echo $councillorship_edit->EmployeeID->Lookup->getParamTag($councillorship_edit, "p_x_EmployeeID") ?>

<?php } ?>

<input type="hidden" data-table="councillorship" data-field="x_EmployeeID" name="o_EmployeeID" id="o_EmployeeID" value="<?php echo HtmlEncode($councillorship_edit->EmployeeID->OldValue != null ? $councillorship_edit->EmployeeID->OldValue : $councillorship_edit->EmployeeID->CurrentValue) ?>">
<?php echo $councillorship_edit->EmployeeID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillorship_edit->ProvinceCode->Visible) { // ProvinceCode ?>
	<div id="r_ProvinceCode" class="form-group row">
		<label id="elh_councillorship_ProvinceCode" class="<?php echo $councillorship_edit->LeftColumnClass ?>"><?php echo $councillorship_edit->ProvinceCode->caption() ?><?php echo $councillorship_edit->ProvinceCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillorship_edit->RightColumnClass ?>"><div <?php echo $councillorship_edit->ProvinceCode->cellAttributes() ?>>
<?php if ($councillorship_edit->ProvinceCode->getSessionValue() != "") { ?>
<span id="el_councillorship_ProvinceCode">
<span<?php echo $councillorship_edit->ProvinceCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($councillorship_edit->ProvinceCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_ProvinceCode" name="x_ProvinceCode" value="<?php echo HtmlEncode($councillorship_edit->ProvinceCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_councillorship_ProvinceCode">
<?php
$onchange = $councillorship_edit->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$councillorship_edit->ProvinceCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_ProvinceCode">
	<input type="text" class="form-control" name="sv_x_ProvinceCode" id="sv_x_ProvinceCode" value="<?php echo RemoveHtml($councillorship_edit->ProvinceCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($councillorship_edit->ProvinceCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($councillorship_edit->ProvinceCode->getPlaceHolder()) ?>"<?php echo $councillorship_edit->ProvinceCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="councillorship" data-field="x_ProvinceCode" data-value-separator="<?php echo $councillorship_edit->ProvinceCode->displayValueSeparatorAttribute() ?>" name="x_ProvinceCode" id="x_ProvinceCode" value="<?php echo HtmlEncode($councillorship_edit->ProvinceCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fcouncillorshipedit"], function() {
	fcouncillorshipedit.createAutoSuggest({"id":"x_ProvinceCode","forceSelect":false});
});
</script>
<?php echo $councillorship_edit->ProvinceCode->Lookup->getParamTag($councillorship_edit, "p_x_ProvinceCode") ?>
</span>
<?php } ?>
<?php echo $councillorship_edit->ProvinceCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillorship_edit->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label id="elh_councillorship_LACode" for="x_LACode" class="<?php echo $councillorship_edit->LeftColumnClass ?>"><?php echo $councillorship_edit->LACode->caption() ?><?php echo $councillorship_edit->LACode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillorship_edit->RightColumnClass ?>"><div <?php echo $councillorship_edit->LACode->cellAttributes() ?>>
<?php if ($councillorship_edit->LACode->getSessionValue() != "") { ?>

<span id="el_councillorship_LACode">
<span<?php echo $councillorship_edit->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($councillorship_edit->LACode->EditValue)) ?>"></span>
</span>

<input type="hidden" id="x_LACode" name="x_LACode" value="<?php echo HtmlEncode($councillorship_edit->LACode->CurrentValue) ?>">
<?php } else { ?>

<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_LACode" data-value-separator="<?php echo $councillorship_edit->LACode->displayValueSeparatorAttribute() ?>" id="x_LACode" name="x_LACode"<?php echo $councillorship_edit->LACode->editAttributes() ?>>
			<?php echo $councillorship_edit->LACode->selectOptionListHtml("x_LACode") ?>
		</select>
</div>
<?php echo $councillorship_edit->LACode->Lookup->getParamTag($councillorship_edit, "p_x_LACode") ?>

<?php } ?>

<input type="hidden" data-table="councillorship" data-field="x_LACode" name="o_LACode" id="o_LACode" value="<?php echo HtmlEncode($councillorship_edit->LACode->OldValue != null ? $councillorship_edit->LACode->OldValue : $councillorship_edit->LACode->CurrentValue) ?>">
<?php echo $councillorship_edit->LACode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillorship_edit->PoliticalParty->Visible) { // PoliticalParty ?>
	<div id="r_PoliticalParty" class="form-group row">
		<label id="elh_councillorship_PoliticalParty" for="x_PoliticalParty" class="<?php echo $councillorship_edit->LeftColumnClass ?>"><?php echo $councillorship_edit->PoliticalParty->caption() ?><?php echo $councillorship_edit->PoliticalParty->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillorship_edit->RightColumnClass ?>"><div <?php echo $councillorship_edit->PoliticalParty->cellAttributes() ?>>
<span id="el_councillorship_PoliticalParty">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_PoliticalParty" data-value-separator="<?php echo $councillorship_edit->PoliticalParty->displayValueSeparatorAttribute() ?>" id="x_PoliticalParty" name="x_PoliticalParty"<?php echo $councillorship_edit->PoliticalParty->editAttributes() ?>>
			<?php echo $councillorship_edit->PoliticalParty->selectOptionListHtml("x_PoliticalParty") ?>
		</select>
</div>
<?php echo $councillorship_edit->PoliticalParty->Lookup->getParamTag($councillorship_edit, "p_x_PoliticalParty") ?>
</span>
<?php echo $councillorship_edit->PoliticalParty->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillorship_edit->Occupation->Visible) { // Occupation ?>
	<div id="r_Occupation" class="form-group row">
		<label id="elh_councillorship_Occupation" for="x_Occupation" class="<?php echo $councillorship_edit->LeftColumnClass ?>"><?php echo $councillorship_edit->Occupation->caption() ?><?php echo $councillorship_edit->Occupation->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillorship_edit->RightColumnClass ?>"><div <?php echo $councillorship_edit->Occupation->cellAttributes() ?>>
<span id="el_councillorship_Occupation">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_Occupation" data-value-separator="<?php echo $councillorship_edit->Occupation->displayValueSeparatorAttribute() ?>" id="x_Occupation" name="x_Occupation"<?php echo $councillorship_edit->Occupation->editAttributes() ?>>
			<?php echo $councillorship_edit->Occupation->selectOptionListHtml("x_Occupation") ?>
		</select>
</div>
<?php echo $councillorship_edit->Occupation->Lookup->getParamTag($councillorship_edit, "p_x_Occupation") ?>
</span>
<?php echo $councillorship_edit->Occupation->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillorship_edit->PositionInCouncil->Visible) { // PositionInCouncil ?>
	<div id="r_PositionInCouncil" class="form-group row">
		<label id="elh_councillorship_PositionInCouncil" for="x_PositionInCouncil" class="<?php echo $councillorship_edit->LeftColumnClass ?>"><?php echo $councillorship_edit->PositionInCouncil->caption() ?><?php echo $councillorship_edit->PositionInCouncil->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillorship_edit->RightColumnClass ?>"><div <?php echo $councillorship_edit->PositionInCouncil->cellAttributes() ?>>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_PositionInCouncil" data-value-separator="<?php echo $councillorship_edit->PositionInCouncil->displayValueSeparatorAttribute() ?>" id="x_PositionInCouncil" name="x_PositionInCouncil"<?php echo $councillorship_edit->PositionInCouncil->editAttributes() ?>>
			<?php echo $councillorship_edit->PositionInCouncil->selectOptionListHtml("x_PositionInCouncil") ?>
		</select>
</div>
<?php echo $councillorship_edit->PositionInCouncil->Lookup->getParamTag($councillorship_edit, "p_x_PositionInCouncil") ?>
<input type="hidden" data-table="councillorship" data-field="x_PositionInCouncil" name="o_PositionInCouncil" id="o_PositionInCouncil" value="<?php echo HtmlEncode($councillorship_edit->PositionInCouncil->OldValue != null ? $councillorship_edit->PositionInCouncil->OldValue : $councillorship_edit->PositionInCouncil->CurrentValue) ?>">
<?php echo $councillorship_edit->PositionInCouncil->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillorship_edit->Committee->Visible) { // Committee ?>
	<div id="r_Committee" class="form-group row">
		<label id="elh_councillorship_Committee" for="x_Committee" class="<?php echo $councillorship_edit->LeftColumnClass ?>"><?php echo $councillorship_edit->Committee->caption() ?><?php echo $councillorship_edit->Committee->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillorship_edit->RightColumnClass ?>"><div <?php echo $councillorship_edit->Committee->cellAttributes() ?>>
<span id="el_councillorship_Committee">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_Committee" data-value-separator="<?php echo $councillorship_edit->Committee->displayValueSeparatorAttribute() ?>" id="x_Committee" name="x_Committee"<?php echo $councillorship_edit->Committee->editAttributes() ?>>
			<?php echo $councillorship_edit->Committee->selectOptionListHtml("x_Committee") ?>
		</select>
</div>
<?php echo $councillorship_edit->Committee->Lookup->getParamTag($councillorship_edit, "p_x_Committee") ?>
</span>
<?php echo $councillorship_edit->Committee->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillorship_edit->CommitteeRole->Visible) { // CommitteeRole ?>
	<div id="r_CommitteeRole" class="form-group row">
		<label id="elh_councillorship_CommitteeRole" for="x_CommitteeRole" class="<?php echo $councillorship_edit->LeftColumnClass ?>"><?php echo $councillorship_edit->CommitteeRole->caption() ?><?php echo $councillorship_edit->CommitteeRole->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillorship_edit->RightColumnClass ?>"><div <?php echo $councillorship_edit->CommitteeRole->cellAttributes() ?>>
<span id="el_councillorship_CommitteeRole">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_CommitteeRole" data-value-separator="<?php echo $councillorship_edit->CommitteeRole->displayValueSeparatorAttribute() ?>" id="x_CommitteeRole" name="x_CommitteeRole"<?php echo $councillorship_edit->CommitteeRole->editAttributes() ?>>
			<?php echo $councillorship_edit->CommitteeRole->selectOptionListHtml("x_CommitteeRole") ?>
		</select>
</div>
<?php echo $councillorship_edit->CommitteeRole->Lookup->getParamTag($councillorship_edit, "p_x_CommitteeRole") ?>
</span>
<?php echo $councillorship_edit->CommitteeRole->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillorship_edit->CouncilTerm->Visible) { // CouncilTerm ?>
	<div id="r_CouncilTerm" class="form-group row">
		<label id="elh_councillorship_CouncilTerm" for="x_CouncilTerm" class="<?php echo $councillorship_edit->LeftColumnClass ?>"><?php echo $councillorship_edit->CouncilTerm->caption() ?><?php echo $councillorship_edit->CouncilTerm->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillorship_edit->RightColumnClass ?>"><div <?php echo $councillorship_edit->CouncilTerm->cellAttributes() ?>>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_CouncilTerm" data-value-separator="<?php echo $councillorship_edit->CouncilTerm->displayValueSeparatorAttribute() ?>" id="x_CouncilTerm" name="x_CouncilTerm"<?php echo $councillorship_edit->CouncilTerm->editAttributes() ?>>
			<?php echo $councillorship_edit->CouncilTerm->selectOptionListHtml("x_CouncilTerm") ?>
		</select>
</div>
<?php echo $councillorship_edit->CouncilTerm->Lookup->getParamTag($councillorship_edit, "p_x_CouncilTerm") ?>
<input type="hidden" data-table="councillorship" data-field="x_CouncilTerm" name="o_CouncilTerm" id="o_CouncilTerm" value="<?php echo HtmlEncode($councillorship_edit->CouncilTerm->OldValue != null ? $councillorship_edit->CouncilTerm->OldValue : $councillorship_edit->CouncilTerm->CurrentValue) ?>">
<?php echo $councillorship_edit->CouncilTerm->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillorship_edit->DateOfExit->Visible) { // DateOfExit ?>
	<div id="r_DateOfExit" class="form-group row">
		<label id="elh_councillorship_DateOfExit" for="x_DateOfExit" class="<?php echo $councillorship_edit->LeftColumnClass ?>"><?php echo $councillorship_edit->DateOfExit->caption() ?><?php echo $councillorship_edit->DateOfExit->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillorship_edit->RightColumnClass ?>"><div <?php echo $councillorship_edit->DateOfExit->cellAttributes() ?>>
<span id="el_councillorship_DateOfExit">
<input type="text" data-table="councillorship" data-field="x_DateOfExit" name="x_DateOfExit" id="x_DateOfExit" placeholder="<?php echo HtmlEncode($councillorship_edit->DateOfExit->getPlaceHolder()) ?>" value="<?php echo $councillorship_edit->DateOfExit->EditValue ?>"<?php echo $councillorship_edit->DateOfExit->editAttributes() ?>>
<?php if (!$councillorship_edit->DateOfExit->ReadOnly && !$councillorship_edit->DateOfExit->Disabled && !isset($councillorship_edit->DateOfExit->EditAttrs["readonly"]) && !isset($councillorship_edit->DateOfExit->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcouncillorshipedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fcouncillorshipedit", "x_DateOfExit", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $councillorship_edit->DateOfExit->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillorship_edit->Allowance->Visible) { // Allowance ?>
	<div id="r_Allowance" class="form-group row">
		<label id="elh_councillorship_Allowance" for="x_Allowance" class="<?php echo $councillorship_edit->LeftColumnClass ?>"><?php echo $councillorship_edit->Allowance->caption() ?><?php echo $councillorship_edit->Allowance->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillorship_edit->RightColumnClass ?>"><div <?php echo $councillorship_edit->Allowance->cellAttributes() ?>>
<span id="el_councillorship_Allowance">
<input type="text" data-table="councillorship" data-field="x_Allowance" name="x_Allowance" id="x_Allowance" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($councillorship_edit->Allowance->getPlaceHolder()) ?>" value="<?php echo $councillorship_edit->Allowance->EditValue ?>"<?php echo $councillorship_edit->Allowance->editAttributes() ?>>
</span>
<?php echo $councillorship_edit->Allowance->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillorship_edit->CouncillorTypeType->Visible) { // CouncillorTypeType ?>
	<div id="r_CouncillorTypeType" class="form-group row">
		<label id="elh_councillorship_CouncillorTypeType" for="x_CouncillorTypeType" class="<?php echo $councillorship_edit->LeftColumnClass ?>"><?php echo $councillorship_edit->CouncillorTypeType->caption() ?><?php echo $councillorship_edit->CouncillorTypeType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillorship_edit->RightColumnClass ?>"><div <?php echo $councillorship_edit->CouncillorTypeType->cellAttributes() ?>>
<span id="el_councillorship_CouncillorTypeType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_CouncillorTypeType" data-value-separator="<?php echo $councillorship_edit->CouncillorTypeType->displayValueSeparatorAttribute() ?>" id="x_CouncillorTypeType" name="x_CouncillorTypeType"<?php echo $councillorship_edit->CouncillorTypeType->editAttributes() ?>>
			<?php echo $councillorship_edit->CouncillorTypeType->selectOptionListHtml("x_CouncillorTypeType") ?>
		</select>
</div>
<?php echo $councillorship_edit->CouncillorTypeType->Lookup->getParamTag($councillorship_edit, "p_x_CouncillorTypeType") ?>
</span>
<?php echo $councillorship_edit->CouncillorTypeType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillorship_edit->ExitReason->Visible) { // ExitReason ?>
	<div id="r_ExitReason" class="form-group row">
		<label id="elh_councillorship_ExitReason" for="x_ExitReason" class="<?php echo $councillorship_edit->LeftColumnClass ?>"><?php echo $councillorship_edit->ExitReason->caption() ?><?php echo $councillorship_edit->ExitReason->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillorship_edit->RightColumnClass ?>"><div <?php echo $councillorship_edit->ExitReason->cellAttributes() ?>>
<span id="el_councillorship_ExitReason">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_ExitReason" data-value-separator="<?php echo $councillorship_edit->ExitReason->displayValueSeparatorAttribute() ?>" id="x_ExitReason" name="x_ExitReason"<?php echo $councillorship_edit->ExitReason->editAttributes() ?>>
			<?php echo $councillorship_edit->ExitReason->selectOptionListHtml("x_ExitReason") ?>
		</select>
</div>
<?php echo $councillorship_edit->ExitReason->Lookup->getParamTag($councillorship_edit, "p_x_ExitReason") ?>
</span>
<?php echo $councillorship_edit->ExitReason->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillorship_edit->CouncillorPhoto->Visible) { // CouncillorPhoto ?>
	<div id="r_CouncillorPhoto" class="form-group row">
		<label id="elh_councillorship_CouncillorPhoto" class="<?php echo $councillorship_edit->LeftColumnClass ?>"><?php echo $councillorship_edit->CouncillorPhoto->caption() ?><?php echo $councillorship_edit->CouncillorPhoto->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillorship_edit->RightColumnClass ?>"><div <?php echo $councillorship_edit->CouncillorPhoto->cellAttributes() ?>>
<span id="el_councillorship_CouncillorPhoto">
<div id="fd_x_CouncillorPhoto">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $councillorship_edit->CouncillorPhoto->title() ?>" data-table="councillorship" data-field="x_CouncillorPhoto" name="x_CouncillorPhoto" id="x_CouncillorPhoto" lang="<?php echo CurrentLanguageID() ?>"<?php echo $councillorship_edit->CouncillorPhoto->editAttributes() ?><?php if ($councillorship_edit->CouncillorPhoto->ReadOnly || $councillorship_edit->CouncillorPhoto->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_CouncillorPhoto"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_CouncillorPhoto" id= "fn_x_CouncillorPhoto" value="<?php echo $councillorship_edit->CouncillorPhoto->Upload->FileName ?>">
<input type="hidden" name="fa_x_CouncillorPhoto" id= "fa_x_CouncillorPhoto" value="<?php echo (Post("fa_x_CouncillorPhoto") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_CouncillorPhoto" id= "fs_x_CouncillorPhoto" value="0">
<input type="hidden" name="fx_x_CouncillorPhoto" id= "fx_x_CouncillorPhoto" value="<?php echo $councillorship_edit->CouncillorPhoto->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_CouncillorPhoto" id= "fm_x_CouncillorPhoto" value="<?php echo $councillorship_edit->CouncillorPhoto->UploadMaxFileSize ?>">
</div>
<table id="ft_x_CouncillorPhoto" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $councillorship_edit->CouncillorPhoto->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("councillor_allowance", explode(",", $councillorship->getCurrentDetailTable())) && $councillor_allowance->DetailEdit) {
?>
<?php if ($councillorship->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("councillor_allowance", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "councillor_allowancegrid.php" ?>
<?php } ?>
<?php
	if (in_array("committee_appointed", explode(",", $councillorship->getCurrentDetailTable())) && $committee_appointed->DetailEdit) {
?>
<?php if ($councillorship->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("committee_appointed", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "committee_appointedgrid.php" ?>
<?php } ?>
<?php if (!$councillorship_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $councillorship_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $councillorship_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$councillorship_edit->IsModal) { ?>
<?php echo $councillorship_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$councillorship_edit->showPageFooter();
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
$councillorship_edit->terminate();
?>