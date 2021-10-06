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
$councillorship_history_add = new councillorship_history_add();

// Run the page
$councillorship_history_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$councillorship_history_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcouncillorship_historyadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fcouncillorship_historyadd = currentForm = new ew.Form("fcouncillorship_historyadd", "add");

	// Validate form
	fcouncillorship_historyadd.validate = function() {
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
			<?php if ($councillorship_history_add->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_history_add->EmployeeID->caption(), $councillorship_history_add->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($councillorship_history_add->EmployeeID->errorMessage()) ?>");
			<?php if ($councillorship_history_add->ProvinceCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_history_add->ProvinceCode->caption(), $councillorship_history_add->ProvinceCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($councillorship_history_add->ProvinceCode->errorMessage()) ?>");
			<?php if ($councillorship_history_add->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_history_add->LACode->caption(), $councillorship_history_add->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillorship_history_add->PoliticalParty->Required) { ?>
				elm = this.getElements("x" + infix + "_PoliticalParty");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_history_add->PoliticalParty->caption(), $councillorship_history_add->PoliticalParty->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PoliticalParty");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($councillorship_history_add->PoliticalParty->errorMessage()) ?>");
			<?php if ($councillorship_history_add->Occupation->Required) { ?>
				elm = this.getElements("x" + infix + "_Occupation");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_history_add->Occupation->caption(), $councillorship_history_add->Occupation->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Occupation");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($councillorship_history_add->Occupation->errorMessage()) ?>");
			<?php if ($councillorship_history_add->PositionInCouncil->Required) { ?>
				elm = this.getElements("x" + infix + "_PositionInCouncil");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_history_add->PositionInCouncil->caption(), $councillorship_history_add->PositionInCouncil->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PositionInCouncil");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($councillorship_history_add->PositionInCouncil->errorMessage()) ?>");
			<?php if ($councillorship_history_add->Committee->Required) { ?>
				elm = this.getElements("x" + infix + "_Committee");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_history_add->Committee->caption(), $councillorship_history_add->Committee->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillorship_history_add->CouncilTerm->Required) { ?>
				elm = this.getElements("x" + infix + "_CouncilTerm");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_history_add->CouncilTerm->caption(), $councillorship_history_add->CouncilTerm->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_CouncilTerm");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($councillorship_history_add->CouncilTerm->errorMessage()) ?>");
			<?php if ($councillorship_history_add->DateOfExit->Required) { ?>
				elm = this.getElements("x" + infix + "_DateOfExit");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_history_add->DateOfExit->caption(), $councillorship_history_add->DateOfExit->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateOfExit");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($councillorship_history_add->DateOfExit->errorMessage()) ?>");
			<?php if ($councillorship_history_add->Allowance->Required) { ?>
				elm = this.getElements("x" + infix + "_Allowance");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_history_add->Allowance->caption(), $councillorship_history_add->Allowance->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillorship_history_add->CouncillorTypeType->Required) { ?>
				elm = this.getElements("x" + infix + "_CouncillorTypeType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_history_add->CouncillorTypeType->caption(), $councillorship_history_add->CouncillorTypeType->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_CouncillorTypeType");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($councillorship_history_add->CouncillorTypeType->errorMessage()) ?>");
			<?php if ($councillorship_history_add->CouncillorshipStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_CouncillorshipStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_history_add->CouncillorshipStatus->caption(), $councillorship_history_add->CouncillorshipStatus->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_CouncillorshipStatus");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($councillorship_history_add->CouncillorshipStatus->errorMessage()) ?>");
			<?php if ($councillorship_history_add->ExitReason->Required) { ?>
				elm = this.getElements("x" + infix + "_ExitReason");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_history_add->ExitReason->caption(), $councillorship_history_add->ExitReason->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ExitReason");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($councillorship_history_add->ExitReason->errorMessage()) ?>");
			<?php if ($councillorship_history_add->RetirementType->Required) { ?>
				elm = this.getElements("x" + infix + "_RetirementType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_history_add->RetirementType->caption(), $councillorship_history_add->RetirementType->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_RetirementType");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($councillorship_history_add->RetirementType->errorMessage()) ?>");

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
	fcouncillorship_historyadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcouncillorship_historyadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fcouncillorship_historyadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $councillorship_history_add->showPageHeader(); ?>
<?php
$councillorship_history_add->showMessage();
?>
<form name="fcouncillorship_historyadd" id="fcouncillorship_historyadd" class="<?php echo $councillorship_history_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="councillorship_history">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$councillorship_history_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($councillorship_history_add->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label id="elh_councillorship_history_EmployeeID" for="x_EmployeeID" class="<?php echo $councillorship_history_add->LeftColumnClass ?>"><?php echo $councillorship_history_add->EmployeeID->caption() ?><?php echo $councillorship_history_add->EmployeeID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillorship_history_add->RightColumnClass ?>"><div <?php echo $councillorship_history_add->EmployeeID->cellAttributes() ?>>
<span id="el_councillorship_history_EmployeeID">
<input type="text" data-table="councillorship_history" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($councillorship_history_add->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $councillorship_history_add->EmployeeID->EditValue ?>"<?php echo $councillorship_history_add->EmployeeID->editAttributes() ?>>
</span>
<?php echo $councillorship_history_add->EmployeeID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillorship_history_add->ProvinceCode->Visible) { // ProvinceCode ?>
	<div id="r_ProvinceCode" class="form-group row">
		<label id="elh_councillorship_history_ProvinceCode" for="x_ProvinceCode" class="<?php echo $councillorship_history_add->LeftColumnClass ?>"><?php echo $councillorship_history_add->ProvinceCode->caption() ?><?php echo $councillorship_history_add->ProvinceCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillorship_history_add->RightColumnClass ?>"><div <?php echo $councillorship_history_add->ProvinceCode->cellAttributes() ?>>
<span id="el_councillorship_history_ProvinceCode">
<input type="text" data-table="councillorship_history" data-field="x_ProvinceCode" name="x_ProvinceCode" id="x_ProvinceCode" size="30" placeholder="<?php echo HtmlEncode($councillorship_history_add->ProvinceCode->getPlaceHolder()) ?>" value="<?php echo $councillorship_history_add->ProvinceCode->EditValue ?>"<?php echo $councillorship_history_add->ProvinceCode->editAttributes() ?>>
</span>
<?php echo $councillorship_history_add->ProvinceCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillorship_history_add->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label id="elh_councillorship_history_LACode" for="x_LACode" class="<?php echo $councillorship_history_add->LeftColumnClass ?>"><?php echo $councillorship_history_add->LACode->caption() ?><?php echo $councillorship_history_add->LACode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillorship_history_add->RightColumnClass ?>"><div <?php echo $councillorship_history_add->LACode->cellAttributes() ?>>
<span id="el_councillorship_history_LACode">
<input type="text" data-table="councillorship_history" data-field="x_LACode" name="x_LACode" id="x_LACode" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($councillorship_history_add->LACode->getPlaceHolder()) ?>" value="<?php echo $councillorship_history_add->LACode->EditValue ?>"<?php echo $councillorship_history_add->LACode->editAttributes() ?>>
</span>
<?php echo $councillorship_history_add->LACode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillorship_history_add->PoliticalParty->Visible) { // PoliticalParty ?>
	<div id="r_PoliticalParty" class="form-group row">
		<label id="elh_councillorship_history_PoliticalParty" for="x_PoliticalParty" class="<?php echo $councillorship_history_add->LeftColumnClass ?>"><?php echo $councillorship_history_add->PoliticalParty->caption() ?><?php echo $councillorship_history_add->PoliticalParty->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillorship_history_add->RightColumnClass ?>"><div <?php echo $councillorship_history_add->PoliticalParty->cellAttributes() ?>>
<span id="el_councillorship_history_PoliticalParty">
<input type="text" data-table="councillorship_history" data-field="x_PoliticalParty" name="x_PoliticalParty" id="x_PoliticalParty" size="30" placeholder="<?php echo HtmlEncode($councillorship_history_add->PoliticalParty->getPlaceHolder()) ?>" value="<?php echo $councillorship_history_add->PoliticalParty->EditValue ?>"<?php echo $councillorship_history_add->PoliticalParty->editAttributes() ?>>
</span>
<?php echo $councillorship_history_add->PoliticalParty->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillorship_history_add->Occupation->Visible) { // Occupation ?>
	<div id="r_Occupation" class="form-group row">
		<label id="elh_councillorship_history_Occupation" for="x_Occupation" class="<?php echo $councillorship_history_add->LeftColumnClass ?>"><?php echo $councillorship_history_add->Occupation->caption() ?><?php echo $councillorship_history_add->Occupation->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillorship_history_add->RightColumnClass ?>"><div <?php echo $councillorship_history_add->Occupation->cellAttributes() ?>>
<span id="el_councillorship_history_Occupation">
<input type="text" data-table="councillorship_history" data-field="x_Occupation" name="x_Occupation" id="x_Occupation" size="30" placeholder="<?php echo HtmlEncode($councillorship_history_add->Occupation->getPlaceHolder()) ?>" value="<?php echo $councillorship_history_add->Occupation->EditValue ?>"<?php echo $councillorship_history_add->Occupation->editAttributes() ?>>
</span>
<?php echo $councillorship_history_add->Occupation->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillorship_history_add->PositionInCouncil->Visible) { // PositionInCouncil ?>
	<div id="r_PositionInCouncil" class="form-group row">
		<label id="elh_councillorship_history_PositionInCouncil" for="x_PositionInCouncil" class="<?php echo $councillorship_history_add->LeftColumnClass ?>"><?php echo $councillorship_history_add->PositionInCouncil->caption() ?><?php echo $councillorship_history_add->PositionInCouncil->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillorship_history_add->RightColumnClass ?>"><div <?php echo $councillorship_history_add->PositionInCouncil->cellAttributes() ?>>
<span id="el_councillorship_history_PositionInCouncil">
<input type="text" data-table="councillorship_history" data-field="x_PositionInCouncil" name="x_PositionInCouncil" id="x_PositionInCouncil" size="30" placeholder="<?php echo HtmlEncode($councillorship_history_add->PositionInCouncil->getPlaceHolder()) ?>" value="<?php echo $councillorship_history_add->PositionInCouncil->EditValue ?>"<?php echo $councillorship_history_add->PositionInCouncil->editAttributes() ?>>
</span>
<?php echo $councillorship_history_add->PositionInCouncil->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillorship_history_add->Committee->Visible) { // Committee ?>
	<div id="r_Committee" class="form-group row">
		<label id="elh_councillorship_history_Committee" for="x_Committee" class="<?php echo $councillorship_history_add->LeftColumnClass ?>"><?php echo $councillorship_history_add->Committee->caption() ?><?php echo $councillorship_history_add->Committee->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillorship_history_add->RightColumnClass ?>"><div <?php echo $councillorship_history_add->Committee->cellAttributes() ?>>
<span id="el_councillorship_history_Committee">
<input type="text" data-table="councillorship_history" data-field="x_Committee" name="x_Committee" id="x_Committee" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($councillorship_history_add->Committee->getPlaceHolder()) ?>" value="<?php echo $councillorship_history_add->Committee->EditValue ?>"<?php echo $councillorship_history_add->Committee->editAttributes() ?>>
</span>
<?php echo $councillorship_history_add->Committee->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillorship_history_add->CouncilTerm->Visible) { // CouncilTerm ?>
	<div id="r_CouncilTerm" class="form-group row">
		<label id="elh_councillorship_history_CouncilTerm" for="x_CouncilTerm" class="<?php echo $councillorship_history_add->LeftColumnClass ?>"><?php echo $councillorship_history_add->CouncilTerm->caption() ?><?php echo $councillorship_history_add->CouncilTerm->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillorship_history_add->RightColumnClass ?>"><div <?php echo $councillorship_history_add->CouncilTerm->cellAttributes() ?>>
<span id="el_councillorship_history_CouncilTerm">
<input type="text" data-table="councillorship_history" data-field="x_CouncilTerm" name="x_CouncilTerm" id="x_CouncilTerm" size="30" placeholder="<?php echo HtmlEncode($councillorship_history_add->CouncilTerm->getPlaceHolder()) ?>" value="<?php echo $councillorship_history_add->CouncilTerm->EditValue ?>"<?php echo $councillorship_history_add->CouncilTerm->editAttributes() ?>>
</span>
<?php echo $councillorship_history_add->CouncilTerm->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillorship_history_add->DateOfExit->Visible) { // DateOfExit ?>
	<div id="r_DateOfExit" class="form-group row">
		<label id="elh_councillorship_history_DateOfExit" for="x_DateOfExit" class="<?php echo $councillorship_history_add->LeftColumnClass ?>"><?php echo $councillorship_history_add->DateOfExit->caption() ?><?php echo $councillorship_history_add->DateOfExit->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillorship_history_add->RightColumnClass ?>"><div <?php echo $councillorship_history_add->DateOfExit->cellAttributes() ?>>
<span id="el_councillorship_history_DateOfExit">
<input type="text" data-table="councillorship_history" data-field="x_DateOfExit" name="x_DateOfExit" id="x_DateOfExit" placeholder="<?php echo HtmlEncode($councillorship_history_add->DateOfExit->getPlaceHolder()) ?>" value="<?php echo $councillorship_history_add->DateOfExit->EditValue ?>"<?php echo $councillorship_history_add->DateOfExit->editAttributes() ?>>
</span>
<?php echo $councillorship_history_add->DateOfExit->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillorship_history_add->Allowance->Visible) { // Allowance ?>
	<div id="r_Allowance" class="form-group row">
		<label id="elh_councillorship_history_Allowance" for="x_Allowance" class="<?php echo $councillorship_history_add->LeftColumnClass ?>"><?php echo $councillorship_history_add->Allowance->caption() ?><?php echo $councillorship_history_add->Allowance->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillorship_history_add->RightColumnClass ?>"><div <?php echo $councillorship_history_add->Allowance->cellAttributes() ?>>
<span id="el_councillorship_history_Allowance">
<input type="text" data-table="councillorship_history" data-field="x_Allowance" name="x_Allowance" id="x_Allowance" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($councillorship_history_add->Allowance->getPlaceHolder()) ?>" value="<?php echo $councillorship_history_add->Allowance->EditValue ?>"<?php echo $councillorship_history_add->Allowance->editAttributes() ?>>
</span>
<?php echo $councillorship_history_add->Allowance->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillorship_history_add->CouncillorTypeType->Visible) { // CouncillorTypeType ?>
	<div id="r_CouncillorTypeType" class="form-group row">
		<label id="elh_councillorship_history_CouncillorTypeType" for="x_CouncillorTypeType" class="<?php echo $councillorship_history_add->LeftColumnClass ?>"><?php echo $councillorship_history_add->CouncillorTypeType->caption() ?><?php echo $councillorship_history_add->CouncillorTypeType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillorship_history_add->RightColumnClass ?>"><div <?php echo $councillorship_history_add->CouncillorTypeType->cellAttributes() ?>>
<span id="el_councillorship_history_CouncillorTypeType">
<input type="text" data-table="councillorship_history" data-field="x_CouncillorTypeType" name="x_CouncillorTypeType" id="x_CouncillorTypeType" size="30" placeholder="<?php echo HtmlEncode($councillorship_history_add->CouncillorTypeType->getPlaceHolder()) ?>" value="<?php echo $councillorship_history_add->CouncillorTypeType->EditValue ?>"<?php echo $councillorship_history_add->CouncillorTypeType->editAttributes() ?>>
</span>
<?php echo $councillorship_history_add->CouncillorTypeType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillorship_history_add->CouncillorshipStatus->Visible) { // CouncillorshipStatus ?>
	<div id="r_CouncillorshipStatus" class="form-group row">
		<label id="elh_councillorship_history_CouncillorshipStatus" for="x_CouncillorshipStatus" class="<?php echo $councillorship_history_add->LeftColumnClass ?>"><?php echo $councillorship_history_add->CouncillorshipStatus->caption() ?><?php echo $councillorship_history_add->CouncillorshipStatus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillorship_history_add->RightColumnClass ?>"><div <?php echo $councillorship_history_add->CouncillorshipStatus->cellAttributes() ?>>
<span id="el_councillorship_history_CouncillorshipStatus">
<input type="text" data-table="councillorship_history" data-field="x_CouncillorshipStatus" name="x_CouncillorshipStatus" id="x_CouncillorshipStatus" size="30" placeholder="<?php echo HtmlEncode($councillorship_history_add->CouncillorshipStatus->getPlaceHolder()) ?>" value="<?php echo $councillorship_history_add->CouncillorshipStatus->EditValue ?>"<?php echo $councillorship_history_add->CouncillorshipStatus->editAttributes() ?>>
</span>
<?php echo $councillorship_history_add->CouncillorshipStatus->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillorship_history_add->ExitReason->Visible) { // ExitReason ?>
	<div id="r_ExitReason" class="form-group row">
		<label id="elh_councillorship_history_ExitReason" for="x_ExitReason" class="<?php echo $councillorship_history_add->LeftColumnClass ?>"><?php echo $councillorship_history_add->ExitReason->caption() ?><?php echo $councillorship_history_add->ExitReason->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillorship_history_add->RightColumnClass ?>"><div <?php echo $councillorship_history_add->ExitReason->cellAttributes() ?>>
<span id="el_councillorship_history_ExitReason">
<input type="text" data-table="councillorship_history" data-field="x_ExitReason" name="x_ExitReason" id="x_ExitReason" size="30" placeholder="<?php echo HtmlEncode($councillorship_history_add->ExitReason->getPlaceHolder()) ?>" value="<?php echo $councillorship_history_add->ExitReason->EditValue ?>"<?php echo $councillorship_history_add->ExitReason->editAttributes() ?>>
</span>
<?php echo $councillorship_history_add->ExitReason->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillorship_history_add->RetirementType->Visible) { // RetirementType ?>
	<div id="r_RetirementType" class="form-group row">
		<label id="elh_councillorship_history_RetirementType" for="x_RetirementType" class="<?php echo $councillorship_history_add->LeftColumnClass ?>"><?php echo $councillorship_history_add->RetirementType->caption() ?><?php echo $councillorship_history_add->RetirementType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillorship_history_add->RightColumnClass ?>"><div <?php echo $councillorship_history_add->RetirementType->cellAttributes() ?>>
<span id="el_councillorship_history_RetirementType">
<input type="text" data-table="councillorship_history" data-field="x_RetirementType" name="x_RetirementType" id="x_RetirementType" size="30" placeholder="<?php echo HtmlEncode($councillorship_history_add->RetirementType->getPlaceHolder()) ?>" value="<?php echo $councillorship_history_add->RetirementType->EditValue ?>"<?php echo $councillorship_history_add->RetirementType->editAttributes() ?>>
</span>
<?php echo $councillorship_history_add->RetirementType->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$councillorship_history_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $councillorship_history_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $councillorship_history_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$councillorship_history_add->showPageFooter();
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
$councillorship_history_add->terminate();
?>