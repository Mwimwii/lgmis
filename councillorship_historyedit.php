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
$councillorship_history_edit = new councillorship_history_edit();

// Run the page
$councillorship_history_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$councillorship_history_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcouncillorship_historyedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fcouncillorship_historyedit = currentForm = new ew.Form("fcouncillorship_historyedit", "edit");

	// Validate form
	fcouncillorship_historyedit.validate = function() {
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
			<?php if ($councillorship_history_edit->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_history_edit->EmployeeID->caption(), $councillorship_history_edit->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($councillorship_history_edit->EmployeeID->errorMessage()) ?>");
			<?php if ($councillorship_history_edit->ProvinceCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_history_edit->ProvinceCode->caption(), $councillorship_history_edit->ProvinceCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($councillorship_history_edit->ProvinceCode->errorMessage()) ?>");
			<?php if ($councillorship_history_edit->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_history_edit->LACode->caption(), $councillorship_history_edit->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillorship_history_edit->PoliticalParty->Required) { ?>
				elm = this.getElements("x" + infix + "_PoliticalParty");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_history_edit->PoliticalParty->caption(), $councillorship_history_edit->PoliticalParty->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PoliticalParty");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($councillorship_history_edit->PoliticalParty->errorMessage()) ?>");
			<?php if ($councillorship_history_edit->Occupation->Required) { ?>
				elm = this.getElements("x" + infix + "_Occupation");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_history_edit->Occupation->caption(), $councillorship_history_edit->Occupation->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Occupation");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($councillorship_history_edit->Occupation->errorMessage()) ?>");
			<?php if ($councillorship_history_edit->PositionInCouncil->Required) { ?>
				elm = this.getElements("x" + infix + "_PositionInCouncil");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_history_edit->PositionInCouncil->caption(), $councillorship_history_edit->PositionInCouncil->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PositionInCouncil");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($councillorship_history_edit->PositionInCouncil->errorMessage()) ?>");
			<?php if ($councillorship_history_edit->Committee->Required) { ?>
				elm = this.getElements("x" + infix + "_Committee");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_history_edit->Committee->caption(), $councillorship_history_edit->Committee->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillorship_history_edit->CouncilTerm->Required) { ?>
				elm = this.getElements("x" + infix + "_CouncilTerm");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_history_edit->CouncilTerm->caption(), $councillorship_history_edit->CouncilTerm->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_CouncilTerm");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($councillorship_history_edit->CouncilTerm->errorMessage()) ?>");
			<?php if ($councillorship_history_edit->DateOfExit->Required) { ?>
				elm = this.getElements("x" + infix + "_DateOfExit");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_history_edit->DateOfExit->caption(), $councillorship_history_edit->DateOfExit->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateOfExit");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($councillorship_history_edit->DateOfExit->errorMessage()) ?>");
			<?php if ($councillorship_history_edit->Allowance->Required) { ?>
				elm = this.getElements("x" + infix + "_Allowance");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_history_edit->Allowance->caption(), $councillorship_history_edit->Allowance->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillorship_history_edit->CouncillorTypeType->Required) { ?>
				elm = this.getElements("x" + infix + "_CouncillorTypeType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_history_edit->CouncillorTypeType->caption(), $councillorship_history_edit->CouncillorTypeType->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_CouncillorTypeType");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($councillorship_history_edit->CouncillorTypeType->errorMessage()) ?>");
			<?php if ($councillorship_history_edit->CouncillorshipStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_CouncillorshipStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_history_edit->CouncillorshipStatus->caption(), $councillorship_history_edit->CouncillorshipStatus->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_CouncillorshipStatus");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($councillorship_history_edit->CouncillorshipStatus->errorMessage()) ?>");
			<?php if ($councillorship_history_edit->ExitReason->Required) { ?>
				elm = this.getElements("x" + infix + "_ExitReason");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_history_edit->ExitReason->caption(), $councillorship_history_edit->ExitReason->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ExitReason");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($councillorship_history_edit->ExitReason->errorMessage()) ?>");
			<?php if ($councillorship_history_edit->RetirementType->Required) { ?>
				elm = this.getElements("x" + infix + "_RetirementType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_history_edit->RetirementType->caption(), $councillorship_history_edit->RetirementType->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_RetirementType");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($councillorship_history_edit->RetirementType->errorMessage()) ?>");

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
	fcouncillorship_historyedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcouncillorship_historyedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fcouncillorship_historyedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $councillorship_history_edit->showPageHeader(); ?>
<?php
$councillorship_history_edit->showMessage();
?>
<?php if (!$councillorship_history_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $councillorship_history_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fcouncillorship_historyedit" id="fcouncillorship_historyedit" class="<?php echo $councillorship_history_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="councillorship_history">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$councillorship_history_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($councillorship_history_edit->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label id="elh_councillorship_history_EmployeeID" for="x_EmployeeID" class="<?php echo $councillorship_history_edit->LeftColumnClass ?>"><?php echo $councillorship_history_edit->EmployeeID->caption() ?><?php echo $councillorship_history_edit->EmployeeID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillorship_history_edit->RightColumnClass ?>"><div <?php echo $councillorship_history_edit->EmployeeID->cellAttributes() ?>>
<input type="text" data-table="councillorship_history" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($councillorship_history_edit->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $councillorship_history_edit->EmployeeID->EditValue ?>"<?php echo $councillorship_history_edit->EmployeeID->editAttributes() ?>>
<input type="hidden" data-table="councillorship_history" data-field="x_EmployeeID" name="o_EmployeeID" id="o_EmployeeID" value="<?php echo HtmlEncode($councillorship_history_edit->EmployeeID->OldValue != null ? $councillorship_history_edit->EmployeeID->OldValue : $councillorship_history_edit->EmployeeID->CurrentValue) ?>">
<?php echo $councillorship_history_edit->EmployeeID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillorship_history_edit->ProvinceCode->Visible) { // ProvinceCode ?>
	<div id="r_ProvinceCode" class="form-group row">
		<label id="elh_councillorship_history_ProvinceCode" for="x_ProvinceCode" class="<?php echo $councillorship_history_edit->LeftColumnClass ?>"><?php echo $councillorship_history_edit->ProvinceCode->caption() ?><?php echo $councillorship_history_edit->ProvinceCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillorship_history_edit->RightColumnClass ?>"><div <?php echo $councillorship_history_edit->ProvinceCode->cellAttributes() ?>>
<span id="el_councillorship_history_ProvinceCode">
<input type="text" data-table="councillorship_history" data-field="x_ProvinceCode" name="x_ProvinceCode" id="x_ProvinceCode" size="30" placeholder="<?php echo HtmlEncode($councillorship_history_edit->ProvinceCode->getPlaceHolder()) ?>" value="<?php echo $councillorship_history_edit->ProvinceCode->EditValue ?>"<?php echo $councillorship_history_edit->ProvinceCode->editAttributes() ?>>
</span>
<?php echo $councillorship_history_edit->ProvinceCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillorship_history_edit->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label id="elh_councillorship_history_LACode" for="x_LACode" class="<?php echo $councillorship_history_edit->LeftColumnClass ?>"><?php echo $councillorship_history_edit->LACode->caption() ?><?php echo $councillorship_history_edit->LACode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillorship_history_edit->RightColumnClass ?>"><div <?php echo $councillorship_history_edit->LACode->cellAttributes() ?>>
<span id="el_councillorship_history_LACode">
<input type="text" data-table="councillorship_history" data-field="x_LACode" name="x_LACode" id="x_LACode" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($councillorship_history_edit->LACode->getPlaceHolder()) ?>" value="<?php echo $councillorship_history_edit->LACode->EditValue ?>"<?php echo $councillorship_history_edit->LACode->editAttributes() ?>>
</span>
<?php echo $councillorship_history_edit->LACode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillorship_history_edit->PoliticalParty->Visible) { // PoliticalParty ?>
	<div id="r_PoliticalParty" class="form-group row">
		<label id="elh_councillorship_history_PoliticalParty" for="x_PoliticalParty" class="<?php echo $councillorship_history_edit->LeftColumnClass ?>"><?php echo $councillorship_history_edit->PoliticalParty->caption() ?><?php echo $councillorship_history_edit->PoliticalParty->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillorship_history_edit->RightColumnClass ?>"><div <?php echo $councillorship_history_edit->PoliticalParty->cellAttributes() ?>>
<span id="el_councillorship_history_PoliticalParty">
<input type="text" data-table="councillorship_history" data-field="x_PoliticalParty" name="x_PoliticalParty" id="x_PoliticalParty" size="30" placeholder="<?php echo HtmlEncode($councillorship_history_edit->PoliticalParty->getPlaceHolder()) ?>" value="<?php echo $councillorship_history_edit->PoliticalParty->EditValue ?>"<?php echo $councillorship_history_edit->PoliticalParty->editAttributes() ?>>
</span>
<?php echo $councillorship_history_edit->PoliticalParty->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillorship_history_edit->Occupation->Visible) { // Occupation ?>
	<div id="r_Occupation" class="form-group row">
		<label id="elh_councillorship_history_Occupation" for="x_Occupation" class="<?php echo $councillorship_history_edit->LeftColumnClass ?>"><?php echo $councillorship_history_edit->Occupation->caption() ?><?php echo $councillorship_history_edit->Occupation->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillorship_history_edit->RightColumnClass ?>"><div <?php echo $councillorship_history_edit->Occupation->cellAttributes() ?>>
<span id="el_councillorship_history_Occupation">
<input type="text" data-table="councillorship_history" data-field="x_Occupation" name="x_Occupation" id="x_Occupation" size="30" placeholder="<?php echo HtmlEncode($councillorship_history_edit->Occupation->getPlaceHolder()) ?>" value="<?php echo $councillorship_history_edit->Occupation->EditValue ?>"<?php echo $councillorship_history_edit->Occupation->editAttributes() ?>>
</span>
<?php echo $councillorship_history_edit->Occupation->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillorship_history_edit->PositionInCouncil->Visible) { // PositionInCouncil ?>
	<div id="r_PositionInCouncil" class="form-group row">
		<label id="elh_councillorship_history_PositionInCouncil" for="x_PositionInCouncil" class="<?php echo $councillorship_history_edit->LeftColumnClass ?>"><?php echo $councillorship_history_edit->PositionInCouncil->caption() ?><?php echo $councillorship_history_edit->PositionInCouncil->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillorship_history_edit->RightColumnClass ?>"><div <?php echo $councillorship_history_edit->PositionInCouncil->cellAttributes() ?>>
<input type="text" data-table="councillorship_history" data-field="x_PositionInCouncil" name="x_PositionInCouncil" id="x_PositionInCouncil" size="30" placeholder="<?php echo HtmlEncode($councillorship_history_edit->PositionInCouncil->getPlaceHolder()) ?>" value="<?php echo $councillorship_history_edit->PositionInCouncil->EditValue ?>"<?php echo $councillorship_history_edit->PositionInCouncil->editAttributes() ?>>
<input type="hidden" data-table="councillorship_history" data-field="x_PositionInCouncil" name="o_PositionInCouncil" id="o_PositionInCouncil" value="<?php echo HtmlEncode($councillorship_history_edit->PositionInCouncil->OldValue != null ? $councillorship_history_edit->PositionInCouncil->OldValue : $councillorship_history_edit->PositionInCouncil->CurrentValue) ?>">
<?php echo $councillorship_history_edit->PositionInCouncil->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillorship_history_edit->Committee->Visible) { // Committee ?>
	<div id="r_Committee" class="form-group row">
		<label id="elh_councillorship_history_Committee" for="x_Committee" class="<?php echo $councillorship_history_edit->LeftColumnClass ?>"><?php echo $councillorship_history_edit->Committee->caption() ?><?php echo $councillorship_history_edit->Committee->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillorship_history_edit->RightColumnClass ?>"><div <?php echo $councillorship_history_edit->Committee->cellAttributes() ?>>
<span id="el_councillorship_history_Committee">
<input type="text" data-table="councillorship_history" data-field="x_Committee" name="x_Committee" id="x_Committee" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($councillorship_history_edit->Committee->getPlaceHolder()) ?>" value="<?php echo $councillorship_history_edit->Committee->EditValue ?>"<?php echo $councillorship_history_edit->Committee->editAttributes() ?>>
</span>
<?php echo $councillorship_history_edit->Committee->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillorship_history_edit->CouncilTerm->Visible) { // CouncilTerm ?>
	<div id="r_CouncilTerm" class="form-group row">
		<label id="elh_councillorship_history_CouncilTerm" for="x_CouncilTerm" class="<?php echo $councillorship_history_edit->LeftColumnClass ?>"><?php echo $councillorship_history_edit->CouncilTerm->caption() ?><?php echo $councillorship_history_edit->CouncilTerm->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillorship_history_edit->RightColumnClass ?>"><div <?php echo $councillorship_history_edit->CouncilTerm->cellAttributes() ?>>
<span id="el_councillorship_history_CouncilTerm">
<input type="text" data-table="councillorship_history" data-field="x_CouncilTerm" name="x_CouncilTerm" id="x_CouncilTerm" size="30" placeholder="<?php echo HtmlEncode($councillorship_history_edit->CouncilTerm->getPlaceHolder()) ?>" value="<?php echo $councillorship_history_edit->CouncilTerm->EditValue ?>"<?php echo $councillorship_history_edit->CouncilTerm->editAttributes() ?>>
</span>
<?php echo $councillorship_history_edit->CouncilTerm->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillorship_history_edit->DateOfExit->Visible) { // DateOfExit ?>
	<div id="r_DateOfExit" class="form-group row">
		<label id="elh_councillorship_history_DateOfExit" for="x_DateOfExit" class="<?php echo $councillorship_history_edit->LeftColumnClass ?>"><?php echo $councillorship_history_edit->DateOfExit->caption() ?><?php echo $councillorship_history_edit->DateOfExit->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillorship_history_edit->RightColumnClass ?>"><div <?php echo $councillorship_history_edit->DateOfExit->cellAttributes() ?>>
<span id="el_councillorship_history_DateOfExit">
<input type="text" data-table="councillorship_history" data-field="x_DateOfExit" name="x_DateOfExit" id="x_DateOfExit" placeholder="<?php echo HtmlEncode($councillorship_history_edit->DateOfExit->getPlaceHolder()) ?>" value="<?php echo $councillorship_history_edit->DateOfExit->EditValue ?>"<?php echo $councillorship_history_edit->DateOfExit->editAttributes() ?>>
</span>
<?php echo $councillorship_history_edit->DateOfExit->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillorship_history_edit->Allowance->Visible) { // Allowance ?>
	<div id="r_Allowance" class="form-group row">
		<label id="elh_councillorship_history_Allowance" for="x_Allowance" class="<?php echo $councillorship_history_edit->LeftColumnClass ?>"><?php echo $councillorship_history_edit->Allowance->caption() ?><?php echo $councillorship_history_edit->Allowance->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillorship_history_edit->RightColumnClass ?>"><div <?php echo $councillorship_history_edit->Allowance->cellAttributes() ?>>
<span id="el_councillorship_history_Allowance">
<input type="text" data-table="councillorship_history" data-field="x_Allowance" name="x_Allowance" id="x_Allowance" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($councillorship_history_edit->Allowance->getPlaceHolder()) ?>" value="<?php echo $councillorship_history_edit->Allowance->EditValue ?>"<?php echo $councillorship_history_edit->Allowance->editAttributes() ?>>
</span>
<?php echo $councillorship_history_edit->Allowance->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillorship_history_edit->CouncillorTypeType->Visible) { // CouncillorTypeType ?>
	<div id="r_CouncillorTypeType" class="form-group row">
		<label id="elh_councillorship_history_CouncillorTypeType" for="x_CouncillorTypeType" class="<?php echo $councillorship_history_edit->LeftColumnClass ?>"><?php echo $councillorship_history_edit->CouncillorTypeType->caption() ?><?php echo $councillorship_history_edit->CouncillorTypeType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillorship_history_edit->RightColumnClass ?>"><div <?php echo $councillorship_history_edit->CouncillorTypeType->cellAttributes() ?>>
<span id="el_councillorship_history_CouncillorTypeType">
<input type="text" data-table="councillorship_history" data-field="x_CouncillorTypeType" name="x_CouncillorTypeType" id="x_CouncillorTypeType" size="30" placeholder="<?php echo HtmlEncode($councillorship_history_edit->CouncillorTypeType->getPlaceHolder()) ?>" value="<?php echo $councillorship_history_edit->CouncillorTypeType->EditValue ?>"<?php echo $councillorship_history_edit->CouncillorTypeType->editAttributes() ?>>
</span>
<?php echo $councillorship_history_edit->CouncillorTypeType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillorship_history_edit->CouncillorshipStatus->Visible) { // CouncillorshipStatus ?>
	<div id="r_CouncillorshipStatus" class="form-group row">
		<label id="elh_councillorship_history_CouncillorshipStatus" for="x_CouncillorshipStatus" class="<?php echo $councillorship_history_edit->LeftColumnClass ?>"><?php echo $councillorship_history_edit->CouncillorshipStatus->caption() ?><?php echo $councillorship_history_edit->CouncillorshipStatus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillorship_history_edit->RightColumnClass ?>"><div <?php echo $councillorship_history_edit->CouncillorshipStatus->cellAttributes() ?>>
<span id="el_councillorship_history_CouncillorshipStatus">
<input type="text" data-table="councillorship_history" data-field="x_CouncillorshipStatus" name="x_CouncillorshipStatus" id="x_CouncillorshipStatus" size="30" placeholder="<?php echo HtmlEncode($councillorship_history_edit->CouncillorshipStatus->getPlaceHolder()) ?>" value="<?php echo $councillorship_history_edit->CouncillorshipStatus->EditValue ?>"<?php echo $councillorship_history_edit->CouncillorshipStatus->editAttributes() ?>>
</span>
<?php echo $councillorship_history_edit->CouncillorshipStatus->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillorship_history_edit->ExitReason->Visible) { // ExitReason ?>
	<div id="r_ExitReason" class="form-group row">
		<label id="elh_councillorship_history_ExitReason" for="x_ExitReason" class="<?php echo $councillorship_history_edit->LeftColumnClass ?>"><?php echo $councillorship_history_edit->ExitReason->caption() ?><?php echo $councillorship_history_edit->ExitReason->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillorship_history_edit->RightColumnClass ?>"><div <?php echo $councillorship_history_edit->ExitReason->cellAttributes() ?>>
<span id="el_councillorship_history_ExitReason">
<input type="text" data-table="councillorship_history" data-field="x_ExitReason" name="x_ExitReason" id="x_ExitReason" size="30" placeholder="<?php echo HtmlEncode($councillorship_history_edit->ExitReason->getPlaceHolder()) ?>" value="<?php echo $councillorship_history_edit->ExitReason->EditValue ?>"<?php echo $councillorship_history_edit->ExitReason->editAttributes() ?>>
</span>
<?php echo $councillorship_history_edit->ExitReason->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillorship_history_edit->RetirementType->Visible) { // RetirementType ?>
	<div id="r_RetirementType" class="form-group row">
		<label id="elh_councillorship_history_RetirementType" for="x_RetirementType" class="<?php echo $councillorship_history_edit->LeftColumnClass ?>"><?php echo $councillorship_history_edit->RetirementType->caption() ?><?php echo $councillorship_history_edit->RetirementType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillorship_history_edit->RightColumnClass ?>"><div <?php echo $councillorship_history_edit->RetirementType->cellAttributes() ?>>
<span id="el_councillorship_history_RetirementType">
<input type="text" data-table="councillorship_history" data-field="x_RetirementType" name="x_RetirementType" id="x_RetirementType" size="30" placeholder="<?php echo HtmlEncode($councillorship_history_edit->RetirementType->getPlaceHolder()) ?>" value="<?php echo $councillorship_history_edit->RetirementType->EditValue ?>"<?php echo $councillorship_history_edit->RetirementType->editAttributes() ?>>
</span>
<?php echo $councillorship_history_edit->RetirementType->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$councillorship_history_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $councillorship_history_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $councillorship_history_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$councillorship_history_edit->IsModal) { ?>
<?php echo $councillorship_history_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$councillorship_history_edit->showPageFooter();
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
$councillorship_history_edit->terminate();
?>