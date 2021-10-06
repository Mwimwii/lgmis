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
$business_add = new business_add();

// Run the page
$business_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$business_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fbusinessadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fbusinessadd = currentForm = new ew.Form("fbusinessadd", "add");

	// Validate form
	fbusinessadd.validate = function() {
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
			<?php if ($business_add->PACRANo->Required) { ?>
				elm = this.getElements("x" + infix + "_PACRANo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_add->PACRANo->caption(), $business_add->PACRANo->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PACRANo");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($business_add->PACRANo->errorMessage()) ?>");
			<?php if ($business_add->TPIN->Required) { ?>
				elm = this.getElements("x" + infix + "_TPIN");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_add->TPIN->caption(), $business_add->TPIN->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_TPIN");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($business_add->TPIN->errorMessage()) ?>");
			<?php if ($business_add->BusinessName->Required) { ?>
				elm = this.getElements("x" + infix + "_BusinessName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_add->BusinessName->caption(), $business_add->BusinessName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($business_add->ClientID->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_add->ClientID->caption(), $business_add->ClientID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($business_add->BusinessSector->Required) { ?>
				elm = this.getElements("x" + infix + "_BusinessSector");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_add->BusinessSector->caption(), $business_add->BusinessSector->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BusinessSector");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($business_add->BusinessSector->errorMessage()) ?>");
			<?php if ($business_add->BusinessType->Required) { ?>
				elm = this.getElements("x" + infix + "_BusinessType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_add->BusinessType->caption(), $business_add->BusinessType->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BusinessType");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($business_add->BusinessType->errorMessage()) ?>");
			<?php if ($business_add->Location->Required) { ?>
				elm = this.getElements("x" + infix + "_Location");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_add->Location->caption(), $business_add->Location->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($business_add->Turnover->Required) { ?>
				elm = this.getElements("x" + infix + "_Turnover");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_add->Turnover->caption(), $business_add->Turnover->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Turnover");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($business_add->Turnover->errorMessage()) ?>");
			<?php if ($business_add->Branches->Required) { ?>
				elm = this.getElements("x" + infix + "_Branches");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_add->Branches->caption(), $business_add->Branches->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($business_add->NewImprovements->Required) { ?>
				elm = this.getElements("x" + infix + "_NewImprovements");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_add->NewImprovements->caption(), $business_add->NewImprovements->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($business_add->Longitude->Required) { ?>
				elm = this.getElements("x" + infix + "_Longitude");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_add->Longitude->caption(), $business_add->Longitude->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Longitude");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($business_add->Longitude->errorMessage()) ?>");
			<?php if ($business_add->Latitude->Required) { ?>
				elm = this.getElements("x" + infix + "_Latitude");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_add->Latitude->caption(), $business_add->Latitude->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Latitude");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($business_add->Latitude->errorMessage()) ?>");
			<?php if ($business_add->DateOpened->Required) { ?>
				elm = this.getElements("x" + infix + "_DateOpened");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_add->DateOpened->caption(), $business_add->DateOpened->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateOpened");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($business_add->DateOpened->errorMessage()) ?>");
			<?php if ($business_add->BusinessDesc->Required) { ?>
				elm = this.getElements("x" + infix + "_BusinessDesc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_add->BusinessDesc->caption(), $business_add->BusinessDesc->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($business_add->LastUpdatedBy->Required) { ?>
				elm = this.getElements("x" + infix + "_LastUpdatedBy");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_add->LastUpdatedBy->caption(), $business_add->LastUpdatedBy->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($business_add->LastUpdateDate->Required) { ?>
				elm = this.getElements("x" + infix + "_LastUpdateDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_add->LastUpdateDate->caption(), $business_add->LastUpdateDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LastUpdateDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($business_add->LastUpdateDate->errorMessage()) ?>");

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
	fbusinessadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fbusinessadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fbusinessadd.lists["x_ClientID"] = <?php echo $business_add->ClientID->Lookup->toClientList($business_add) ?>;
	fbusinessadd.lists["x_ClientID"].options = <?php echo JsonEncode($business_add->ClientID->lookupOptions()) ?>;
	fbusinessadd.autoSuggests["x_ClientID"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fbusinessadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $business_add->showPageHeader(); ?>
<?php
$business_add->showMessage();
?>
<form name="fbusinessadd" id="fbusinessadd" class="<?php echo $business_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="business">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$business_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($business_add->PACRANo->Visible) { // PACRANo ?>
	<div id="r_PACRANo" class="form-group row">
		<label id="elh_business_PACRANo" for="x_PACRANo" class="<?php echo $business_add->LeftColumnClass ?>"><?php echo $business_add->PACRANo->caption() ?><?php echo $business_add->PACRANo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $business_add->RightColumnClass ?>"><div <?php echo $business_add->PACRANo->cellAttributes() ?>>
<span id="el_business_PACRANo">
<input type="text" data-table="business" data-field="x_PACRANo" name="x_PACRANo" id="x_PACRANo" size="30" placeholder="<?php echo HtmlEncode($business_add->PACRANo->getPlaceHolder()) ?>" value="<?php echo $business_add->PACRANo->EditValue ?>"<?php echo $business_add->PACRANo->editAttributes() ?>>
</span>
<?php echo $business_add->PACRANo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($business_add->TPIN->Visible) { // TPIN ?>
	<div id="r_TPIN" class="form-group row">
		<label id="elh_business_TPIN" for="x_TPIN" class="<?php echo $business_add->LeftColumnClass ?>"><?php echo $business_add->TPIN->caption() ?><?php echo $business_add->TPIN->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $business_add->RightColumnClass ?>"><div <?php echo $business_add->TPIN->cellAttributes() ?>>
<span id="el_business_TPIN">
<input type="text" data-table="business" data-field="x_TPIN" name="x_TPIN" id="x_TPIN" size="30" placeholder="<?php echo HtmlEncode($business_add->TPIN->getPlaceHolder()) ?>" value="<?php echo $business_add->TPIN->EditValue ?>"<?php echo $business_add->TPIN->editAttributes() ?>>
</span>
<?php echo $business_add->TPIN->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($business_add->BusinessName->Visible) { // BusinessName ?>
	<div id="r_BusinessName" class="form-group row">
		<label id="elh_business_BusinessName" for="x_BusinessName" class="<?php echo $business_add->LeftColumnClass ?>"><?php echo $business_add->BusinessName->caption() ?><?php echo $business_add->BusinessName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $business_add->RightColumnClass ?>"><div <?php echo $business_add->BusinessName->cellAttributes() ?>>
<span id="el_business_BusinessName">
<input type="text" data-table="business" data-field="x_BusinessName" name="x_BusinessName" id="x_BusinessName" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($business_add->BusinessName->getPlaceHolder()) ?>" value="<?php echo $business_add->BusinessName->EditValue ?>"<?php echo $business_add->BusinessName->editAttributes() ?>>
</span>
<?php echo $business_add->BusinessName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($business_add->ClientID->Visible) { // ClientID ?>
	<div id="r_ClientID" class="form-group row">
		<label id="elh_business_ClientID" class="<?php echo $business_add->LeftColumnClass ?>"><?php echo $business_add->ClientID->caption() ?><?php echo $business_add->ClientID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $business_add->RightColumnClass ?>"><div <?php echo $business_add->ClientID->cellAttributes() ?>>
<span id="el_business_ClientID">
<?php
$onchange = $business_add->ClientID->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$business_add->ClientID->EditAttrs["onchange"] = "";
?>
<span id="as_x_ClientID">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_ClientID" id="sv_x_ClientID" value="<?php echo RemoveHtml($business_add->ClientID->EditValue) ?>" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($business_add->ClientID->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($business_add->ClientID->getPlaceHolder()) ?>"<?php echo $business_add->ClientID->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($business_add->ClientID->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_ClientID',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($business_add->ClientID->ReadOnly || $business_add->ClientID->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="business" data-field="x_ClientID" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $business_add->ClientID->displayValueSeparatorAttribute() ?>" name="x_ClientID" id="x_ClientID" value="<?php echo HtmlEncode($business_add->ClientID->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fbusinessadd"], function() {
	fbusinessadd.createAutoSuggest({"id":"x_ClientID","forceSelect":false});
});
</script>
<?php echo $business_add->ClientID->Lookup->getParamTag($business_add, "p_x_ClientID") ?>
</span>
<?php echo $business_add->ClientID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($business_add->BusinessSector->Visible) { // BusinessSector ?>
	<div id="r_BusinessSector" class="form-group row">
		<label id="elh_business_BusinessSector" for="x_BusinessSector" class="<?php echo $business_add->LeftColumnClass ?>"><?php echo $business_add->BusinessSector->caption() ?><?php echo $business_add->BusinessSector->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $business_add->RightColumnClass ?>"><div <?php echo $business_add->BusinessSector->cellAttributes() ?>>
<span id="el_business_BusinessSector">
<input type="text" data-table="business" data-field="x_BusinessSector" name="x_BusinessSector" id="x_BusinessSector" size="30" placeholder="<?php echo HtmlEncode($business_add->BusinessSector->getPlaceHolder()) ?>" value="<?php echo $business_add->BusinessSector->EditValue ?>"<?php echo $business_add->BusinessSector->editAttributes() ?>>
</span>
<?php echo $business_add->BusinessSector->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($business_add->BusinessType->Visible) { // BusinessType ?>
	<div id="r_BusinessType" class="form-group row">
		<label id="elh_business_BusinessType" for="x_BusinessType" class="<?php echo $business_add->LeftColumnClass ?>"><?php echo $business_add->BusinessType->caption() ?><?php echo $business_add->BusinessType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $business_add->RightColumnClass ?>"><div <?php echo $business_add->BusinessType->cellAttributes() ?>>
<span id="el_business_BusinessType">
<input type="text" data-table="business" data-field="x_BusinessType" name="x_BusinessType" id="x_BusinessType" size="30" placeholder="<?php echo HtmlEncode($business_add->BusinessType->getPlaceHolder()) ?>" value="<?php echo $business_add->BusinessType->EditValue ?>"<?php echo $business_add->BusinessType->editAttributes() ?>>
</span>
<?php echo $business_add->BusinessType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($business_add->Location->Visible) { // Location ?>
	<div id="r_Location" class="form-group row">
		<label id="elh_business_Location" for="x_Location" class="<?php echo $business_add->LeftColumnClass ?>"><?php echo $business_add->Location->caption() ?><?php echo $business_add->Location->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $business_add->RightColumnClass ?>"><div <?php echo $business_add->Location->cellAttributes() ?>>
<span id="el_business_Location">
<input type="text" data-table="business" data-field="x_Location" name="x_Location" id="x_Location" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($business_add->Location->getPlaceHolder()) ?>" value="<?php echo $business_add->Location->EditValue ?>"<?php echo $business_add->Location->editAttributes() ?>>
</span>
<?php echo $business_add->Location->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($business_add->Turnover->Visible) { // Turnover ?>
	<div id="r_Turnover" class="form-group row">
		<label id="elh_business_Turnover" for="x_Turnover" class="<?php echo $business_add->LeftColumnClass ?>"><?php echo $business_add->Turnover->caption() ?><?php echo $business_add->Turnover->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $business_add->RightColumnClass ?>"><div <?php echo $business_add->Turnover->cellAttributes() ?>>
<span id="el_business_Turnover">
<input type="text" data-table="business" data-field="x_Turnover" name="x_Turnover" id="x_Turnover" size="30" placeholder="<?php echo HtmlEncode($business_add->Turnover->getPlaceHolder()) ?>" value="<?php echo $business_add->Turnover->EditValue ?>"<?php echo $business_add->Turnover->editAttributes() ?>>
</span>
<?php echo $business_add->Turnover->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($business_add->Branches->Visible) { // Branches ?>
	<div id="r_Branches" class="form-group row">
		<label id="elh_business_Branches" for="x_Branches" class="<?php echo $business_add->LeftColumnClass ?>"><?php echo $business_add->Branches->caption() ?><?php echo $business_add->Branches->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $business_add->RightColumnClass ?>"><div <?php echo $business_add->Branches->cellAttributes() ?>>
<span id="el_business_Branches">
<input type="text" data-table="business" data-field="x_Branches" name="x_Branches" id="x_Branches" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($business_add->Branches->getPlaceHolder()) ?>" value="<?php echo $business_add->Branches->EditValue ?>"<?php echo $business_add->Branches->editAttributes() ?>>
</span>
<?php echo $business_add->Branches->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($business_add->NewImprovements->Visible) { // NewImprovements ?>
	<div id="r_NewImprovements" class="form-group row">
		<label id="elh_business_NewImprovements" for="x_NewImprovements" class="<?php echo $business_add->LeftColumnClass ?>"><?php echo $business_add->NewImprovements->caption() ?><?php echo $business_add->NewImprovements->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $business_add->RightColumnClass ?>"><div <?php echo $business_add->NewImprovements->cellAttributes() ?>>
<span id="el_business_NewImprovements">
<textarea data-table="business" data-field="x_NewImprovements" name="x_NewImprovements" id="x_NewImprovements" cols="35" rows="4" placeholder="<?php echo HtmlEncode($business_add->NewImprovements->getPlaceHolder()) ?>"<?php echo $business_add->NewImprovements->editAttributes() ?>><?php echo $business_add->NewImprovements->EditValue ?></textarea>
</span>
<?php echo $business_add->NewImprovements->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($business_add->Longitude->Visible) { // Longitude ?>
	<div id="r_Longitude" class="form-group row">
		<label id="elh_business_Longitude" for="x_Longitude" class="<?php echo $business_add->LeftColumnClass ?>"><?php echo $business_add->Longitude->caption() ?><?php echo $business_add->Longitude->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $business_add->RightColumnClass ?>"><div <?php echo $business_add->Longitude->cellAttributes() ?>>
<span id="el_business_Longitude">
<input type="text" data-table="business" data-field="x_Longitude" name="x_Longitude" id="x_Longitude" size="30" placeholder="<?php echo HtmlEncode($business_add->Longitude->getPlaceHolder()) ?>" value="<?php echo $business_add->Longitude->EditValue ?>"<?php echo $business_add->Longitude->editAttributes() ?>>
</span>
<?php echo $business_add->Longitude->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($business_add->Latitude->Visible) { // Latitude ?>
	<div id="r_Latitude" class="form-group row">
		<label id="elh_business_Latitude" for="x_Latitude" class="<?php echo $business_add->LeftColumnClass ?>"><?php echo $business_add->Latitude->caption() ?><?php echo $business_add->Latitude->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $business_add->RightColumnClass ?>"><div <?php echo $business_add->Latitude->cellAttributes() ?>>
<span id="el_business_Latitude">
<input type="text" data-table="business" data-field="x_Latitude" name="x_Latitude" id="x_Latitude" size="30" placeholder="<?php echo HtmlEncode($business_add->Latitude->getPlaceHolder()) ?>" value="<?php echo $business_add->Latitude->EditValue ?>"<?php echo $business_add->Latitude->editAttributes() ?>>
</span>
<?php echo $business_add->Latitude->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($business_add->DateOpened->Visible) { // DateOpened ?>
	<div id="r_DateOpened" class="form-group row">
		<label id="elh_business_DateOpened" for="x_DateOpened" class="<?php echo $business_add->LeftColumnClass ?>"><?php echo $business_add->DateOpened->caption() ?><?php echo $business_add->DateOpened->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $business_add->RightColumnClass ?>"><div <?php echo $business_add->DateOpened->cellAttributes() ?>>
<span id="el_business_DateOpened">
<input type="text" data-table="business" data-field="x_DateOpened" name="x_DateOpened" id="x_DateOpened" placeholder="<?php echo HtmlEncode($business_add->DateOpened->getPlaceHolder()) ?>" value="<?php echo $business_add->DateOpened->EditValue ?>"<?php echo $business_add->DateOpened->editAttributes() ?>>
<?php if (!$business_add->DateOpened->ReadOnly && !$business_add->DateOpened->Disabled && !isset($business_add->DateOpened->EditAttrs["readonly"]) && !isset($business_add->DateOpened->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fbusinessadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fbusinessadd", "x_DateOpened", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $business_add->DateOpened->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($business_add->BusinessDesc->Visible) { // BusinessDesc ?>
	<div id="r_BusinessDesc" class="form-group row">
		<label id="elh_business_BusinessDesc" for="x_BusinessDesc" class="<?php echo $business_add->LeftColumnClass ?>"><?php echo $business_add->BusinessDesc->caption() ?><?php echo $business_add->BusinessDesc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $business_add->RightColumnClass ?>"><div <?php echo $business_add->BusinessDesc->cellAttributes() ?>>
<span id="el_business_BusinessDesc">
<textarea data-table="business" data-field="x_BusinessDesc" name="x_BusinessDesc" id="x_BusinessDesc" cols="35" rows="4" placeholder="<?php echo HtmlEncode($business_add->BusinessDesc->getPlaceHolder()) ?>"<?php echo $business_add->BusinessDesc->editAttributes() ?>><?php echo $business_add->BusinessDesc->EditValue ?></textarea>
</span>
<?php echo $business_add->BusinessDesc->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($business_add->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
	<div id="r_LastUpdatedBy" class="form-group row">
		<label id="elh_business_LastUpdatedBy" for="x_LastUpdatedBy" class="<?php echo $business_add->LeftColumnClass ?>"><?php echo $business_add->LastUpdatedBy->caption() ?><?php echo $business_add->LastUpdatedBy->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $business_add->RightColumnClass ?>"><div <?php echo $business_add->LastUpdatedBy->cellAttributes() ?>>
<span id="el_business_LastUpdatedBy">
<input type="text" data-table="business" data-field="x_LastUpdatedBy" name="x_LastUpdatedBy" id="x_LastUpdatedBy" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($business_add->LastUpdatedBy->getPlaceHolder()) ?>" value="<?php echo $business_add->LastUpdatedBy->EditValue ?>"<?php echo $business_add->LastUpdatedBy->editAttributes() ?>>
</span>
<?php echo $business_add->LastUpdatedBy->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($business_add->LastUpdateDate->Visible) { // LastUpdateDate ?>
	<div id="r_LastUpdateDate" class="form-group row">
		<label id="elh_business_LastUpdateDate" for="x_LastUpdateDate" class="<?php echo $business_add->LeftColumnClass ?>"><?php echo $business_add->LastUpdateDate->caption() ?><?php echo $business_add->LastUpdateDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $business_add->RightColumnClass ?>"><div <?php echo $business_add->LastUpdateDate->cellAttributes() ?>>
<span id="el_business_LastUpdateDate">
<input type="text" data-table="business" data-field="x_LastUpdateDate" name="x_LastUpdateDate" id="x_LastUpdateDate" placeholder="<?php echo HtmlEncode($business_add->LastUpdateDate->getPlaceHolder()) ?>" value="<?php echo $business_add->LastUpdateDate->EditValue ?>"<?php echo $business_add->LastUpdateDate->editAttributes() ?>>
</span>
<?php echo $business_add->LastUpdateDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("licence_account", explode(",", $business->getCurrentDetailTable())) && $licence_account->DetailAdd) {
?>
<?php if ($business->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("licence_account", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "licence_accountgrid.php" ?>
<?php } ?>
<?php if (!$business_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $business_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $business_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$business_add->showPageFooter();
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
$business_add->terminate();
?>