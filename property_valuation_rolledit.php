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
$property_valuation_roll_edit = new property_valuation_roll_edit();

// Run the page
$property_valuation_roll_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$property_valuation_roll_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fproperty_valuation_rolledit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fproperty_valuation_rolledit = currentForm = new ew.Form("fproperty_valuation_rolledit", "edit");

	// Validate form
	fproperty_valuation_rolledit.validate = function() {
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
			<?php if ($property_valuation_roll_edit->ValuationNo->Required) { ?>
				elm = this.getElements("x" + infix + "_ValuationNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_valuation_roll_edit->ValuationNo->caption(), $property_valuation_roll_edit->ValuationNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_valuation_roll_edit->PropertyNo->Required) { ?>
				elm = this.getElements("x" + infix + "_PropertyNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_valuation_roll_edit->PropertyNo->caption(), $property_valuation_roll_edit->PropertyNo->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PropertyNo");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_valuation_roll_edit->PropertyNo->errorMessage()) ?>");
			<?php if ($property_valuation_roll_edit->StandNo->Required) { ?>
				elm = this.getElements("x" + infix + "_StandNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_valuation_roll_edit->StandNo->caption(), $property_valuation_roll_edit->StandNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_valuation_roll_edit->ClientID->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_valuation_roll_edit->ClientID->caption(), $property_valuation_roll_edit->ClientID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_valuation_roll_edit->PropertyGroup->Required) { ?>
				elm = this.getElements("x" + infix + "_PropertyGroup");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_valuation_roll_edit->PropertyGroup->caption(), $property_valuation_roll_edit->PropertyGroup->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PropertyGroup");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_valuation_roll_edit->PropertyGroup->errorMessage()) ?>");
			<?php if ($property_valuation_roll_edit->PropertyType->Required) { ?>
				elm = this.getElements("x" + infix + "_PropertyType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_valuation_roll_edit->PropertyType->caption(), $property_valuation_roll_edit->PropertyType->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PropertyType");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_valuation_roll_edit->PropertyType->errorMessage()) ?>");
			<?php if ($property_valuation_roll_edit->Location->Required) { ?>
				elm = this.getElements("x" + infix + "_Location");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_valuation_roll_edit->Location->caption(), $property_valuation_roll_edit->Location->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_valuation_roll_edit->RollStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_RollStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_valuation_roll_edit->RollStatus->caption(), $property_valuation_roll_edit->RollStatus->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_RollStatus");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_valuation_roll_edit->RollStatus->errorMessage()) ?>");
			<?php if ($property_valuation_roll_edit->UseCode->Required) { ?>
				elm = this.getElements("x" + infix + "_UseCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_valuation_roll_edit->UseCode->caption(), $property_valuation_roll_edit->UseCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_UseCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_valuation_roll_edit->UseCode->errorMessage()) ?>");
			<?php if ($property_valuation_roll_edit->AreaOfLand->Required) { ?>
				elm = this.getElements("x" + infix + "_AreaOfLand");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_valuation_roll_edit->AreaOfLand->caption(), $property_valuation_roll_edit->AreaOfLand->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AreaOfLand");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_valuation_roll_edit->AreaOfLand->errorMessage()) ?>");
			<?php if ($property_valuation_roll_edit->AreaCode->Required) { ?>
				elm = this.getElements("x" + infix + "_AreaCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_valuation_roll_edit->AreaCode->caption(), $property_valuation_roll_edit->AreaCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_valuation_roll_edit->SiteNumber->Required) { ?>
				elm = this.getElements("x" + infix + "_SiteNumber");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_valuation_roll_edit->SiteNumber->caption(), $property_valuation_roll_edit->SiteNumber->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_SiteNumber");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_valuation_roll_edit->SiteNumber->errorMessage()) ?>");
			<?php if ($property_valuation_roll_edit->RateableValue->Required) { ?>
				elm = this.getElements("x" + infix + "_RateableValue");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_valuation_roll_edit->RateableValue->caption(), $property_valuation_roll_edit->RateableValue->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_RateableValue");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_valuation_roll_edit->RateableValue->errorMessage()) ?>");
			<?php if ($property_valuation_roll_edit->NewRateableValue->Required) { ?>
				elm = this.getElements("x" + infix + "_NewRateableValue");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_valuation_roll_edit->NewRateableValue->caption(), $property_valuation_roll_edit->NewRateableValue->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_NewRateableValue");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_valuation_roll_edit->NewRateableValue->errorMessage()) ?>");
			<?php if ($property_valuation_roll_edit->ExemptCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ExemptCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_valuation_roll_edit->ExemptCode->caption(), $property_valuation_roll_edit->ExemptCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ExemptCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_valuation_roll_edit->ExemptCode->errorMessage()) ?>");
			<?php if ($property_valuation_roll_edit->Improvements->Required) { ?>
				elm = this.getElements("x" + infix + "_Improvements");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_valuation_roll_edit->Improvements->caption(), $property_valuation_roll_edit->Improvements->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_valuation_roll_edit->NewImprovements->Required) { ?>
				elm = this.getElements("x" + infix + "_NewImprovements");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_valuation_roll_edit->NewImprovements->caption(), $property_valuation_roll_edit->NewImprovements->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_valuation_roll_edit->Longitude->Required) { ?>
				elm = this.getElements("x" + infix + "_Longitude");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_valuation_roll_edit->Longitude->caption(), $property_valuation_roll_edit->Longitude->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Longitude");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_valuation_roll_edit->Longitude->errorMessage()) ?>");
			<?php if ($property_valuation_roll_edit->Latitude->Required) { ?>
				elm = this.getElements("x" + infix + "_Latitude");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_valuation_roll_edit->Latitude->caption(), $property_valuation_roll_edit->Latitude->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Latitude");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_valuation_roll_edit->Latitude->errorMessage()) ?>");
			<?php if ($property_valuation_roll_edit->PropertyPhoto->Required) { ?>
				felm = this.getElements("x" + infix + "_PropertyPhoto");
				elm = this.getElements("fn_x" + infix + "_PropertyPhoto");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $property_valuation_roll_edit->PropertyPhoto->caption(), $property_valuation_roll_edit->PropertyPhoto->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_valuation_roll_edit->DateEvaluated->Required) { ?>
				elm = this.getElements("x" + infix + "_DateEvaluated");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_valuation_roll_edit->DateEvaluated->caption(), $property_valuation_roll_edit->DateEvaluated->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateEvaluated");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_valuation_roll_edit->DateEvaluated->errorMessage()) ?>");
			<?php if ($property_valuation_roll_edit->Objections->Required) { ?>
				elm = this.getElements("x" + infix + "_Objections");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_valuation_roll_edit->Objections->caption(), $property_valuation_roll_edit->Objections->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_valuation_roll_edit->DateEntered->Required) { ?>
				elm = this.getElements("x" + infix + "_DateEntered");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_valuation_roll_edit->DateEntered->caption(), $property_valuation_roll_edit->DateEntered->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateEntered");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_valuation_roll_edit->DateEntered->errorMessage()) ?>");
			<?php if ($property_valuation_roll_edit->LastUpdatedBy->Required) { ?>
				elm = this.getElements("x" + infix + "_LastUpdatedBy");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_valuation_roll_edit->LastUpdatedBy->caption(), $property_valuation_roll_edit->LastUpdatedBy->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_valuation_roll_edit->LastUpdateDate->Required) { ?>
				elm = this.getElements("x" + infix + "_LastUpdateDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_valuation_roll_edit->LastUpdateDate->caption(), $property_valuation_roll_edit->LastUpdateDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LastUpdateDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_valuation_roll_edit->LastUpdateDate->errorMessage()) ?>");

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
	fproperty_valuation_rolledit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fproperty_valuation_rolledit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fproperty_valuation_rolledit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $property_valuation_roll_edit->showPageHeader(); ?>
<?php
$property_valuation_roll_edit->showMessage();
?>
<?php if (!$property_valuation_roll_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $property_valuation_roll_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fproperty_valuation_rolledit" id="fproperty_valuation_rolledit" class="<?php echo $property_valuation_roll_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="property_valuation_roll">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$property_valuation_roll_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($property_valuation_roll_edit->ValuationNo->Visible) { // ValuationNo ?>
	<div id="r_ValuationNo" class="form-group row">
		<label id="elh_property_valuation_roll_ValuationNo" class="<?php echo $property_valuation_roll_edit->LeftColumnClass ?>"><?php echo $property_valuation_roll_edit->ValuationNo->caption() ?><?php echo $property_valuation_roll_edit->ValuationNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_valuation_roll_edit->RightColumnClass ?>"><div <?php echo $property_valuation_roll_edit->ValuationNo->cellAttributes() ?>>
<span id="el_property_valuation_roll_ValuationNo">
<span<?php echo $property_valuation_roll_edit->ValuationNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_valuation_roll_edit->ValuationNo->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="property_valuation_roll" data-field="x_ValuationNo" name="x_ValuationNo" id="x_ValuationNo" value="<?php echo HtmlEncode($property_valuation_roll_edit->ValuationNo->CurrentValue) ?>">
<?php echo $property_valuation_roll_edit->ValuationNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_valuation_roll_edit->PropertyNo->Visible) { // PropertyNo ?>
	<div id="r_PropertyNo" class="form-group row">
		<label id="elh_property_valuation_roll_PropertyNo" for="x_PropertyNo" class="<?php echo $property_valuation_roll_edit->LeftColumnClass ?>"><?php echo $property_valuation_roll_edit->PropertyNo->caption() ?><?php echo $property_valuation_roll_edit->PropertyNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_valuation_roll_edit->RightColumnClass ?>"><div <?php echo $property_valuation_roll_edit->PropertyNo->cellAttributes() ?>>
<span id="el_property_valuation_roll_PropertyNo">
<input type="text" data-table="property_valuation_roll" data-field="x_PropertyNo" name="x_PropertyNo" id="x_PropertyNo" size="30" placeholder="<?php echo HtmlEncode($property_valuation_roll_edit->PropertyNo->getPlaceHolder()) ?>" value="<?php echo $property_valuation_roll_edit->PropertyNo->EditValue ?>"<?php echo $property_valuation_roll_edit->PropertyNo->editAttributes() ?>>
</span>
<?php echo $property_valuation_roll_edit->PropertyNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_valuation_roll_edit->StandNo->Visible) { // StandNo ?>
	<div id="r_StandNo" class="form-group row">
		<label id="elh_property_valuation_roll_StandNo" for="x_StandNo" class="<?php echo $property_valuation_roll_edit->LeftColumnClass ?>"><?php echo $property_valuation_roll_edit->StandNo->caption() ?><?php echo $property_valuation_roll_edit->StandNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_valuation_roll_edit->RightColumnClass ?>"><div <?php echo $property_valuation_roll_edit->StandNo->cellAttributes() ?>>
<span id="el_property_valuation_roll_StandNo">
<input type="text" data-table="property_valuation_roll" data-field="x_StandNo" name="x_StandNo" id="x_StandNo" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($property_valuation_roll_edit->StandNo->getPlaceHolder()) ?>" value="<?php echo $property_valuation_roll_edit->StandNo->EditValue ?>"<?php echo $property_valuation_roll_edit->StandNo->editAttributes() ?>>
</span>
<?php echo $property_valuation_roll_edit->StandNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_valuation_roll_edit->ClientID->Visible) { // ClientID ?>
	<div id="r_ClientID" class="form-group row">
		<label id="elh_property_valuation_roll_ClientID" for="x_ClientID" class="<?php echo $property_valuation_roll_edit->LeftColumnClass ?>"><?php echo $property_valuation_roll_edit->ClientID->caption() ?><?php echo $property_valuation_roll_edit->ClientID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_valuation_roll_edit->RightColumnClass ?>"><div <?php echo $property_valuation_roll_edit->ClientID->cellAttributes() ?>>
<span id="el_property_valuation_roll_ClientID">
<input type="text" data-table="property_valuation_roll" data-field="x_ClientID" name="x_ClientID" id="x_ClientID" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($property_valuation_roll_edit->ClientID->getPlaceHolder()) ?>" value="<?php echo $property_valuation_roll_edit->ClientID->EditValue ?>"<?php echo $property_valuation_roll_edit->ClientID->editAttributes() ?>>
</span>
<?php echo $property_valuation_roll_edit->ClientID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_valuation_roll_edit->PropertyGroup->Visible) { // PropertyGroup ?>
	<div id="r_PropertyGroup" class="form-group row">
		<label id="elh_property_valuation_roll_PropertyGroup" for="x_PropertyGroup" class="<?php echo $property_valuation_roll_edit->LeftColumnClass ?>"><?php echo $property_valuation_roll_edit->PropertyGroup->caption() ?><?php echo $property_valuation_roll_edit->PropertyGroup->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_valuation_roll_edit->RightColumnClass ?>"><div <?php echo $property_valuation_roll_edit->PropertyGroup->cellAttributes() ?>>
<span id="el_property_valuation_roll_PropertyGroup">
<input type="text" data-table="property_valuation_roll" data-field="x_PropertyGroup" name="x_PropertyGroup" id="x_PropertyGroup" size="30" placeholder="<?php echo HtmlEncode($property_valuation_roll_edit->PropertyGroup->getPlaceHolder()) ?>" value="<?php echo $property_valuation_roll_edit->PropertyGroup->EditValue ?>"<?php echo $property_valuation_roll_edit->PropertyGroup->editAttributes() ?>>
</span>
<?php echo $property_valuation_roll_edit->PropertyGroup->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_valuation_roll_edit->PropertyType->Visible) { // PropertyType ?>
	<div id="r_PropertyType" class="form-group row">
		<label id="elh_property_valuation_roll_PropertyType" for="x_PropertyType" class="<?php echo $property_valuation_roll_edit->LeftColumnClass ?>"><?php echo $property_valuation_roll_edit->PropertyType->caption() ?><?php echo $property_valuation_roll_edit->PropertyType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_valuation_roll_edit->RightColumnClass ?>"><div <?php echo $property_valuation_roll_edit->PropertyType->cellAttributes() ?>>
<span id="el_property_valuation_roll_PropertyType">
<input type="text" data-table="property_valuation_roll" data-field="x_PropertyType" name="x_PropertyType" id="x_PropertyType" size="30" placeholder="<?php echo HtmlEncode($property_valuation_roll_edit->PropertyType->getPlaceHolder()) ?>" value="<?php echo $property_valuation_roll_edit->PropertyType->EditValue ?>"<?php echo $property_valuation_roll_edit->PropertyType->editAttributes() ?>>
</span>
<?php echo $property_valuation_roll_edit->PropertyType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_valuation_roll_edit->Location->Visible) { // Location ?>
	<div id="r_Location" class="form-group row">
		<label id="elh_property_valuation_roll_Location" for="x_Location" class="<?php echo $property_valuation_roll_edit->LeftColumnClass ?>"><?php echo $property_valuation_roll_edit->Location->caption() ?><?php echo $property_valuation_roll_edit->Location->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_valuation_roll_edit->RightColumnClass ?>"><div <?php echo $property_valuation_roll_edit->Location->cellAttributes() ?>>
<span id="el_property_valuation_roll_Location">
<input type="text" data-table="property_valuation_roll" data-field="x_Location" name="x_Location" id="x_Location" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($property_valuation_roll_edit->Location->getPlaceHolder()) ?>" value="<?php echo $property_valuation_roll_edit->Location->EditValue ?>"<?php echo $property_valuation_roll_edit->Location->editAttributes() ?>>
</span>
<?php echo $property_valuation_roll_edit->Location->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_valuation_roll_edit->RollStatus->Visible) { // RollStatus ?>
	<div id="r_RollStatus" class="form-group row">
		<label id="elh_property_valuation_roll_RollStatus" for="x_RollStatus" class="<?php echo $property_valuation_roll_edit->LeftColumnClass ?>"><?php echo $property_valuation_roll_edit->RollStatus->caption() ?><?php echo $property_valuation_roll_edit->RollStatus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_valuation_roll_edit->RightColumnClass ?>"><div <?php echo $property_valuation_roll_edit->RollStatus->cellAttributes() ?>>
<span id="el_property_valuation_roll_RollStatus">
<input type="text" data-table="property_valuation_roll" data-field="x_RollStatus" name="x_RollStatus" id="x_RollStatus" size="30" placeholder="<?php echo HtmlEncode($property_valuation_roll_edit->RollStatus->getPlaceHolder()) ?>" value="<?php echo $property_valuation_roll_edit->RollStatus->EditValue ?>"<?php echo $property_valuation_roll_edit->RollStatus->editAttributes() ?>>
</span>
<?php echo $property_valuation_roll_edit->RollStatus->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_valuation_roll_edit->UseCode->Visible) { // UseCode ?>
	<div id="r_UseCode" class="form-group row">
		<label id="elh_property_valuation_roll_UseCode" for="x_UseCode" class="<?php echo $property_valuation_roll_edit->LeftColumnClass ?>"><?php echo $property_valuation_roll_edit->UseCode->caption() ?><?php echo $property_valuation_roll_edit->UseCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_valuation_roll_edit->RightColumnClass ?>"><div <?php echo $property_valuation_roll_edit->UseCode->cellAttributes() ?>>
<span id="el_property_valuation_roll_UseCode">
<input type="text" data-table="property_valuation_roll" data-field="x_UseCode" name="x_UseCode" id="x_UseCode" size="30" placeholder="<?php echo HtmlEncode($property_valuation_roll_edit->UseCode->getPlaceHolder()) ?>" value="<?php echo $property_valuation_roll_edit->UseCode->EditValue ?>"<?php echo $property_valuation_roll_edit->UseCode->editAttributes() ?>>
</span>
<?php echo $property_valuation_roll_edit->UseCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_valuation_roll_edit->AreaOfLand->Visible) { // AreaOfLand ?>
	<div id="r_AreaOfLand" class="form-group row">
		<label id="elh_property_valuation_roll_AreaOfLand" for="x_AreaOfLand" class="<?php echo $property_valuation_roll_edit->LeftColumnClass ?>"><?php echo $property_valuation_roll_edit->AreaOfLand->caption() ?><?php echo $property_valuation_roll_edit->AreaOfLand->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_valuation_roll_edit->RightColumnClass ?>"><div <?php echo $property_valuation_roll_edit->AreaOfLand->cellAttributes() ?>>
<span id="el_property_valuation_roll_AreaOfLand">
<input type="text" data-table="property_valuation_roll" data-field="x_AreaOfLand" name="x_AreaOfLand" id="x_AreaOfLand" size="30" placeholder="<?php echo HtmlEncode($property_valuation_roll_edit->AreaOfLand->getPlaceHolder()) ?>" value="<?php echo $property_valuation_roll_edit->AreaOfLand->EditValue ?>"<?php echo $property_valuation_roll_edit->AreaOfLand->editAttributes() ?>>
</span>
<?php echo $property_valuation_roll_edit->AreaOfLand->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_valuation_roll_edit->AreaCode->Visible) { // AreaCode ?>
	<div id="r_AreaCode" class="form-group row">
		<label id="elh_property_valuation_roll_AreaCode" for="x_AreaCode" class="<?php echo $property_valuation_roll_edit->LeftColumnClass ?>"><?php echo $property_valuation_roll_edit->AreaCode->caption() ?><?php echo $property_valuation_roll_edit->AreaCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_valuation_roll_edit->RightColumnClass ?>"><div <?php echo $property_valuation_roll_edit->AreaCode->cellAttributes() ?>>
<span id="el_property_valuation_roll_AreaCode">
<input type="text" data-table="property_valuation_roll" data-field="x_AreaCode" name="x_AreaCode" id="x_AreaCode" size="30" maxlength="3" placeholder="<?php echo HtmlEncode($property_valuation_roll_edit->AreaCode->getPlaceHolder()) ?>" value="<?php echo $property_valuation_roll_edit->AreaCode->EditValue ?>"<?php echo $property_valuation_roll_edit->AreaCode->editAttributes() ?>>
</span>
<?php echo $property_valuation_roll_edit->AreaCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_valuation_roll_edit->SiteNumber->Visible) { // SiteNumber ?>
	<div id="r_SiteNumber" class="form-group row">
		<label id="elh_property_valuation_roll_SiteNumber" for="x_SiteNumber" class="<?php echo $property_valuation_roll_edit->LeftColumnClass ?>"><?php echo $property_valuation_roll_edit->SiteNumber->caption() ?><?php echo $property_valuation_roll_edit->SiteNumber->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_valuation_roll_edit->RightColumnClass ?>"><div <?php echo $property_valuation_roll_edit->SiteNumber->cellAttributes() ?>>
<span id="el_property_valuation_roll_SiteNumber">
<input type="text" data-table="property_valuation_roll" data-field="x_SiteNumber" name="x_SiteNumber" id="x_SiteNumber" size="30" placeholder="<?php echo HtmlEncode($property_valuation_roll_edit->SiteNumber->getPlaceHolder()) ?>" value="<?php echo $property_valuation_roll_edit->SiteNumber->EditValue ?>"<?php echo $property_valuation_roll_edit->SiteNumber->editAttributes() ?>>
</span>
<?php echo $property_valuation_roll_edit->SiteNumber->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_valuation_roll_edit->RateableValue->Visible) { // RateableValue ?>
	<div id="r_RateableValue" class="form-group row">
		<label id="elh_property_valuation_roll_RateableValue" for="x_RateableValue" class="<?php echo $property_valuation_roll_edit->LeftColumnClass ?>"><?php echo $property_valuation_roll_edit->RateableValue->caption() ?><?php echo $property_valuation_roll_edit->RateableValue->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_valuation_roll_edit->RightColumnClass ?>"><div <?php echo $property_valuation_roll_edit->RateableValue->cellAttributes() ?>>
<span id="el_property_valuation_roll_RateableValue">
<input type="text" data-table="property_valuation_roll" data-field="x_RateableValue" name="x_RateableValue" id="x_RateableValue" size="30" placeholder="<?php echo HtmlEncode($property_valuation_roll_edit->RateableValue->getPlaceHolder()) ?>" value="<?php echo $property_valuation_roll_edit->RateableValue->EditValue ?>"<?php echo $property_valuation_roll_edit->RateableValue->editAttributes() ?>>
</span>
<?php echo $property_valuation_roll_edit->RateableValue->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_valuation_roll_edit->NewRateableValue->Visible) { // NewRateableValue ?>
	<div id="r_NewRateableValue" class="form-group row">
		<label id="elh_property_valuation_roll_NewRateableValue" for="x_NewRateableValue" class="<?php echo $property_valuation_roll_edit->LeftColumnClass ?>"><?php echo $property_valuation_roll_edit->NewRateableValue->caption() ?><?php echo $property_valuation_roll_edit->NewRateableValue->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_valuation_roll_edit->RightColumnClass ?>"><div <?php echo $property_valuation_roll_edit->NewRateableValue->cellAttributes() ?>>
<span id="el_property_valuation_roll_NewRateableValue">
<input type="text" data-table="property_valuation_roll" data-field="x_NewRateableValue" name="x_NewRateableValue" id="x_NewRateableValue" size="30" placeholder="<?php echo HtmlEncode($property_valuation_roll_edit->NewRateableValue->getPlaceHolder()) ?>" value="<?php echo $property_valuation_roll_edit->NewRateableValue->EditValue ?>"<?php echo $property_valuation_roll_edit->NewRateableValue->editAttributes() ?>>
</span>
<?php echo $property_valuation_roll_edit->NewRateableValue->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_valuation_roll_edit->ExemptCode->Visible) { // ExemptCode ?>
	<div id="r_ExemptCode" class="form-group row">
		<label id="elh_property_valuation_roll_ExemptCode" for="x_ExemptCode" class="<?php echo $property_valuation_roll_edit->LeftColumnClass ?>"><?php echo $property_valuation_roll_edit->ExemptCode->caption() ?><?php echo $property_valuation_roll_edit->ExemptCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_valuation_roll_edit->RightColumnClass ?>"><div <?php echo $property_valuation_roll_edit->ExemptCode->cellAttributes() ?>>
<span id="el_property_valuation_roll_ExemptCode">
<input type="text" data-table="property_valuation_roll" data-field="x_ExemptCode" name="x_ExemptCode" id="x_ExemptCode" size="30" placeholder="<?php echo HtmlEncode($property_valuation_roll_edit->ExemptCode->getPlaceHolder()) ?>" value="<?php echo $property_valuation_roll_edit->ExemptCode->EditValue ?>"<?php echo $property_valuation_roll_edit->ExemptCode->editAttributes() ?>>
</span>
<?php echo $property_valuation_roll_edit->ExemptCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_valuation_roll_edit->Improvements->Visible) { // Improvements ?>
	<div id="r_Improvements" class="form-group row">
		<label id="elh_property_valuation_roll_Improvements" for="x_Improvements" class="<?php echo $property_valuation_roll_edit->LeftColumnClass ?>"><?php echo $property_valuation_roll_edit->Improvements->caption() ?><?php echo $property_valuation_roll_edit->Improvements->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_valuation_roll_edit->RightColumnClass ?>"><div <?php echo $property_valuation_roll_edit->Improvements->cellAttributes() ?>>
<span id="el_property_valuation_roll_Improvements">
<input type="text" data-table="property_valuation_roll" data-field="x_Improvements" name="x_Improvements" id="x_Improvements" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($property_valuation_roll_edit->Improvements->getPlaceHolder()) ?>" value="<?php echo $property_valuation_roll_edit->Improvements->EditValue ?>"<?php echo $property_valuation_roll_edit->Improvements->editAttributes() ?>>
</span>
<?php echo $property_valuation_roll_edit->Improvements->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_valuation_roll_edit->NewImprovements->Visible) { // NewImprovements ?>
	<div id="r_NewImprovements" class="form-group row">
		<label id="elh_property_valuation_roll_NewImprovements" for="x_NewImprovements" class="<?php echo $property_valuation_roll_edit->LeftColumnClass ?>"><?php echo $property_valuation_roll_edit->NewImprovements->caption() ?><?php echo $property_valuation_roll_edit->NewImprovements->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_valuation_roll_edit->RightColumnClass ?>"><div <?php echo $property_valuation_roll_edit->NewImprovements->cellAttributes() ?>>
<span id="el_property_valuation_roll_NewImprovements">
<input type="text" data-table="property_valuation_roll" data-field="x_NewImprovements" name="x_NewImprovements" id="x_NewImprovements" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($property_valuation_roll_edit->NewImprovements->getPlaceHolder()) ?>" value="<?php echo $property_valuation_roll_edit->NewImprovements->EditValue ?>"<?php echo $property_valuation_roll_edit->NewImprovements->editAttributes() ?>>
</span>
<?php echo $property_valuation_roll_edit->NewImprovements->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_valuation_roll_edit->Longitude->Visible) { // Longitude ?>
	<div id="r_Longitude" class="form-group row">
		<label id="elh_property_valuation_roll_Longitude" for="x_Longitude" class="<?php echo $property_valuation_roll_edit->LeftColumnClass ?>"><?php echo $property_valuation_roll_edit->Longitude->caption() ?><?php echo $property_valuation_roll_edit->Longitude->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_valuation_roll_edit->RightColumnClass ?>"><div <?php echo $property_valuation_roll_edit->Longitude->cellAttributes() ?>>
<span id="el_property_valuation_roll_Longitude">
<input type="text" data-table="property_valuation_roll" data-field="x_Longitude" name="x_Longitude" id="x_Longitude" size="30" placeholder="<?php echo HtmlEncode($property_valuation_roll_edit->Longitude->getPlaceHolder()) ?>" value="<?php echo $property_valuation_roll_edit->Longitude->EditValue ?>"<?php echo $property_valuation_roll_edit->Longitude->editAttributes() ?>>
</span>
<?php echo $property_valuation_roll_edit->Longitude->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_valuation_roll_edit->Latitude->Visible) { // Latitude ?>
	<div id="r_Latitude" class="form-group row">
		<label id="elh_property_valuation_roll_Latitude" for="x_Latitude" class="<?php echo $property_valuation_roll_edit->LeftColumnClass ?>"><?php echo $property_valuation_roll_edit->Latitude->caption() ?><?php echo $property_valuation_roll_edit->Latitude->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_valuation_roll_edit->RightColumnClass ?>"><div <?php echo $property_valuation_roll_edit->Latitude->cellAttributes() ?>>
<span id="el_property_valuation_roll_Latitude">
<input type="text" data-table="property_valuation_roll" data-field="x_Latitude" name="x_Latitude" id="x_Latitude" size="30" placeholder="<?php echo HtmlEncode($property_valuation_roll_edit->Latitude->getPlaceHolder()) ?>" value="<?php echo $property_valuation_roll_edit->Latitude->EditValue ?>"<?php echo $property_valuation_roll_edit->Latitude->editAttributes() ?>>
</span>
<?php echo $property_valuation_roll_edit->Latitude->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_valuation_roll_edit->PropertyPhoto->Visible) { // PropertyPhoto ?>
	<div id="r_PropertyPhoto" class="form-group row">
		<label id="elh_property_valuation_roll_PropertyPhoto" class="<?php echo $property_valuation_roll_edit->LeftColumnClass ?>"><?php echo $property_valuation_roll_edit->PropertyPhoto->caption() ?><?php echo $property_valuation_roll_edit->PropertyPhoto->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_valuation_roll_edit->RightColumnClass ?>"><div <?php echo $property_valuation_roll_edit->PropertyPhoto->cellAttributes() ?>>
<span id="el_property_valuation_roll_PropertyPhoto">
<div id="fd_x_PropertyPhoto">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $property_valuation_roll_edit->PropertyPhoto->title() ?>" data-table="property_valuation_roll" data-field="x_PropertyPhoto" name="x_PropertyPhoto" id="x_PropertyPhoto" lang="<?php echo CurrentLanguageID() ?>"<?php echo $property_valuation_roll_edit->PropertyPhoto->editAttributes() ?><?php if ($property_valuation_roll_edit->PropertyPhoto->ReadOnly || $property_valuation_roll_edit->PropertyPhoto->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_PropertyPhoto"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_PropertyPhoto" id= "fn_x_PropertyPhoto" value="<?php echo $property_valuation_roll_edit->PropertyPhoto->Upload->FileName ?>">
<input type="hidden" name="fa_x_PropertyPhoto" id= "fa_x_PropertyPhoto" value="<?php echo (Post("fa_x_PropertyPhoto") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_PropertyPhoto" id= "fs_x_PropertyPhoto" value="0">
<input type="hidden" name="fx_x_PropertyPhoto" id= "fx_x_PropertyPhoto" value="<?php echo $property_valuation_roll_edit->PropertyPhoto->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_PropertyPhoto" id= "fm_x_PropertyPhoto" value="<?php echo $property_valuation_roll_edit->PropertyPhoto->UploadMaxFileSize ?>">
</div>
<table id="ft_x_PropertyPhoto" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $property_valuation_roll_edit->PropertyPhoto->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_valuation_roll_edit->DateEvaluated->Visible) { // DateEvaluated ?>
	<div id="r_DateEvaluated" class="form-group row">
		<label id="elh_property_valuation_roll_DateEvaluated" for="x_DateEvaluated" class="<?php echo $property_valuation_roll_edit->LeftColumnClass ?>"><?php echo $property_valuation_roll_edit->DateEvaluated->caption() ?><?php echo $property_valuation_roll_edit->DateEvaluated->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_valuation_roll_edit->RightColumnClass ?>"><div <?php echo $property_valuation_roll_edit->DateEvaluated->cellAttributes() ?>>
<span id="el_property_valuation_roll_DateEvaluated">
<input type="text" data-table="property_valuation_roll" data-field="x_DateEvaluated" name="x_DateEvaluated" id="x_DateEvaluated" placeholder="<?php echo HtmlEncode($property_valuation_roll_edit->DateEvaluated->getPlaceHolder()) ?>" value="<?php echo $property_valuation_roll_edit->DateEvaluated->EditValue ?>"<?php echo $property_valuation_roll_edit->DateEvaluated->editAttributes() ?>>
</span>
<?php echo $property_valuation_roll_edit->DateEvaluated->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_valuation_roll_edit->Objections->Visible) { // Objections ?>
	<div id="r_Objections" class="form-group row">
		<label id="elh_property_valuation_roll_Objections" for="x_Objections" class="<?php echo $property_valuation_roll_edit->LeftColumnClass ?>"><?php echo $property_valuation_roll_edit->Objections->caption() ?><?php echo $property_valuation_roll_edit->Objections->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_valuation_roll_edit->RightColumnClass ?>"><div <?php echo $property_valuation_roll_edit->Objections->cellAttributes() ?>>
<span id="el_property_valuation_roll_Objections">
<textarea data-table="property_valuation_roll" data-field="x_Objections" name="x_Objections" id="x_Objections" cols="35" rows="4" placeholder="<?php echo HtmlEncode($property_valuation_roll_edit->Objections->getPlaceHolder()) ?>"<?php echo $property_valuation_roll_edit->Objections->editAttributes() ?>><?php echo $property_valuation_roll_edit->Objections->EditValue ?></textarea>
</span>
<?php echo $property_valuation_roll_edit->Objections->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_valuation_roll_edit->DateEntered->Visible) { // DateEntered ?>
	<div id="r_DateEntered" class="form-group row">
		<label id="elh_property_valuation_roll_DateEntered" for="x_DateEntered" class="<?php echo $property_valuation_roll_edit->LeftColumnClass ?>"><?php echo $property_valuation_roll_edit->DateEntered->caption() ?><?php echo $property_valuation_roll_edit->DateEntered->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_valuation_roll_edit->RightColumnClass ?>"><div <?php echo $property_valuation_roll_edit->DateEntered->cellAttributes() ?>>
<span id="el_property_valuation_roll_DateEntered">
<input type="text" data-table="property_valuation_roll" data-field="x_DateEntered" name="x_DateEntered" id="x_DateEntered" placeholder="<?php echo HtmlEncode($property_valuation_roll_edit->DateEntered->getPlaceHolder()) ?>" value="<?php echo $property_valuation_roll_edit->DateEntered->EditValue ?>"<?php echo $property_valuation_roll_edit->DateEntered->editAttributes() ?>>
</span>
<?php echo $property_valuation_roll_edit->DateEntered->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_valuation_roll_edit->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
	<div id="r_LastUpdatedBy" class="form-group row">
		<label id="elh_property_valuation_roll_LastUpdatedBy" for="x_LastUpdatedBy" class="<?php echo $property_valuation_roll_edit->LeftColumnClass ?>"><?php echo $property_valuation_roll_edit->LastUpdatedBy->caption() ?><?php echo $property_valuation_roll_edit->LastUpdatedBy->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_valuation_roll_edit->RightColumnClass ?>"><div <?php echo $property_valuation_roll_edit->LastUpdatedBy->cellAttributes() ?>>
<span id="el_property_valuation_roll_LastUpdatedBy">
<input type="text" data-table="property_valuation_roll" data-field="x_LastUpdatedBy" name="x_LastUpdatedBy" id="x_LastUpdatedBy" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($property_valuation_roll_edit->LastUpdatedBy->getPlaceHolder()) ?>" value="<?php echo $property_valuation_roll_edit->LastUpdatedBy->EditValue ?>"<?php echo $property_valuation_roll_edit->LastUpdatedBy->editAttributes() ?>>
</span>
<?php echo $property_valuation_roll_edit->LastUpdatedBy->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_valuation_roll_edit->LastUpdateDate->Visible) { // LastUpdateDate ?>
	<div id="r_LastUpdateDate" class="form-group row">
		<label id="elh_property_valuation_roll_LastUpdateDate" for="x_LastUpdateDate" class="<?php echo $property_valuation_roll_edit->LeftColumnClass ?>"><?php echo $property_valuation_roll_edit->LastUpdateDate->caption() ?><?php echo $property_valuation_roll_edit->LastUpdateDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_valuation_roll_edit->RightColumnClass ?>"><div <?php echo $property_valuation_roll_edit->LastUpdateDate->cellAttributes() ?>>
<span id="el_property_valuation_roll_LastUpdateDate">
<input type="text" data-table="property_valuation_roll" data-field="x_LastUpdateDate" name="x_LastUpdateDate" id="x_LastUpdateDate" placeholder="<?php echo HtmlEncode($property_valuation_roll_edit->LastUpdateDate->getPlaceHolder()) ?>" value="<?php echo $property_valuation_roll_edit->LastUpdateDate->EditValue ?>"<?php echo $property_valuation_roll_edit->LastUpdateDate->editAttributes() ?>>
</span>
<?php echo $property_valuation_roll_edit->LastUpdateDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$property_valuation_roll_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $property_valuation_roll_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $property_valuation_roll_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$property_valuation_roll_edit->IsModal) { ?>
<?php echo $property_valuation_roll_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$property_valuation_roll_edit->showPageFooter();
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
$property_valuation_roll_edit->terminate();
?>