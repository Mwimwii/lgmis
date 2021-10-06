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
$property_valuation_roll_add = new property_valuation_roll_add();

// Run the page
$property_valuation_roll_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$property_valuation_roll_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fproperty_valuation_rolladd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fproperty_valuation_rolladd = currentForm = new ew.Form("fproperty_valuation_rolladd", "add");

	// Validate form
	fproperty_valuation_rolladd.validate = function() {
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
			<?php if ($property_valuation_roll_add->PropertyNo->Required) { ?>
				elm = this.getElements("x" + infix + "_PropertyNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_valuation_roll_add->PropertyNo->caption(), $property_valuation_roll_add->PropertyNo->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PropertyNo");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_valuation_roll_add->PropertyNo->errorMessage()) ?>");
			<?php if ($property_valuation_roll_add->StandNo->Required) { ?>
				elm = this.getElements("x" + infix + "_StandNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_valuation_roll_add->StandNo->caption(), $property_valuation_roll_add->StandNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_valuation_roll_add->ClientID->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_valuation_roll_add->ClientID->caption(), $property_valuation_roll_add->ClientID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_valuation_roll_add->PropertyGroup->Required) { ?>
				elm = this.getElements("x" + infix + "_PropertyGroup");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_valuation_roll_add->PropertyGroup->caption(), $property_valuation_roll_add->PropertyGroup->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PropertyGroup");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_valuation_roll_add->PropertyGroup->errorMessage()) ?>");
			<?php if ($property_valuation_roll_add->PropertyType->Required) { ?>
				elm = this.getElements("x" + infix + "_PropertyType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_valuation_roll_add->PropertyType->caption(), $property_valuation_roll_add->PropertyType->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PropertyType");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_valuation_roll_add->PropertyType->errorMessage()) ?>");
			<?php if ($property_valuation_roll_add->Location->Required) { ?>
				elm = this.getElements("x" + infix + "_Location");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_valuation_roll_add->Location->caption(), $property_valuation_roll_add->Location->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_valuation_roll_add->RollStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_RollStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_valuation_roll_add->RollStatus->caption(), $property_valuation_roll_add->RollStatus->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_RollStatus");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_valuation_roll_add->RollStatus->errorMessage()) ?>");
			<?php if ($property_valuation_roll_add->UseCode->Required) { ?>
				elm = this.getElements("x" + infix + "_UseCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_valuation_roll_add->UseCode->caption(), $property_valuation_roll_add->UseCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_UseCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_valuation_roll_add->UseCode->errorMessage()) ?>");
			<?php if ($property_valuation_roll_add->AreaOfLand->Required) { ?>
				elm = this.getElements("x" + infix + "_AreaOfLand");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_valuation_roll_add->AreaOfLand->caption(), $property_valuation_roll_add->AreaOfLand->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AreaOfLand");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_valuation_roll_add->AreaOfLand->errorMessage()) ?>");
			<?php if ($property_valuation_roll_add->AreaCode->Required) { ?>
				elm = this.getElements("x" + infix + "_AreaCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_valuation_roll_add->AreaCode->caption(), $property_valuation_roll_add->AreaCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_valuation_roll_add->SiteNumber->Required) { ?>
				elm = this.getElements("x" + infix + "_SiteNumber");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_valuation_roll_add->SiteNumber->caption(), $property_valuation_roll_add->SiteNumber->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_SiteNumber");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_valuation_roll_add->SiteNumber->errorMessage()) ?>");
			<?php if ($property_valuation_roll_add->RateableValue->Required) { ?>
				elm = this.getElements("x" + infix + "_RateableValue");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_valuation_roll_add->RateableValue->caption(), $property_valuation_roll_add->RateableValue->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_RateableValue");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_valuation_roll_add->RateableValue->errorMessage()) ?>");
			<?php if ($property_valuation_roll_add->NewRateableValue->Required) { ?>
				elm = this.getElements("x" + infix + "_NewRateableValue");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_valuation_roll_add->NewRateableValue->caption(), $property_valuation_roll_add->NewRateableValue->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_NewRateableValue");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_valuation_roll_add->NewRateableValue->errorMessage()) ?>");
			<?php if ($property_valuation_roll_add->ExemptCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ExemptCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_valuation_roll_add->ExemptCode->caption(), $property_valuation_roll_add->ExemptCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ExemptCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_valuation_roll_add->ExemptCode->errorMessage()) ?>");
			<?php if ($property_valuation_roll_add->Improvements->Required) { ?>
				elm = this.getElements("x" + infix + "_Improvements");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_valuation_roll_add->Improvements->caption(), $property_valuation_roll_add->Improvements->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_valuation_roll_add->NewImprovements->Required) { ?>
				elm = this.getElements("x" + infix + "_NewImprovements");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_valuation_roll_add->NewImprovements->caption(), $property_valuation_roll_add->NewImprovements->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_valuation_roll_add->Longitude->Required) { ?>
				elm = this.getElements("x" + infix + "_Longitude");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_valuation_roll_add->Longitude->caption(), $property_valuation_roll_add->Longitude->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Longitude");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_valuation_roll_add->Longitude->errorMessage()) ?>");
			<?php if ($property_valuation_roll_add->Latitude->Required) { ?>
				elm = this.getElements("x" + infix + "_Latitude");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_valuation_roll_add->Latitude->caption(), $property_valuation_roll_add->Latitude->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Latitude");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_valuation_roll_add->Latitude->errorMessage()) ?>");
			<?php if ($property_valuation_roll_add->PropertyPhoto->Required) { ?>
				felm = this.getElements("x" + infix + "_PropertyPhoto");
				elm = this.getElements("fn_x" + infix + "_PropertyPhoto");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $property_valuation_roll_add->PropertyPhoto->caption(), $property_valuation_roll_add->PropertyPhoto->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_valuation_roll_add->DateEvaluated->Required) { ?>
				elm = this.getElements("x" + infix + "_DateEvaluated");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_valuation_roll_add->DateEvaluated->caption(), $property_valuation_roll_add->DateEvaluated->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateEvaluated");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_valuation_roll_add->DateEvaluated->errorMessage()) ?>");
			<?php if ($property_valuation_roll_add->Objections->Required) { ?>
				elm = this.getElements("x" + infix + "_Objections");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_valuation_roll_add->Objections->caption(), $property_valuation_roll_add->Objections->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_valuation_roll_add->DateEntered->Required) { ?>
				elm = this.getElements("x" + infix + "_DateEntered");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_valuation_roll_add->DateEntered->caption(), $property_valuation_roll_add->DateEntered->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateEntered");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_valuation_roll_add->DateEntered->errorMessage()) ?>");
			<?php if ($property_valuation_roll_add->LastUpdatedBy->Required) { ?>
				elm = this.getElements("x" + infix + "_LastUpdatedBy");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_valuation_roll_add->LastUpdatedBy->caption(), $property_valuation_roll_add->LastUpdatedBy->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_valuation_roll_add->LastUpdateDate->Required) { ?>
				elm = this.getElements("x" + infix + "_LastUpdateDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_valuation_roll_add->LastUpdateDate->caption(), $property_valuation_roll_add->LastUpdateDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LastUpdateDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_valuation_roll_add->LastUpdateDate->errorMessage()) ?>");

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
	fproperty_valuation_rolladd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fproperty_valuation_rolladd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fproperty_valuation_rolladd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $property_valuation_roll_add->showPageHeader(); ?>
<?php
$property_valuation_roll_add->showMessage();
?>
<form name="fproperty_valuation_rolladd" id="fproperty_valuation_rolladd" class="<?php echo $property_valuation_roll_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="property_valuation_roll">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$property_valuation_roll_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($property_valuation_roll_add->PropertyNo->Visible) { // PropertyNo ?>
	<div id="r_PropertyNo" class="form-group row">
		<label id="elh_property_valuation_roll_PropertyNo" for="x_PropertyNo" class="<?php echo $property_valuation_roll_add->LeftColumnClass ?>"><?php echo $property_valuation_roll_add->PropertyNo->caption() ?><?php echo $property_valuation_roll_add->PropertyNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_valuation_roll_add->RightColumnClass ?>"><div <?php echo $property_valuation_roll_add->PropertyNo->cellAttributes() ?>>
<span id="el_property_valuation_roll_PropertyNo">
<input type="text" data-table="property_valuation_roll" data-field="x_PropertyNo" name="x_PropertyNo" id="x_PropertyNo" size="30" placeholder="<?php echo HtmlEncode($property_valuation_roll_add->PropertyNo->getPlaceHolder()) ?>" value="<?php echo $property_valuation_roll_add->PropertyNo->EditValue ?>"<?php echo $property_valuation_roll_add->PropertyNo->editAttributes() ?>>
</span>
<?php echo $property_valuation_roll_add->PropertyNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_valuation_roll_add->StandNo->Visible) { // StandNo ?>
	<div id="r_StandNo" class="form-group row">
		<label id="elh_property_valuation_roll_StandNo" for="x_StandNo" class="<?php echo $property_valuation_roll_add->LeftColumnClass ?>"><?php echo $property_valuation_roll_add->StandNo->caption() ?><?php echo $property_valuation_roll_add->StandNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_valuation_roll_add->RightColumnClass ?>"><div <?php echo $property_valuation_roll_add->StandNo->cellAttributes() ?>>
<span id="el_property_valuation_roll_StandNo">
<input type="text" data-table="property_valuation_roll" data-field="x_StandNo" name="x_StandNo" id="x_StandNo" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($property_valuation_roll_add->StandNo->getPlaceHolder()) ?>" value="<?php echo $property_valuation_roll_add->StandNo->EditValue ?>"<?php echo $property_valuation_roll_add->StandNo->editAttributes() ?>>
</span>
<?php echo $property_valuation_roll_add->StandNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_valuation_roll_add->ClientID->Visible) { // ClientID ?>
	<div id="r_ClientID" class="form-group row">
		<label id="elh_property_valuation_roll_ClientID" for="x_ClientID" class="<?php echo $property_valuation_roll_add->LeftColumnClass ?>"><?php echo $property_valuation_roll_add->ClientID->caption() ?><?php echo $property_valuation_roll_add->ClientID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_valuation_roll_add->RightColumnClass ?>"><div <?php echo $property_valuation_roll_add->ClientID->cellAttributes() ?>>
<span id="el_property_valuation_roll_ClientID">
<input type="text" data-table="property_valuation_roll" data-field="x_ClientID" name="x_ClientID" id="x_ClientID" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($property_valuation_roll_add->ClientID->getPlaceHolder()) ?>" value="<?php echo $property_valuation_roll_add->ClientID->EditValue ?>"<?php echo $property_valuation_roll_add->ClientID->editAttributes() ?>>
</span>
<?php echo $property_valuation_roll_add->ClientID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_valuation_roll_add->PropertyGroup->Visible) { // PropertyGroup ?>
	<div id="r_PropertyGroup" class="form-group row">
		<label id="elh_property_valuation_roll_PropertyGroup" for="x_PropertyGroup" class="<?php echo $property_valuation_roll_add->LeftColumnClass ?>"><?php echo $property_valuation_roll_add->PropertyGroup->caption() ?><?php echo $property_valuation_roll_add->PropertyGroup->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_valuation_roll_add->RightColumnClass ?>"><div <?php echo $property_valuation_roll_add->PropertyGroup->cellAttributes() ?>>
<span id="el_property_valuation_roll_PropertyGroup">
<input type="text" data-table="property_valuation_roll" data-field="x_PropertyGroup" name="x_PropertyGroup" id="x_PropertyGroup" size="30" placeholder="<?php echo HtmlEncode($property_valuation_roll_add->PropertyGroup->getPlaceHolder()) ?>" value="<?php echo $property_valuation_roll_add->PropertyGroup->EditValue ?>"<?php echo $property_valuation_roll_add->PropertyGroup->editAttributes() ?>>
</span>
<?php echo $property_valuation_roll_add->PropertyGroup->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_valuation_roll_add->PropertyType->Visible) { // PropertyType ?>
	<div id="r_PropertyType" class="form-group row">
		<label id="elh_property_valuation_roll_PropertyType" for="x_PropertyType" class="<?php echo $property_valuation_roll_add->LeftColumnClass ?>"><?php echo $property_valuation_roll_add->PropertyType->caption() ?><?php echo $property_valuation_roll_add->PropertyType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_valuation_roll_add->RightColumnClass ?>"><div <?php echo $property_valuation_roll_add->PropertyType->cellAttributes() ?>>
<span id="el_property_valuation_roll_PropertyType">
<input type="text" data-table="property_valuation_roll" data-field="x_PropertyType" name="x_PropertyType" id="x_PropertyType" size="30" placeholder="<?php echo HtmlEncode($property_valuation_roll_add->PropertyType->getPlaceHolder()) ?>" value="<?php echo $property_valuation_roll_add->PropertyType->EditValue ?>"<?php echo $property_valuation_roll_add->PropertyType->editAttributes() ?>>
</span>
<?php echo $property_valuation_roll_add->PropertyType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_valuation_roll_add->Location->Visible) { // Location ?>
	<div id="r_Location" class="form-group row">
		<label id="elh_property_valuation_roll_Location" for="x_Location" class="<?php echo $property_valuation_roll_add->LeftColumnClass ?>"><?php echo $property_valuation_roll_add->Location->caption() ?><?php echo $property_valuation_roll_add->Location->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_valuation_roll_add->RightColumnClass ?>"><div <?php echo $property_valuation_roll_add->Location->cellAttributes() ?>>
<span id="el_property_valuation_roll_Location">
<input type="text" data-table="property_valuation_roll" data-field="x_Location" name="x_Location" id="x_Location" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($property_valuation_roll_add->Location->getPlaceHolder()) ?>" value="<?php echo $property_valuation_roll_add->Location->EditValue ?>"<?php echo $property_valuation_roll_add->Location->editAttributes() ?>>
</span>
<?php echo $property_valuation_roll_add->Location->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_valuation_roll_add->RollStatus->Visible) { // RollStatus ?>
	<div id="r_RollStatus" class="form-group row">
		<label id="elh_property_valuation_roll_RollStatus" for="x_RollStatus" class="<?php echo $property_valuation_roll_add->LeftColumnClass ?>"><?php echo $property_valuation_roll_add->RollStatus->caption() ?><?php echo $property_valuation_roll_add->RollStatus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_valuation_roll_add->RightColumnClass ?>"><div <?php echo $property_valuation_roll_add->RollStatus->cellAttributes() ?>>
<span id="el_property_valuation_roll_RollStatus">
<input type="text" data-table="property_valuation_roll" data-field="x_RollStatus" name="x_RollStatus" id="x_RollStatus" size="30" placeholder="<?php echo HtmlEncode($property_valuation_roll_add->RollStatus->getPlaceHolder()) ?>" value="<?php echo $property_valuation_roll_add->RollStatus->EditValue ?>"<?php echo $property_valuation_roll_add->RollStatus->editAttributes() ?>>
</span>
<?php echo $property_valuation_roll_add->RollStatus->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_valuation_roll_add->UseCode->Visible) { // UseCode ?>
	<div id="r_UseCode" class="form-group row">
		<label id="elh_property_valuation_roll_UseCode" for="x_UseCode" class="<?php echo $property_valuation_roll_add->LeftColumnClass ?>"><?php echo $property_valuation_roll_add->UseCode->caption() ?><?php echo $property_valuation_roll_add->UseCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_valuation_roll_add->RightColumnClass ?>"><div <?php echo $property_valuation_roll_add->UseCode->cellAttributes() ?>>
<span id="el_property_valuation_roll_UseCode">
<input type="text" data-table="property_valuation_roll" data-field="x_UseCode" name="x_UseCode" id="x_UseCode" size="30" placeholder="<?php echo HtmlEncode($property_valuation_roll_add->UseCode->getPlaceHolder()) ?>" value="<?php echo $property_valuation_roll_add->UseCode->EditValue ?>"<?php echo $property_valuation_roll_add->UseCode->editAttributes() ?>>
</span>
<?php echo $property_valuation_roll_add->UseCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_valuation_roll_add->AreaOfLand->Visible) { // AreaOfLand ?>
	<div id="r_AreaOfLand" class="form-group row">
		<label id="elh_property_valuation_roll_AreaOfLand" for="x_AreaOfLand" class="<?php echo $property_valuation_roll_add->LeftColumnClass ?>"><?php echo $property_valuation_roll_add->AreaOfLand->caption() ?><?php echo $property_valuation_roll_add->AreaOfLand->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_valuation_roll_add->RightColumnClass ?>"><div <?php echo $property_valuation_roll_add->AreaOfLand->cellAttributes() ?>>
<span id="el_property_valuation_roll_AreaOfLand">
<input type="text" data-table="property_valuation_roll" data-field="x_AreaOfLand" name="x_AreaOfLand" id="x_AreaOfLand" size="30" placeholder="<?php echo HtmlEncode($property_valuation_roll_add->AreaOfLand->getPlaceHolder()) ?>" value="<?php echo $property_valuation_roll_add->AreaOfLand->EditValue ?>"<?php echo $property_valuation_roll_add->AreaOfLand->editAttributes() ?>>
</span>
<?php echo $property_valuation_roll_add->AreaOfLand->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_valuation_roll_add->AreaCode->Visible) { // AreaCode ?>
	<div id="r_AreaCode" class="form-group row">
		<label id="elh_property_valuation_roll_AreaCode" for="x_AreaCode" class="<?php echo $property_valuation_roll_add->LeftColumnClass ?>"><?php echo $property_valuation_roll_add->AreaCode->caption() ?><?php echo $property_valuation_roll_add->AreaCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_valuation_roll_add->RightColumnClass ?>"><div <?php echo $property_valuation_roll_add->AreaCode->cellAttributes() ?>>
<span id="el_property_valuation_roll_AreaCode">
<input type="text" data-table="property_valuation_roll" data-field="x_AreaCode" name="x_AreaCode" id="x_AreaCode" size="30" maxlength="3" placeholder="<?php echo HtmlEncode($property_valuation_roll_add->AreaCode->getPlaceHolder()) ?>" value="<?php echo $property_valuation_roll_add->AreaCode->EditValue ?>"<?php echo $property_valuation_roll_add->AreaCode->editAttributes() ?>>
</span>
<?php echo $property_valuation_roll_add->AreaCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_valuation_roll_add->SiteNumber->Visible) { // SiteNumber ?>
	<div id="r_SiteNumber" class="form-group row">
		<label id="elh_property_valuation_roll_SiteNumber" for="x_SiteNumber" class="<?php echo $property_valuation_roll_add->LeftColumnClass ?>"><?php echo $property_valuation_roll_add->SiteNumber->caption() ?><?php echo $property_valuation_roll_add->SiteNumber->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_valuation_roll_add->RightColumnClass ?>"><div <?php echo $property_valuation_roll_add->SiteNumber->cellAttributes() ?>>
<span id="el_property_valuation_roll_SiteNumber">
<input type="text" data-table="property_valuation_roll" data-field="x_SiteNumber" name="x_SiteNumber" id="x_SiteNumber" size="30" placeholder="<?php echo HtmlEncode($property_valuation_roll_add->SiteNumber->getPlaceHolder()) ?>" value="<?php echo $property_valuation_roll_add->SiteNumber->EditValue ?>"<?php echo $property_valuation_roll_add->SiteNumber->editAttributes() ?>>
</span>
<?php echo $property_valuation_roll_add->SiteNumber->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_valuation_roll_add->RateableValue->Visible) { // RateableValue ?>
	<div id="r_RateableValue" class="form-group row">
		<label id="elh_property_valuation_roll_RateableValue" for="x_RateableValue" class="<?php echo $property_valuation_roll_add->LeftColumnClass ?>"><?php echo $property_valuation_roll_add->RateableValue->caption() ?><?php echo $property_valuation_roll_add->RateableValue->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_valuation_roll_add->RightColumnClass ?>"><div <?php echo $property_valuation_roll_add->RateableValue->cellAttributes() ?>>
<span id="el_property_valuation_roll_RateableValue">
<input type="text" data-table="property_valuation_roll" data-field="x_RateableValue" name="x_RateableValue" id="x_RateableValue" size="30" placeholder="<?php echo HtmlEncode($property_valuation_roll_add->RateableValue->getPlaceHolder()) ?>" value="<?php echo $property_valuation_roll_add->RateableValue->EditValue ?>"<?php echo $property_valuation_roll_add->RateableValue->editAttributes() ?>>
</span>
<?php echo $property_valuation_roll_add->RateableValue->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_valuation_roll_add->NewRateableValue->Visible) { // NewRateableValue ?>
	<div id="r_NewRateableValue" class="form-group row">
		<label id="elh_property_valuation_roll_NewRateableValue" for="x_NewRateableValue" class="<?php echo $property_valuation_roll_add->LeftColumnClass ?>"><?php echo $property_valuation_roll_add->NewRateableValue->caption() ?><?php echo $property_valuation_roll_add->NewRateableValue->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_valuation_roll_add->RightColumnClass ?>"><div <?php echo $property_valuation_roll_add->NewRateableValue->cellAttributes() ?>>
<span id="el_property_valuation_roll_NewRateableValue">
<input type="text" data-table="property_valuation_roll" data-field="x_NewRateableValue" name="x_NewRateableValue" id="x_NewRateableValue" size="30" placeholder="<?php echo HtmlEncode($property_valuation_roll_add->NewRateableValue->getPlaceHolder()) ?>" value="<?php echo $property_valuation_roll_add->NewRateableValue->EditValue ?>"<?php echo $property_valuation_roll_add->NewRateableValue->editAttributes() ?>>
</span>
<?php echo $property_valuation_roll_add->NewRateableValue->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_valuation_roll_add->ExemptCode->Visible) { // ExemptCode ?>
	<div id="r_ExemptCode" class="form-group row">
		<label id="elh_property_valuation_roll_ExemptCode" for="x_ExemptCode" class="<?php echo $property_valuation_roll_add->LeftColumnClass ?>"><?php echo $property_valuation_roll_add->ExemptCode->caption() ?><?php echo $property_valuation_roll_add->ExemptCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_valuation_roll_add->RightColumnClass ?>"><div <?php echo $property_valuation_roll_add->ExemptCode->cellAttributes() ?>>
<span id="el_property_valuation_roll_ExemptCode">
<input type="text" data-table="property_valuation_roll" data-field="x_ExemptCode" name="x_ExemptCode" id="x_ExemptCode" size="30" placeholder="<?php echo HtmlEncode($property_valuation_roll_add->ExemptCode->getPlaceHolder()) ?>" value="<?php echo $property_valuation_roll_add->ExemptCode->EditValue ?>"<?php echo $property_valuation_roll_add->ExemptCode->editAttributes() ?>>
</span>
<?php echo $property_valuation_roll_add->ExemptCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_valuation_roll_add->Improvements->Visible) { // Improvements ?>
	<div id="r_Improvements" class="form-group row">
		<label id="elh_property_valuation_roll_Improvements" for="x_Improvements" class="<?php echo $property_valuation_roll_add->LeftColumnClass ?>"><?php echo $property_valuation_roll_add->Improvements->caption() ?><?php echo $property_valuation_roll_add->Improvements->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_valuation_roll_add->RightColumnClass ?>"><div <?php echo $property_valuation_roll_add->Improvements->cellAttributes() ?>>
<span id="el_property_valuation_roll_Improvements">
<input type="text" data-table="property_valuation_roll" data-field="x_Improvements" name="x_Improvements" id="x_Improvements" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($property_valuation_roll_add->Improvements->getPlaceHolder()) ?>" value="<?php echo $property_valuation_roll_add->Improvements->EditValue ?>"<?php echo $property_valuation_roll_add->Improvements->editAttributes() ?>>
</span>
<?php echo $property_valuation_roll_add->Improvements->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_valuation_roll_add->NewImprovements->Visible) { // NewImprovements ?>
	<div id="r_NewImprovements" class="form-group row">
		<label id="elh_property_valuation_roll_NewImprovements" for="x_NewImprovements" class="<?php echo $property_valuation_roll_add->LeftColumnClass ?>"><?php echo $property_valuation_roll_add->NewImprovements->caption() ?><?php echo $property_valuation_roll_add->NewImprovements->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_valuation_roll_add->RightColumnClass ?>"><div <?php echo $property_valuation_roll_add->NewImprovements->cellAttributes() ?>>
<span id="el_property_valuation_roll_NewImprovements">
<input type="text" data-table="property_valuation_roll" data-field="x_NewImprovements" name="x_NewImprovements" id="x_NewImprovements" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($property_valuation_roll_add->NewImprovements->getPlaceHolder()) ?>" value="<?php echo $property_valuation_roll_add->NewImprovements->EditValue ?>"<?php echo $property_valuation_roll_add->NewImprovements->editAttributes() ?>>
</span>
<?php echo $property_valuation_roll_add->NewImprovements->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_valuation_roll_add->Longitude->Visible) { // Longitude ?>
	<div id="r_Longitude" class="form-group row">
		<label id="elh_property_valuation_roll_Longitude" for="x_Longitude" class="<?php echo $property_valuation_roll_add->LeftColumnClass ?>"><?php echo $property_valuation_roll_add->Longitude->caption() ?><?php echo $property_valuation_roll_add->Longitude->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_valuation_roll_add->RightColumnClass ?>"><div <?php echo $property_valuation_roll_add->Longitude->cellAttributes() ?>>
<span id="el_property_valuation_roll_Longitude">
<input type="text" data-table="property_valuation_roll" data-field="x_Longitude" name="x_Longitude" id="x_Longitude" size="30" placeholder="<?php echo HtmlEncode($property_valuation_roll_add->Longitude->getPlaceHolder()) ?>" value="<?php echo $property_valuation_roll_add->Longitude->EditValue ?>"<?php echo $property_valuation_roll_add->Longitude->editAttributes() ?>>
</span>
<?php echo $property_valuation_roll_add->Longitude->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_valuation_roll_add->Latitude->Visible) { // Latitude ?>
	<div id="r_Latitude" class="form-group row">
		<label id="elh_property_valuation_roll_Latitude" for="x_Latitude" class="<?php echo $property_valuation_roll_add->LeftColumnClass ?>"><?php echo $property_valuation_roll_add->Latitude->caption() ?><?php echo $property_valuation_roll_add->Latitude->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_valuation_roll_add->RightColumnClass ?>"><div <?php echo $property_valuation_roll_add->Latitude->cellAttributes() ?>>
<span id="el_property_valuation_roll_Latitude">
<input type="text" data-table="property_valuation_roll" data-field="x_Latitude" name="x_Latitude" id="x_Latitude" size="30" placeholder="<?php echo HtmlEncode($property_valuation_roll_add->Latitude->getPlaceHolder()) ?>" value="<?php echo $property_valuation_roll_add->Latitude->EditValue ?>"<?php echo $property_valuation_roll_add->Latitude->editAttributes() ?>>
</span>
<?php echo $property_valuation_roll_add->Latitude->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_valuation_roll_add->PropertyPhoto->Visible) { // PropertyPhoto ?>
	<div id="r_PropertyPhoto" class="form-group row">
		<label id="elh_property_valuation_roll_PropertyPhoto" class="<?php echo $property_valuation_roll_add->LeftColumnClass ?>"><?php echo $property_valuation_roll_add->PropertyPhoto->caption() ?><?php echo $property_valuation_roll_add->PropertyPhoto->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_valuation_roll_add->RightColumnClass ?>"><div <?php echo $property_valuation_roll_add->PropertyPhoto->cellAttributes() ?>>
<span id="el_property_valuation_roll_PropertyPhoto">
<div id="fd_x_PropertyPhoto">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $property_valuation_roll_add->PropertyPhoto->title() ?>" data-table="property_valuation_roll" data-field="x_PropertyPhoto" name="x_PropertyPhoto" id="x_PropertyPhoto" lang="<?php echo CurrentLanguageID() ?>"<?php echo $property_valuation_roll_add->PropertyPhoto->editAttributes() ?><?php if ($property_valuation_roll_add->PropertyPhoto->ReadOnly || $property_valuation_roll_add->PropertyPhoto->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_PropertyPhoto"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_PropertyPhoto" id= "fn_x_PropertyPhoto" value="<?php echo $property_valuation_roll_add->PropertyPhoto->Upload->FileName ?>">
<input type="hidden" name="fa_x_PropertyPhoto" id= "fa_x_PropertyPhoto" value="0">
<input type="hidden" name="fs_x_PropertyPhoto" id= "fs_x_PropertyPhoto" value="0">
<input type="hidden" name="fx_x_PropertyPhoto" id= "fx_x_PropertyPhoto" value="<?php echo $property_valuation_roll_add->PropertyPhoto->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_PropertyPhoto" id= "fm_x_PropertyPhoto" value="<?php echo $property_valuation_roll_add->PropertyPhoto->UploadMaxFileSize ?>">
</div>
<table id="ft_x_PropertyPhoto" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $property_valuation_roll_add->PropertyPhoto->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_valuation_roll_add->DateEvaluated->Visible) { // DateEvaluated ?>
	<div id="r_DateEvaluated" class="form-group row">
		<label id="elh_property_valuation_roll_DateEvaluated" for="x_DateEvaluated" class="<?php echo $property_valuation_roll_add->LeftColumnClass ?>"><?php echo $property_valuation_roll_add->DateEvaluated->caption() ?><?php echo $property_valuation_roll_add->DateEvaluated->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_valuation_roll_add->RightColumnClass ?>"><div <?php echo $property_valuation_roll_add->DateEvaluated->cellAttributes() ?>>
<span id="el_property_valuation_roll_DateEvaluated">
<input type="text" data-table="property_valuation_roll" data-field="x_DateEvaluated" name="x_DateEvaluated" id="x_DateEvaluated" placeholder="<?php echo HtmlEncode($property_valuation_roll_add->DateEvaluated->getPlaceHolder()) ?>" value="<?php echo $property_valuation_roll_add->DateEvaluated->EditValue ?>"<?php echo $property_valuation_roll_add->DateEvaluated->editAttributes() ?>>
</span>
<?php echo $property_valuation_roll_add->DateEvaluated->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_valuation_roll_add->Objections->Visible) { // Objections ?>
	<div id="r_Objections" class="form-group row">
		<label id="elh_property_valuation_roll_Objections" for="x_Objections" class="<?php echo $property_valuation_roll_add->LeftColumnClass ?>"><?php echo $property_valuation_roll_add->Objections->caption() ?><?php echo $property_valuation_roll_add->Objections->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_valuation_roll_add->RightColumnClass ?>"><div <?php echo $property_valuation_roll_add->Objections->cellAttributes() ?>>
<span id="el_property_valuation_roll_Objections">
<textarea data-table="property_valuation_roll" data-field="x_Objections" name="x_Objections" id="x_Objections" cols="35" rows="4" placeholder="<?php echo HtmlEncode($property_valuation_roll_add->Objections->getPlaceHolder()) ?>"<?php echo $property_valuation_roll_add->Objections->editAttributes() ?>><?php echo $property_valuation_roll_add->Objections->EditValue ?></textarea>
</span>
<?php echo $property_valuation_roll_add->Objections->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_valuation_roll_add->DateEntered->Visible) { // DateEntered ?>
	<div id="r_DateEntered" class="form-group row">
		<label id="elh_property_valuation_roll_DateEntered" for="x_DateEntered" class="<?php echo $property_valuation_roll_add->LeftColumnClass ?>"><?php echo $property_valuation_roll_add->DateEntered->caption() ?><?php echo $property_valuation_roll_add->DateEntered->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_valuation_roll_add->RightColumnClass ?>"><div <?php echo $property_valuation_roll_add->DateEntered->cellAttributes() ?>>
<span id="el_property_valuation_roll_DateEntered">
<input type="text" data-table="property_valuation_roll" data-field="x_DateEntered" name="x_DateEntered" id="x_DateEntered" placeholder="<?php echo HtmlEncode($property_valuation_roll_add->DateEntered->getPlaceHolder()) ?>" value="<?php echo $property_valuation_roll_add->DateEntered->EditValue ?>"<?php echo $property_valuation_roll_add->DateEntered->editAttributes() ?>>
</span>
<?php echo $property_valuation_roll_add->DateEntered->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_valuation_roll_add->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
	<div id="r_LastUpdatedBy" class="form-group row">
		<label id="elh_property_valuation_roll_LastUpdatedBy" for="x_LastUpdatedBy" class="<?php echo $property_valuation_roll_add->LeftColumnClass ?>"><?php echo $property_valuation_roll_add->LastUpdatedBy->caption() ?><?php echo $property_valuation_roll_add->LastUpdatedBy->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_valuation_roll_add->RightColumnClass ?>"><div <?php echo $property_valuation_roll_add->LastUpdatedBy->cellAttributes() ?>>
<span id="el_property_valuation_roll_LastUpdatedBy">
<input type="text" data-table="property_valuation_roll" data-field="x_LastUpdatedBy" name="x_LastUpdatedBy" id="x_LastUpdatedBy" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($property_valuation_roll_add->LastUpdatedBy->getPlaceHolder()) ?>" value="<?php echo $property_valuation_roll_add->LastUpdatedBy->EditValue ?>"<?php echo $property_valuation_roll_add->LastUpdatedBy->editAttributes() ?>>
</span>
<?php echo $property_valuation_roll_add->LastUpdatedBy->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_valuation_roll_add->LastUpdateDate->Visible) { // LastUpdateDate ?>
	<div id="r_LastUpdateDate" class="form-group row">
		<label id="elh_property_valuation_roll_LastUpdateDate" for="x_LastUpdateDate" class="<?php echo $property_valuation_roll_add->LeftColumnClass ?>"><?php echo $property_valuation_roll_add->LastUpdateDate->caption() ?><?php echo $property_valuation_roll_add->LastUpdateDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_valuation_roll_add->RightColumnClass ?>"><div <?php echo $property_valuation_roll_add->LastUpdateDate->cellAttributes() ?>>
<span id="el_property_valuation_roll_LastUpdateDate">
<input type="text" data-table="property_valuation_roll" data-field="x_LastUpdateDate" name="x_LastUpdateDate" id="x_LastUpdateDate" placeholder="<?php echo HtmlEncode($property_valuation_roll_add->LastUpdateDate->getPlaceHolder()) ?>" value="<?php echo $property_valuation_roll_add->LastUpdateDate->EditValue ?>"<?php echo $property_valuation_roll_add->LastUpdateDate->editAttributes() ?>>
</span>
<?php echo $property_valuation_roll_add->LastUpdateDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$property_valuation_roll_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $property_valuation_roll_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $property_valuation_roll_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$property_valuation_roll_add->showPageFooter();
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
$property_valuation_roll_add->terminate();
?>