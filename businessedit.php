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
$business_edit = new business_edit();

// Run the page
$business_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$business_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fbusinessedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fbusinessedit = currentForm = new ew.Form("fbusinessedit", "edit");

	// Validate form
	fbusinessedit.validate = function() {
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
			<?php if ($business_edit->BusinessID->Required) { ?>
				elm = this.getElements("x" + infix + "_BusinessID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_edit->BusinessID->caption(), $business_edit->BusinessID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($business_edit->PACRANo->Required) { ?>
				elm = this.getElements("x" + infix + "_PACRANo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_edit->PACRANo->caption(), $business_edit->PACRANo->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PACRANo");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($business_edit->PACRANo->errorMessage()) ?>");
			<?php if ($business_edit->TPIN->Required) { ?>
				elm = this.getElements("x" + infix + "_TPIN");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_edit->TPIN->caption(), $business_edit->TPIN->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_TPIN");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($business_edit->TPIN->errorMessage()) ?>");
			<?php if ($business_edit->BusinessName->Required) { ?>
				elm = this.getElements("x" + infix + "_BusinessName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_edit->BusinessName->caption(), $business_edit->BusinessName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($business_edit->ClientID->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_edit->ClientID->caption(), $business_edit->ClientID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($business_edit->BusinessSector->Required) { ?>
				elm = this.getElements("x" + infix + "_BusinessSector");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_edit->BusinessSector->caption(), $business_edit->BusinessSector->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BusinessSector");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($business_edit->BusinessSector->errorMessage()) ?>");
			<?php if ($business_edit->BusinessType->Required) { ?>
				elm = this.getElements("x" + infix + "_BusinessType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_edit->BusinessType->caption(), $business_edit->BusinessType->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BusinessType");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($business_edit->BusinessType->errorMessage()) ?>");
			<?php if ($business_edit->Location->Required) { ?>
				elm = this.getElements("x" + infix + "_Location");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_edit->Location->caption(), $business_edit->Location->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($business_edit->Turnover->Required) { ?>
				elm = this.getElements("x" + infix + "_Turnover");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_edit->Turnover->caption(), $business_edit->Turnover->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Turnover");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($business_edit->Turnover->errorMessage()) ?>");
			<?php if ($business_edit->Branches->Required) { ?>
				elm = this.getElements("x" + infix + "_Branches");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_edit->Branches->caption(), $business_edit->Branches->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($business_edit->NewImprovements->Required) { ?>
				elm = this.getElements("x" + infix + "_NewImprovements");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_edit->NewImprovements->caption(), $business_edit->NewImprovements->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($business_edit->Longitude->Required) { ?>
				elm = this.getElements("x" + infix + "_Longitude");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_edit->Longitude->caption(), $business_edit->Longitude->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Longitude");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($business_edit->Longitude->errorMessage()) ?>");
			<?php if ($business_edit->Latitude->Required) { ?>
				elm = this.getElements("x" + infix + "_Latitude");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_edit->Latitude->caption(), $business_edit->Latitude->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Latitude");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($business_edit->Latitude->errorMessage()) ?>");
			<?php if ($business_edit->DateOpened->Required) { ?>
				elm = this.getElements("x" + infix + "_DateOpened");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_edit->DateOpened->caption(), $business_edit->DateOpened->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateOpened");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($business_edit->DateOpened->errorMessage()) ?>");
			<?php if ($business_edit->BusinessDesc->Required) { ?>
				elm = this.getElements("x" + infix + "_BusinessDesc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_edit->BusinessDesc->caption(), $business_edit->BusinessDesc->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($business_edit->LastUpdatedBy->Required) { ?>
				elm = this.getElements("x" + infix + "_LastUpdatedBy");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_edit->LastUpdatedBy->caption(), $business_edit->LastUpdatedBy->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($business_edit->LastUpdateDate->Required) { ?>
				elm = this.getElements("x" + infix + "_LastUpdateDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_edit->LastUpdateDate->caption(), $business_edit->LastUpdateDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LastUpdateDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($business_edit->LastUpdateDate->errorMessage()) ?>");

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
	fbusinessedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fbusinessedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fbusinessedit.lists["x_ClientID"] = <?php echo $business_edit->ClientID->Lookup->toClientList($business_edit) ?>;
	fbusinessedit.lists["x_ClientID"].options = <?php echo JsonEncode($business_edit->ClientID->lookupOptions()) ?>;
	fbusinessedit.autoSuggests["x_ClientID"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fbusinessedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $business_edit->showPageHeader(); ?>
<?php
$business_edit->showMessage();
?>
<?php if (!$business_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $business_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fbusinessedit" id="fbusinessedit" class="<?php echo $business_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="business">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$business_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($business_edit->BusinessID->Visible) { // BusinessID ?>
	<div id="r_BusinessID" class="form-group row">
		<label id="elh_business_BusinessID" class="<?php echo $business_edit->LeftColumnClass ?>"><?php echo $business_edit->BusinessID->caption() ?><?php echo $business_edit->BusinessID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $business_edit->RightColumnClass ?>"><div <?php echo $business_edit->BusinessID->cellAttributes() ?>>
<span id="el_business_BusinessID">
<span<?php echo $business_edit->BusinessID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($business_edit->BusinessID->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="business" data-field="x_BusinessID" name="x_BusinessID" id="x_BusinessID" value="<?php echo HtmlEncode($business_edit->BusinessID->CurrentValue) ?>">
<?php echo $business_edit->BusinessID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($business_edit->PACRANo->Visible) { // PACRANo ?>
	<div id="r_PACRANo" class="form-group row">
		<label id="elh_business_PACRANo" for="x_PACRANo" class="<?php echo $business_edit->LeftColumnClass ?>"><?php echo $business_edit->PACRANo->caption() ?><?php echo $business_edit->PACRANo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $business_edit->RightColumnClass ?>"><div <?php echo $business_edit->PACRANo->cellAttributes() ?>>
<span id="el_business_PACRANo">
<input type="text" data-table="business" data-field="x_PACRANo" name="x_PACRANo" id="x_PACRANo" size="30" placeholder="<?php echo HtmlEncode($business_edit->PACRANo->getPlaceHolder()) ?>" value="<?php echo $business_edit->PACRANo->EditValue ?>"<?php echo $business_edit->PACRANo->editAttributes() ?>>
</span>
<?php echo $business_edit->PACRANo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($business_edit->TPIN->Visible) { // TPIN ?>
	<div id="r_TPIN" class="form-group row">
		<label id="elh_business_TPIN" for="x_TPIN" class="<?php echo $business_edit->LeftColumnClass ?>"><?php echo $business_edit->TPIN->caption() ?><?php echo $business_edit->TPIN->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $business_edit->RightColumnClass ?>"><div <?php echo $business_edit->TPIN->cellAttributes() ?>>
<span id="el_business_TPIN">
<input type="text" data-table="business" data-field="x_TPIN" name="x_TPIN" id="x_TPIN" size="30" placeholder="<?php echo HtmlEncode($business_edit->TPIN->getPlaceHolder()) ?>" value="<?php echo $business_edit->TPIN->EditValue ?>"<?php echo $business_edit->TPIN->editAttributes() ?>>
</span>
<?php echo $business_edit->TPIN->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($business_edit->BusinessName->Visible) { // BusinessName ?>
	<div id="r_BusinessName" class="form-group row">
		<label id="elh_business_BusinessName" for="x_BusinessName" class="<?php echo $business_edit->LeftColumnClass ?>"><?php echo $business_edit->BusinessName->caption() ?><?php echo $business_edit->BusinessName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $business_edit->RightColumnClass ?>"><div <?php echo $business_edit->BusinessName->cellAttributes() ?>>
<span id="el_business_BusinessName">
<input type="text" data-table="business" data-field="x_BusinessName" name="x_BusinessName" id="x_BusinessName" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($business_edit->BusinessName->getPlaceHolder()) ?>" value="<?php echo $business_edit->BusinessName->EditValue ?>"<?php echo $business_edit->BusinessName->editAttributes() ?>>
</span>
<?php echo $business_edit->BusinessName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($business_edit->ClientID->Visible) { // ClientID ?>
	<div id="r_ClientID" class="form-group row">
		<label id="elh_business_ClientID" class="<?php echo $business_edit->LeftColumnClass ?>"><?php echo $business_edit->ClientID->caption() ?><?php echo $business_edit->ClientID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $business_edit->RightColumnClass ?>"><div <?php echo $business_edit->ClientID->cellAttributes() ?>>
<span id="el_business_ClientID">
<?php
$onchange = $business_edit->ClientID->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$business_edit->ClientID->EditAttrs["onchange"] = "";
?>
<span id="as_x_ClientID">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_ClientID" id="sv_x_ClientID" value="<?php echo RemoveHtml($business_edit->ClientID->EditValue) ?>" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($business_edit->ClientID->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($business_edit->ClientID->getPlaceHolder()) ?>"<?php echo $business_edit->ClientID->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($business_edit->ClientID->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_ClientID',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($business_edit->ClientID->ReadOnly || $business_edit->ClientID->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="business" data-field="x_ClientID" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $business_edit->ClientID->displayValueSeparatorAttribute() ?>" name="x_ClientID" id="x_ClientID" value="<?php echo HtmlEncode($business_edit->ClientID->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fbusinessedit"], function() {
	fbusinessedit.createAutoSuggest({"id":"x_ClientID","forceSelect":false});
});
</script>
<?php echo $business_edit->ClientID->Lookup->getParamTag($business_edit, "p_x_ClientID") ?>
</span>
<?php echo $business_edit->ClientID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($business_edit->BusinessSector->Visible) { // BusinessSector ?>
	<div id="r_BusinessSector" class="form-group row">
		<label id="elh_business_BusinessSector" for="x_BusinessSector" class="<?php echo $business_edit->LeftColumnClass ?>"><?php echo $business_edit->BusinessSector->caption() ?><?php echo $business_edit->BusinessSector->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $business_edit->RightColumnClass ?>"><div <?php echo $business_edit->BusinessSector->cellAttributes() ?>>
<span id="el_business_BusinessSector">
<input type="text" data-table="business" data-field="x_BusinessSector" name="x_BusinessSector" id="x_BusinessSector" size="30" placeholder="<?php echo HtmlEncode($business_edit->BusinessSector->getPlaceHolder()) ?>" value="<?php echo $business_edit->BusinessSector->EditValue ?>"<?php echo $business_edit->BusinessSector->editAttributes() ?>>
</span>
<?php echo $business_edit->BusinessSector->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($business_edit->BusinessType->Visible) { // BusinessType ?>
	<div id="r_BusinessType" class="form-group row">
		<label id="elh_business_BusinessType" for="x_BusinessType" class="<?php echo $business_edit->LeftColumnClass ?>"><?php echo $business_edit->BusinessType->caption() ?><?php echo $business_edit->BusinessType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $business_edit->RightColumnClass ?>"><div <?php echo $business_edit->BusinessType->cellAttributes() ?>>
<span id="el_business_BusinessType">
<input type="text" data-table="business" data-field="x_BusinessType" name="x_BusinessType" id="x_BusinessType" size="30" placeholder="<?php echo HtmlEncode($business_edit->BusinessType->getPlaceHolder()) ?>" value="<?php echo $business_edit->BusinessType->EditValue ?>"<?php echo $business_edit->BusinessType->editAttributes() ?>>
</span>
<?php echo $business_edit->BusinessType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($business_edit->Location->Visible) { // Location ?>
	<div id="r_Location" class="form-group row">
		<label id="elh_business_Location" for="x_Location" class="<?php echo $business_edit->LeftColumnClass ?>"><?php echo $business_edit->Location->caption() ?><?php echo $business_edit->Location->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $business_edit->RightColumnClass ?>"><div <?php echo $business_edit->Location->cellAttributes() ?>>
<span id="el_business_Location">
<input type="text" data-table="business" data-field="x_Location" name="x_Location" id="x_Location" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($business_edit->Location->getPlaceHolder()) ?>" value="<?php echo $business_edit->Location->EditValue ?>"<?php echo $business_edit->Location->editAttributes() ?>>
</span>
<?php echo $business_edit->Location->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($business_edit->Turnover->Visible) { // Turnover ?>
	<div id="r_Turnover" class="form-group row">
		<label id="elh_business_Turnover" for="x_Turnover" class="<?php echo $business_edit->LeftColumnClass ?>"><?php echo $business_edit->Turnover->caption() ?><?php echo $business_edit->Turnover->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $business_edit->RightColumnClass ?>"><div <?php echo $business_edit->Turnover->cellAttributes() ?>>
<span id="el_business_Turnover">
<input type="text" data-table="business" data-field="x_Turnover" name="x_Turnover" id="x_Turnover" size="30" placeholder="<?php echo HtmlEncode($business_edit->Turnover->getPlaceHolder()) ?>" value="<?php echo $business_edit->Turnover->EditValue ?>"<?php echo $business_edit->Turnover->editAttributes() ?>>
</span>
<?php echo $business_edit->Turnover->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($business_edit->Branches->Visible) { // Branches ?>
	<div id="r_Branches" class="form-group row">
		<label id="elh_business_Branches" for="x_Branches" class="<?php echo $business_edit->LeftColumnClass ?>"><?php echo $business_edit->Branches->caption() ?><?php echo $business_edit->Branches->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $business_edit->RightColumnClass ?>"><div <?php echo $business_edit->Branches->cellAttributes() ?>>
<span id="el_business_Branches">
<input type="text" data-table="business" data-field="x_Branches" name="x_Branches" id="x_Branches" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($business_edit->Branches->getPlaceHolder()) ?>" value="<?php echo $business_edit->Branches->EditValue ?>"<?php echo $business_edit->Branches->editAttributes() ?>>
</span>
<?php echo $business_edit->Branches->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($business_edit->NewImprovements->Visible) { // NewImprovements ?>
	<div id="r_NewImprovements" class="form-group row">
		<label id="elh_business_NewImprovements" for="x_NewImprovements" class="<?php echo $business_edit->LeftColumnClass ?>"><?php echo $business_edit->NewImprovements->caption() ?><?php echo $business_edit->NewImprovements->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $business_edit->RightColumnClass ?>"><div <?php echo $business_edit->NewImprovements->cellAttributes() ?>>
<span id="el_business_NewImprovements">
<textarea data-table="business" data-field="x_NewImprovements" name="x_NewImprovements" id="x_NewImprovements" cols="35" rows="4" placeholder="<?php echo HtmlEncode($business_edit->NewImprovements->getPlaceHolder()) ?>"<?php echo $business_edit->NewImprovements->editAttributes() ?>><?php echo $business_edit->NewImprovements->EditValue ?></textarea>
</span>
<?php echo $business_edit->NewImprovements->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($business_edit->Longitude->Visible) { // Longitude ?>
	<div id="r_Longitude" class="form-group row">
		<label id="elh_business_Longitude" for="x_Longitude" class="<?php echo $business_edit->LeftColumnClass ?>"><?php echo $business_edit->Longitude->caption() ?><?php echo $business_edit->Longitude->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $business_edit->RightColumnClass ?>"><div <?php echo $business_edit->Longitude->cellAttributes() ?>>
<span id="el_business_Longitude">
<input type="text" data-table="business" data-field="x_Longitude" name="x_Longitude" id="x_Longitude" size="30" placeholder="<?php echo HtmlEncode($business_edit->Longitude->getPlaceHolder()) ?>" value="<?php echo $business_edit->Longitude->EditValue ?>"<?php echo $business_edit->Longitude->editAttributes() ?>>
</span>
<?php echo $business_edit->Longitude->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($business_edit->Latitude->Visible) { // Latitude ?>
	<div id="r_Latitude" class="form-group row">
		<label id="elh_business_Latitude" for="x_Latitude" class="<?php echo $business_edit->LeftColumnClass ?>"><?php echo $business_edit->Latitude->caption() ?><?php echo $business_edit->Latitude->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $business_edit->RightColumnClass ?>"><div <?php echo $business_edit->Latitude->cellAttributes() ?>>
<span id="el_business_Latitude">
<input type="text" data-table="business" data-field="x_Latitude" name="x_Latitude" id="x_Latitude" size="30" placeholder="<?php echo HtmlEncode($business_edit->Latitude->getPlaceHolder()) ?>" value="<?php echo $business_edit->Latitude->EditValue ?>"<?php echo $business_edit->Latitude->editAttributes() ?>>
</span>
<?php echo $business_edit->Latitude->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($business_edit->DateOpened->Visible) { // DateOpened ?>
	<div id="r_DateOpened" class="form-group row">
		<label id="elh_business_DateOpened" for="x_DateOpened" class="<?php echo $business_edit->LeftColumnClass ?>"><?php echo $business_edit->DateOpened->caption() ?><?php echo $business_edit->DateOpened->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $business_edit->RightColumnClass ?>"><div <?php echo $business_edit->DateOpened->cellAttributes() ?>>
<span id="el_business_DateOpened">
<input type="text" data-table="business" data-field="x_DateOpened" name="x_DateOpened" id="x_DateOpened" placeholder="<?php echo HtmlEncode($business_edit->DateOpened->getPlaceHolder()) ?>" value="<?php echo $business_edit->DateOpened->EditValue ?>"<?php echo $business_edit->DateOpened->editAttributes() ?>>
<?php if (!$business_edit->DateOpened->ReadOnly && !$business_edit->DateOpened->Disabled && !isset($business_edit->DateOpened->EditAttrs["readonly"]) && !isset($business_edit->DateOpened->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fbusinessedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fbusinessedit", "x_DateOpened", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $business_edit->DateOpened->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($business_edit->BusinessDesc->Visible) { // BusinessDesc ?>
	<div id="r_BusinessDesc" class="form-group row">
		<label id="elh_business_BusinessDesc" for="x_BusinessDesc" class="<?php echo $business_edit->LeftColumnClass ?>"><?php echo $business_edit->BusinessDesc->caption() ?><?php echo $business_edit->BusinessDesc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $business_edit->RightColumnClass ?>"><div <?php echo $business_edit->BusinessDesc->cellAttributes() ?>>
<span id="el_business_BusinessDesc">
<textarea data-table="business" data-field="x_BusinessDesc" name="x_BusinessDesc" id="x_BusinessDesc" cols="35" rows="4" placeholder="<?php echo HtmlEncode($business_edit->BusinessDesc->getPlaceHolder()) ?>"<?php echo $business_edit->BusinessDesc->editAttributes() ?>><?php echo $business_edit->BusinessDesc->EditValue ?></textarea>
</span>
<?php echo $business_edit->BusinessDesc->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($business_edit->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
	<div id="r_LastUpdatedBy" class="form-group row">
		<label id="elh_business_LastUpdatedBy" for="x_LastUpdatedBy" class="<?php echo $business_edit->LeftColumnClass ?>"><?php echo $business_edit->LastUpdatedBy->caption() ?><?php echo $business_edit->LastUpdatedBy->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $business_edit->RightColumnClass ?>"><div <?php echo $business_edit->LastUpdatedBy->cellAttributes() ?>>
<span id="el_business_LastUpdatedBy">
<input type="text" data-table="business" data-field="x_LastUpdatedBy" name="x_LastUpdatedBy" id="x_LastUpdatedBy" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($business_edit->LastUpdatedBy->getPlaceHolder()) ?>" value="<?php echo $business_edit->LastUpdatedBy->EditValue ?>"<?php echo $business_edit->LastUpdatedBy->editAttributes() ?>>
</span>
<?php echo $business_edit->LastUpdatedBy->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($business_edit->LastUpdateDate->Visible) { // LastUpdateDate ?>
	<div id="r_LastUpdateDate" class="form-group row">
		<label id="elh_business_LastUpdateDate" for="x_LastUpdateDate" class="<?php echo $business_edit->LeftColumnClass ?>"><?php echo $business_edit->LastUpdateDate->caption() ?><?php echo $business_edit->LastUpdateDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $business_edit->RightColumnClass ?>"><div <?php echo $business_edit->LastUpdateDate->cellAttributes() ?>>
<span id="el_business_LastUpdateDate">
<input type="text" data-table="business" data-field="x_LastUpdateDate" name="x_LastUpdateDate" id="x_LastUpdateDate" placeholder="<?php echo HtmlEncode($business_edit->LastUpdateDate->getPlaceHolder()) ?>" value="<?php echo $business_edit->LastUpdateDate->EditValue ?>"<?php echo $business_edit->LastUpdateDate->editAttributes() ?>>
</span>
<?php echo $business_edit->LastUpdateDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("licence_account", explode(",", $business->getCurrentDetailTable())) && $licence_account->DetailEdit) {
?>
<?php if ($business->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("licence_account", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "licence_accountgrid.php" ?>
<?php } ?>
<?php if (!$business_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $business_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $business_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$business_edit->IsModal) { ?>
<?php echo $business_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$business_edit->showPageFooter();
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
$business_edit->terminate();
?>