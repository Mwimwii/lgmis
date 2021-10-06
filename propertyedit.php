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
$property_edit = new property_edit();

// Run the page
$property_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$property_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpropertyedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fpropertyedit = currentForm = new ew.Form("fpropertyedit", "edit");

	// Validate form
	fpropertyedit.validate = function() {
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
			<?php if ($property_edit->PropertyNo->Required) { ?>
				elm = this.getElements("x" + infix + "_PropertyNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_edit->PropertyNo->caption(), $property_edit->PropertyNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_edit->ClientSerNo->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientSerNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_edit->ClientSerNo->caption(), $property_edit->ClientSerNo->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ClientSerNo");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_edit->ClientSerNo->errorMessage()) ?>");
			<?php if ($property_edit->ClientID->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_edit->ClientID->caption(), $property_edit->ClientID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_edit->PropertyGroup->Required) { ?>
				elm = this.getElements("x" + infix + "_PropertyGroup");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_edit->PropertyGroup->caption(), $property_edit->PropertyGroup->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_edit->PropertyType->Required) { ?>
				elm = this.getElements("x" + infix + "_PropertyType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_edit->PropertyType->caption(), $property_edit->PropertyType->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PropertyType");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_edit->PropertyType->errorMessage()) ?>");
			<?php if ($property_edit->Location->Required) { ?>
				elm = this.getElements("x" + infix + "_Location[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_edit->Location->caption(), $property_edit->Location->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_edit->PropertyStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_PropertyStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_edit->PropertyStatus->caption(), $property_edit->PropertyStatus->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PropertyStatus");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_edit->PropertyStatus->errorMessage()) ?>");
			<?php if ($property_edit->PropertyUse->Required) { ?>
				elm = this.getElements("x" + infix + "_PropertyUse[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_edit->PropertyUse->caption(), $property_edit->PropertyUse->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_edit->LandExtentInHA->Required) { ?>
				elm = this.getElements("x" + infix + "_LandExtentInHA");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_edit->LandExtentInHA->caption(), $property_edit->LandExtentInHA->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LandExtentInHA");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_edit->LandExtentInHA->errorMessage()) ?>");
			<?php if ($property_edit->RateableValue->Required) { ?>
				elm = this.getElements("x" + infix + "_RateableValue");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_edit->RateableValue->caption(), $property_edit->RateableValue->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_RateableValue");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_edit->RateableValue->errorMessage()) ?>");
			<?php if ($property_edit->SupplementaryValue->Required) { ?>
				elm = this.getElements("x" + infix + "_SupplementaryValue");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_edit->SupplementaryValue->caption(), $property_edit->SupplementaryValue->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_SupplementaryValue");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_edit->SupplementaryValue->errorMessage()) ?>");
			<?php if ($property_edit->ExemptCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ExemptCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_edit->ExemptCode->caption(), $property_edit->ExemptCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ExemptCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_edit->ExemptCode->errorMessage()) ?>");
			<?php if ($property_edit->Improvements->Required) { ?>
				elm = this.getElements("x" + infix + "_Improvements");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_edit->Improvements->caption(), $property_edit->Improvements->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_edit->StreetAddress->Required) { ?>
				elm = this.getElements("x" + infix + "_StreetAddress");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_edit->StreetAddress->caption(), $property_edit->StreetAddress->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_edit->Longitude->Required) { ?>
				elm = this.getElements("x" + infix + "_Longitude");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_edit->Longitude->caption(), $property_edit->Longitude->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Longitude");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_edit->Longitude->errorMessage()) ?>");
			<?php if ($property_edit->Latitude->Required) { ?>
				elm = this.getElements("x" + infix + "_Latitude");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_edit->Latitude->caption(), $property_edit->Latitude->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Latitude");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_edit->Latitude->errorMessage()) ?>");
			<?php if ($property_edit->Incumberance->Required) { ?>
				elm = this.getElements("x" + infix + "_Incumberance");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_edit->Incumberance->caption(), $property_edit->Incumberance->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_edit->SubDivisionOf->Required) { ?>
				elm = this.getElements("x" + infix + "_SubDivisionOf");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_edit->SubDivisionOf->caption(), $property_edit->SubDivisionOf->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_SubDivisionOf");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_edit->SubDivisionOf->errorMessage()) ?>");
			<?php if ($property_edit->LastUpdatedBy->Required) { ?>
				elm = this.getElements("x" + infix + "_LastUpdatedBy");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_edit->LastUpdatedBy->caption(), $property_edit->LastUpdatedBy->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_edit->LastUpdateDate->Required) { ?>
				elm = this.getElements("x" + infix + "_LastUpdateDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_edit->LastUpdateDate->caption(), $property_edit->LastUpdateDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LastUpdateDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_edit->LastUpdateDate->errorMessage()) ?>");
			<?php if ($property_edit->ValuationNo->Required) { ?>
				elm = this.getElements("x" + infix + "_ValuationNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_edit->ValuationNo->caption(), $property_edit->ValuationNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_edit->LandValue->Required) { ?>
				elm = this.getElements("x" + infix + "_LandValue");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_edit->LandValue->caption(), $property_edit->LandValue->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LandValue");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_edit->LandValue->errorMessage()) ?>");
			<?php if ($property_edit->ImprovementsValue->Required) { ?>
				elm = this.getElements("x" + infix + "_ImprovementsValue");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_edit->ImprovementsValue->caption(), $property_edit->ImprovementsValue->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ImprovementsValue");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_edit->ImprovementsValue->errorMessage()) ?>");

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
	fpropertyedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpropertyedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fpropertyedit.lists["x_ClientSerNo"] = <?php echo $property_edit->ClientSerNo->Lookup->toClientList($property_edit) ?>;
	fpropertyedit.lists["x_ClientSerNo"].options = <?php echo JsonEncode($property_edit->ClientSerNo->lookupOptions()) ?>;
	fpropertyedit.autoSuggests["x_ClientSerNo"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fpropertyedit.lists["x_ClientID"] = <?php echo $property_edit->ClientID->Lookup->toClientList($property_edit) ?>;
	fpropertyedit.lists["x_ClientID"].options = <?php echo JsonEncode($property_edit->ClientID->lookupOptions()) ?>;
	fpropertyedit.autoSuggests["x_ClientID"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fpropertyedit.lists["x_PropertyGroup"] = <?php echo $property_edit->PropertyGroup->Lookup->toClientList($property_edit) ?>;
	fpropertyedit.lists["x_PropertyGroup"].options = <?php echo JsonEncode($property_edit->PropertyGroup->lookupOptions()) ?>;
	fpropertyedit.lists["x_PropertyType"] = <?php echo $property_edit->PropertyType->Lookup->toClientList($property_edit) ?>;
	fpropertyedit.lists["x_PropertyType"].options = <?php echo JsonEncode($property_edit->PropertyType->lookupOptions()) ?>;
	fpropertyedit.autoSuggests["x_PropertyType"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fpropertyedit.lists["x_Location[]"] = <?php echo $property_edit->Location->Lookup->toClientList($property_edit) ?>;
	fpropertyedit.lists["x_Location[]"].options = <?php echo JsonEncode($property_edit->Location->lookupOptions()) ?>;
	fpropertyedit.lists["x_PropertyUse[]"] = <?php echo $property_edit->PropertyUse->Lookup->toClientList($property_edit) ?>;
	fpropertyedit.lists["x_PropertyUse[]"].options = <?php echo JsonEncode($property_edit->PropertyUse->lookupOptions()) ?>;
	loadjs.done("fpropertyedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $property_edit->showPageHeader(); ?>
<?php
$property_edit->showMessage();
?>
<?php if (!$property_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $property_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fpropertyedit" id="fpropertyedit" class="<?php echo $property_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="property">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$property_edit->IsModal ?>">
<?php if ($property->getCurrentMasterTable() == "client") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="client">
<input type="hidden" name="fk_ClientSerNo" value="<?php echo HtmlEncode($property_edit->ClientSerNo->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($property_edit->PropertyNo->Visible) { // PropertyNo ?>
	<div id="r_PropertyNo" class="form-group row">
		<label id="elh_property_PropertyNo" for="x_PropertyNo" class="<?php echo $property_edit->LeftColumnClass ?>"><?php echo $property_edit->PropertyNo->caption() ?><?php echo $property_edit->PropertyNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_edit->RightColumnClass ?>"><div <?php echo $property_edit->PropertyNo->cellAttributes() ?>>
<span id="el_property_PropertyNo">
<input type="text" data-table="property" data-field="x_PropertyNo" name="x_PropertyNo" id="x_PropertyNo" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($property_edit->PropertyNo->getPlaceHolder()) ?>" value="<?php echo $property_edit->PropertyNo->EditValue ?>"<?php echo $property_edit->PropertyNo->editAttributes() ?>>
</span>
<?php echo $property_edit->PropertyNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_edit->ClientSerNo->Visible) { // ClientSerNo ?>
	<div id="r_ClientSerNo" class="form-group row">
		<label id="elh_property_ClientSerNo" class="<?php echo $property_edit->LeftColumnClass ?>"><?php echo $property_edit->ClientSerNo->caption() ?><?php echo $property_edit->ClientSerNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_edit->RightColumnClass ?>"><div <?php echo $property_edit->ClientSerNo->cellAttributes() ?>>
<?php if ($property_edit->ClientSerNo->getSessionValue() != "") { ?>
<span id="el_property_ClientSerNo">
<span<?php echo $property_edit->ClientSerNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_edit->ClientSerNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_ClientSerNo" name="x_ClientSerNo" value="<?php echo HtmlEncode($property_edit->ClientSerNo->CurrentValue) ?>">
<?php } else { ?>
<span id="el_property_ClientSerNo">
<?php
$onchange = $property_edit->ClientSerNo->EditAttrs->prepend("onchange", "ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$property_edit->ClientSerNo->EditAttrs["onchange"] = "";
?>
<span id="as_x_ClientSerNo">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_ClientSerNo" id="sv_x_ClientSerNo" value="<?php echo RemoveHtml($property_edit->ClientSerNo->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($property_edit->ClientSerNo->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($property_edit->ClientSerNo->getPlaceHolder()) ?>"<?php echo $property_edit->ClientSerNo->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($property_edit->ClientSerNo->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_ClientSerNo',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($property_edit->ClientSerNo->ReadOnly || $property_edit->ClientSerNo->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="property" data-field="x_ClientSerNo" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $property_edit->ClientSerNo->displayValueSeparatorAttribute() ?>" name="x_ClientSerNo" id="x_ClientSerNo" value="<?php echo HtmlEncode($property_edit->ClientSerNo->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fpropertyedit"], function() {
	fpropertyedit.createAutoSuggest({"id":"x_ClientSerNo","forceSelect":true});
});
</script>
<?php echo $property_edit->ClientSerNo->Lookup->getParamTag($property_edit, "p_x_ClientSerNo") ?>
</span>
<?php } ?>
<?php echo $property_edit->ClientSerNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_edit->ClientID->Visible) { // ClientID ?>
	<div id="r_ClientID" class="form-group row">
		<label id="elh_property_ClientID" class="<?php echo $property_edit->LeftColumnClass ?>"><?php echo $property_edit->ClientID->caption() ?><?php echo $property_edit->ClientID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_edit->RightColumnClass ?>"><div <?php echo $property_edit->ClientID->cellAttributes() ?>>
<span id="el_property_ClientID">
<?php
$onchange = $property_edit->ClientID->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$property_edit->ClientID->EditAttrs["onchange"] = "";
?>
<span id="as_x_ClientID">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_ClientID" id="sv_x_ClientID" value="<?php echo RemoveHtml($property_edit->ClientID->EditValue) ?>" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($property_edit->ClientID->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($property_edit->ClientID->getPlaceHolder()) ?>"<?php echo $property_edit->ClientID->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($property_edit->ClientID->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_ClientID',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($property_edit->ClientID->ReadOnly || $property_edit->ClientID->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="property" data-field="x_ClientID" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $property_edit->ClientID->displayValueSeparatorAttribute() ?>" name="x_ClientID" id="x_ClientID" value="<?php echo HtmlEncode($property_edit->ClientID->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fpropertyedit"], function() {
	fpropertyedit.createAutoSuggest({"id":"x_ClientID","forceSelect":false});
});
</script>
<?php echo $property_edit->ClientID->Lookup->getParamTag($property_edit, "p_x_ClientID") ?>
</span>
<?php echo $property_edit->ClientID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_edit->PropertyGroup->Visible) { // PropertyGroup ?>
	<div id="r_PropertyGroup" class="form-group row">
		<label id="elh_property_PropertyGroup" for="x_PropertyGroup" class="<?php echo $property_edit->LeftColumnClass ?>"><?php echo $property_edit->PropertyGroup->caption() ?><?php echo $property_edit->PropertyGroup->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_edit->RightColumnClass ?>"><div <?php echo $property_edit->PropertyGroup->cellAttributes() ?>>
<span id="el_property_PropertyGroup">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="property" data-field="x_PropertyGroup" data-value-separator="<?php echo $property_edit->PropertyGroup->displayValueSeparatorAttribute() ?>" id="x_PropertyGroup" name="x_PropertyGroup"<?php echo $property_edit->PropertyGroup->editAttributes() ?>>
			<?php echo $property_edit->PropertyGroup->selectOptionListHtml("x_PropertyGroup") ?>
		</select>
</div>
<?php echo $property_edit->PropertyGroup->Lookup->getParamTag($property_edit, "p_x_PropertyGroup") ?>
</span>
<?php echo $property_edit->PropertyGroup->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_edit->PropertyType->Visible) { // PropertyType ?>
	<div id="r_PropertyType" class="form-group row">
		<label id="elh_property_PropertyType" class="<?php echo $property_edit->LeftColumnClass ?>"><?php echo $property_edit->PropertyType->caption() ?><?php echo $property_edit->PropertyType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_edit->RightColumnClass ?>"><div <?php echo $property_edit->PropertyType->cellAttributes() ?>>
<span id="el_property_PropertyType">
<?php
$onchange = $property_edit->PropertyType->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$property_edit->PropertyType->EditAttrs["onchange"] = "";
?>
<span id="as_x_PropertyType">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_PropertyType" id="sv_x_PropertyType" value="<?php echo RemoveHtml($property_edit->PropertyType->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($property_edit->PropertyType->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($property_edit->PropertyType->getPlaceHolder()) ?>"<?php echo $property_edit->PropertyType->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($property_edit->PropertyType->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_PropertyType',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($property_edit->PropertyType->ReadOnly || $property_edit->PropertyType->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="property" data-field="x_PropertyType" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $property_edit->PropertyType->displayValueSeparatorAttribute() ?>" name="x_PropertyType" id="x_PropertyType" value="<?php echo HtmlEncode($property_edit->PropertyType->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fpropertyedit"], function() {
	fpropertyedit.createAutoSuggest({"id":"x_PropertyType","forceSelect":false});
});
</script>
<?php echo $property_edit->PropertyType->Lookup->getParamTag($property_edit, "p_x_PropertyType") ?>
</span>
<?php echo $property_edit->PropertyType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_edit->Location->Visible) { // Location ?>
	<div id="r_Location" class="form-group row">
		<label id="elh_property_Location" class="<?php echo $property_edit->LeftColumnClass ?>"><?php echo $property_edit->Location->caption() ?><?php echo $property_edit->Location->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_edit->RightColumnClass ?>"><div <?php echo $property_edit->Location->cellAttributes() ?>>
<span id="el_property_Location">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_Location"><?php echo EmptyValue(strval($property_edit->Location->ViewValue)) ? $Language->phrase("PleaseSelect") : $property_edit->Location->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($property_edit->Location->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($property_edit->Location->ReadOnly || $property_edit->Location->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_Location[]',m:1,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $property_edit->Location->Lookup->getParamTag($property_edit, "p_x_Location") ?>
<input type="hidden" data-table="property" data-field="x_Location" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $property_edit->Location->displayValueSeparatorAttribute() ?>" name="x_Location[]" id="x_Location[]" value="<?php echo $property_edit->Location->CurrentValue ?>"<?php echo $property_edit->Location->editAttributes() ?>>
</span>
<?php echo $property_edit->Location->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_edit->PropertyStatus->Visible) { // PropertyStatus ?>
	<div id="r_PropertyStatus" class="form-group row">
		<label id="elh_property_PropertyStatus" for="x_PropertyStatus" class="<?php echo $property_edit->LeftColumnClass ?>"><?php echo $property_edit->PropertyStatus->caption() ?><?php echo $property_edit->PropertyStatus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_edit->RightColumnClass ?>"><div <?php echo $property_edit->PropertyStatus->cellAttributes() ?>>
<span id="el_property_PropertyStatus">
<input type="text" data-table="property" data-field="x_PropertyStatus" name="x_PropertyStatus" id="x_PropertyStatus" size="30" placeholder="<?php echo HtmlEncode($property_edit->PropertyStatus->getPlaceHolder()) ?>" value="<?php echo $property_edit->PropertyStatus->EditValue ?>"<?php echo $property_edit->PropertyStatus->editAttributes() ?>>
</span>
<?php echo $property_edit->PropertyStatus->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_edit->PropertyUse->Visible) { // PropertyUse ?>
	<div id="r_PropertyUse" class="form-group row">
		<label id="elh_property_PropertyUse" class="<?php echo $property_edit->LeftColumnClass ?>"><?php echo $property_edit->PropertyUse->caption() ?><?php echo $property_edit->PropertyUse->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_edit->RightColumnClass ?>"><div <?php echo $property_edit->PropertyUse->cellAttributes() ?>>
<span id="el_property_PropertyUse">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_PropertyUse"><?php echo EmptyValue(strval($property_edit->PropertyUse->ViewValue)) ? $Language->phrase("PleaseSelect") : $property_edit->PropertyUse->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($property_edit->PropertyUse->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($property_edit->PropertyUse->ReadOnly || $property_edit->PropertyUse->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_PropertyUse[]',m:1,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $property_edit->PropertyUse->Lookup->getParamTag($property_edit, "p_x_PropertyUse") ?>
<input type="hidden" data-table="property" data-field="x_PropertyUse" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $property_edit->PropertyUse->displayValueSeparatorAttribute() ?>" name="x_PropertyUse[]" id="x_PropertyUse[]" value="<?php echo $property_edit->PropertyUse->CurrentValue ?>"<?php echo $property_edit->PropertyUse->editAttributes() ?>>
</span>
<?php echo $property_edit->PropertyUse->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_edit->LandExtentInHA->Visible) { // LandExtentInHA ?>
	<div id="r_LandExtentInHA" class="form-group row">
		<label id="elh_property_LandExtentInHA" for="x_LandExtentInHA" class="<?php echo $property_edit->LeftColumnClass ?>"><?php echo $property_edit->LandExtentInHA->caption() ?><?php echo $property_edit->LandExtentInHA->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_edit->RightColumnClass ?>"><div <?php echo $property_edit->LandExtentInHA->cellAttributes() ?>>
<span id="el_property_LandExtentInHA">
<input type="text" data-table="property" data-field="x_LandExtentInHA" name="x_LandExtentInHA" id="x_LandExtentInHA" size="30" placeholder="<?php echo HtmlEncode($property_edit->LandExtentInHA->getPlaceHolder()) ?>" value="<?php echo $property_edit->LandExtentInHA->EditValue ?>"<?php echo $property_edit->LandExtentInHA->editAttributes() ?>>
</span>
<?php echo $property_edit->LandExtentInHA->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_edit->RateableValue->Visible) { // RateableValue ?>
	<div id="r_RateableValue" class="form-group row">
		<label id="elh_property_RateableValue" for="x_RateableValue" class="<?php echo $property_edit->LeftColumnClass ?>"><?php echo $property_edit->RateableValue->caption() ?><?php echo $property_edit->RateableValue->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_edit->RightColumnClass ?>"><div <?php echo $property_edit->RateableValue->cellAttributes() ?>>
<span id="el_property_RateableValue">
<input type="text" data-table="property" data-field="x_RateableValue" name="x_RateableValue" id="x_RateableValue" size="30" placeholder="<?php echo HtmlEncode($property_edit->RateableValue->getPlaceHolder()) ?>" value="<?php echo $property_edit->RateableValue->EditValue ?>"<?php echo $property_edit->RateableValue->editAttributes() ?>>
</span>
<?php echo $property_edit->RateableValue->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_edit->SupplementaryValue->Visible) { // SupplementaryValue ?>
	<div id="r_SupplementaryValue" class="form-group row">
		<label id="elh_property_SupplementaryValue" for="x_SupplementaryValue" class="<?php echo $property_edit->LeftColumnClass ?>"><?php echo $property_edit->SupplementaryValue->caption() ?><?php echo $property_edit->SupplementaryValue->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_edit->RightColumnClass ?>"><div <?php echo $property_edit->SupplementaryValue->cellAttributes() ?>>
<span id="el_property_SupplementaryValue">
<input type="text" data-table="property" data-field="x_SupplementaryValue" name="x_SupplementaryValue" id="x_SupplementaryValue" size="30" placeholder="<?php echo HtmlEncode($property_edit->SupplementaryValue->getPlaceHolder()) ?>" value="<?php echo $property_edit->SupplementaryValue->EditValue ?>"<?php echo $property_edit->SupplementaryValue->editAttributes() ?>>
</span>
<?php echo $property_edit->SupplementaryValue->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_edit->ExemptCode->Visible) { // ExemptCode ?>
	<div id="r_ExemptCode" class="form-group row">
		<label id="elh_property_ExemptCode" for="x_ExemptCode" class="<?php echo $property_edit->LeftColumnClass ?>"><?php echo $property_edit->ExemptCode->caption() ?><?php echo $property_edit->ExemptCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_edit->RightColumnClass ?>"><div <?php echo $property_edit->ExemptCode->cellAttributes() ?>>
<span id="el_property_ExemptCode">
<input type="text" data-table="property" data-field="x_ExemptCode" name="x_ExemptCode" id="x_ExemptCode" size="30" placeholder="<?php echo HtmlEncode($property_edit->ExemptCode->getPlaceHolder()) ?>" value="<?php echo $property_edit->ExemptCode->EditValue ?>"<?php echo $property_edit->ExemptCode->editAttributes() ?>>
</span>
<?php echo $property_edit->ExemptCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_edit->Improvements->Visible) { // Improvements ?>
	<div id="r_Improvements" class="form-group row">
		<label id="elh_property_Improvements" for="x_Improvements" class="<?php echo $property_edit->LeftColumnClass ?>"><?php echo $property_edit->Improvements->caption() ?><?php echo $property_edit->Improvements->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_edit->RightColumnClass ?>"><div <?php echo $property_edit->Improvements->cellAttributes() ?>>
<span id="el_property_Improvements">
<textarea data-table="property" data-field="x_Improvements" name="x_Improvements" id="x_Improvements" cols="50" rows="2" placeholder="<?php echo HtmlEncode($property_edit->Improvements->getPlaceHolder()) ?>"<?php echo $property_edit->Improvements->editAttributes() ?>><?php echo $property_edit->Improvements->EditValue ?></textarea>
</span>
<?php echo $property_edit->Improvements->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_edit->StreetAddress->Visible) { // StreetAddress ?>
	<div id="r_StreetAddress" class="form-group row">
		<label id="elh_property_StreetAddress" for="x_StreetAddress" class="<?php echo $property_edit->LeftColumnClass ?>"><?php echo $property_edit->StreetAddress->caption() ?><?php echo $property_edit->StreetAddress->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_edit->RightColumnClass ?>"><div <?php echo $property_edit->StreetAddress->cellAttributes() ?>>
<span id="el_property_StreetAddress">
<textarea data-table="property" data-field="x_StreetAddress" name="x_StreetAddress" id="x_StreetAddress" cols="50" rows="2" placeholder="<?php echo HtmlEncode($property_edit->StreetAddress->getPlaceHolder()) ?>"<?php echo $property_edit->StreetAddress->editAttributes() ?>><?php echo $property_edit->StreetAddress->EditValue ?></textarea>
</span>
<?php echo $property_edit->StreetAddress->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_edit->Longitude->Visible) { // Longitude ?>
	<div id="r_Longitude" class="form-group row">
		<label id="elh_property_Longitude" for="x_Longitude" class="<?php echo $property_edit->LeftColumnClass ?>"><?php echo $property_edit->Longitude->caption() ?><?php echo $property_edit->Longitude->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_edit->RightColumnClass ?>"><div <?php echo $property_edit->Longitude->cellAttributes() ?>>
<span id="el_property_Longitude">
<input type="text" data-table="property" data-field="x_Longitude" name="x_Longitude" id="x_Longitude" size="30" placeholder="<?php echo HtmlEncode($property_edit->Longitude->getPlaceHolder()) ?>" value="<?php echo $property_edit->Longitude->EditValue ?>"<?php echo $property_edit->Longitude->editAttributes() ?>>
</span>
<?php echo $property_edit->Longitude->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_edit->Latitude->Visible) { // Latitude ?>
	<div id="r_Latitude" class="form-group row">
		<label id="elh_property_Latitude" for="x_Latitude" class="<?php echo $property_edit->LeftColumnClass ?>"><?php echo $property_edit->Latitude->caption() ?><?php echo $property_edit->Latitude->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_edit->RightColumnClass ?>"><div <?php echo $property_edit->Latitude->cellAttributes() ?>>
<span id="el_property_Latitude">
<input type="text" data-table="property" data-field="x_Latitude" name="x_Latitude" id="x_Latitude" size="30" placeholder="<?php echo HtmlEncode($property_edit->Latitude->getPlaceHolder()) ?>" value="<?php echo $property_edit->Latitude->EditValue ?>"<?php echo $property_edit->Latitude->editAttributes() ?>>
</span>
<?php echo $property_edit->Latitude->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_edit->Incumberance->Visible) { // Incumberance ?>
	<div id="r_Incumberance" class="form-group row">
		<label id="elh_property_Incumberance" for="x_Incumberance" class="<?php echo $property_edit->LeftColumnClass ?>"><?php echo $property_edit->Incumberance->caption() ?><?php echo $property_edit->Incumberance->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_edit->RightColumnClass ?>"><div <?php echo $property_edit->Incumberance->cellAttributes() ?>>
<span id="el_property_Incumberance">
<input type="text" data-table="property" data-field="x_Incumberance" name="x_Incumberance" id="x_Incumberance" size="30" maxlength="1" placeholder="<?php echo HtmlEncode($property_edit->Incumberance->getPlaceHolder()) ?>" value="<?php echo $property_edit->Incumberance->EditValue ?>"<?php echo $property_edit->Incumberance->editAttributes() ?>>
</span>
<?php echo $property_edit->Incumberance->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_edit->SubDivisionOf->Visible) { // SubDivisionOf ?>
	<div id="r_SubDivisionOf" class="form-group row">
		<label id="elh_property_SubDivisionOf" for="x_SubDivisionOf" class="<?php echo $property_edit->LeftColumnClass ?>"><?php echo $property_edit->SubDivisionOf->caption() ?><?php echo $property_edit->SubDivisionOf->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_edit->RightColumnClass ?>"><div <?php echo $property_edit->SubDivisionOf->cellAttributes() ?>>
<span id="el_property_SubDivisionOf">
<input type="text" data-table="property" data-field="x_SubDivisionOf" name="x_SubDivisionOf" id="x_SubDivisionOf" size="30" placeholder="<?php echo HtmlEncode($property_edit->SubDivisionOf->getPlaceHolder()) ?>" value="<?php echo $property_edit->SubDivisionOf->EditValue ?>"<?php echo $property_edit->SubDivisionOf->editAttributes() ?>>
</span>
<?php echo $property_edit->SubDivisionOf->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_edit->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
	<div id="r_LastUpdatedBy" class="form-group row">
		<label id="elh_property_LastUpdatedBy" for="x_LastUpdatedBy" class="<?php echo $property_edit->LeftColumnClass ?>"><?php echo $property_edit->LastUpdatedBy->caption() ?><?php echo $property_edit->LastUpdatedBy->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_edit->RightColumnClass ?>"><div <?php echo $property_edit->LastUpdatedBy->cellAttributes() ?>>
<span id="el_property_LastUpdatedBy">
<input type="text" data-table="property" data-field="x_LastUpdatedBy" name="x_LastUpdatedBy" id="x_LastUpdatedBy" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($property_edit->LastUpdatedBy->getPlaceHolder()) ?>" value="<?php echo $property_edit->LastUpdatedBy->EditValue ?>"<?php echo $property_edit->LastUpdatedBy->editAttributes() ?>>
</span>
<?php echo $property_edit->LastUpdatedBy->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_edit->LastUpdateDate->Visible) { // LastUpdateDate ?>
	<div id="r_LastUpdateDate" class="form-group row">
		<label id="elh_property_LastUpdateDate" for="x_LastUpdateDate" class="<?php echo $property_edit->LeftColumnClass ?>"><?php echo $property_edit->LastUpdateDate->caption() ?><?php echo $property_edit->LastUpdateDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_edit->RightColumnClass ?>"><div <?php echo $property_edit->LastUpdateDate->cellAttributes() ?>>
<span id="el_property_LastUpdateDate">
<input type="text" data-table="property" data-field="x_LastUpdateDate" name="x_LastUpdateDate" id="x_LastUpdateDate" placeholder="<?php echo HtmlEncode($property_edit->LastUpdateDate->getPlaceHolder()) ?>" value="<?php echo $property_edit->LastUpdateDate->EditValue ?>"<?php echo $property_edit->LastUpdateDate->editAttributes() ?>>
</span>
<?php echo $property_edit->LastUpdateDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_edit->ValuationNo->Visible) { // ValuationNo ?>
	<div id="r_ValuationNo" class="form-group row">
		<label id="elh_property_ValuationNo" class="<?php echo $property_edit->LeftColumnClass ?>"><?php echo $property_edit->ValuationNo->caption() ?><?php echo $property_edit->ValuationNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_edit->RightColumnClass ?>"><div <?php echo $property_edit->ValuationNo->cellAttributes() ?>>
<span id="el_property_ValuationNo">
<span<?php echo $property_edit->ValuationNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_edit->ValuationNo->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_ValuationNo" name="x_ValuationNo" id="x_ValuationNo" value="<?php echo HtmlEncode($property_edit->ValuationNo->CurrentValue) ?>">
<?php echo $property_edit->ValuationNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_edit->LandValue->Visible) { // LandValue ?>
	<div id="r_LandValue" class="form-group row">
		<label id="elh_property_LandValue" for="x_LandValue" class="<?php echo $property_edit->LeftColumnClass ?>"><?php echo $property_edit->LandValue->caption() ?><?php echo $property_edit->LandValue->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_edit->RightColumnClass ?>"><div <?php echo $property_edit->LandValue->cellAttributes() ?>>
<span id="el_property_LandValue">
<input type="text" data-table="property" data-field="x_LandValue" name="x_LandValue" id="x_LandValue" size="30" placeholder="<?php echo HtmlEncode($property_edit->LandValue->getPlaceHolder()) ?>" value="<?php echo $property_edit->LandValue->EditValue ?>"<?php echo $property_edit->LandValue->editAttributes() ?>>
</span>
<?php echo $property_edit->LandValue->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_edit->ImprovementsValue->Visible) { // ImprovementsValue ?>
	<div id="r_ImprovementsValue" class="form-group row">
		<label id="elh_property_ImprovementsValue" for="x_ImprovementsValue" class="<?php echo $property_edit->LeftColumnClass ?>"><?php echo $property_edit->ImprovementsValue->caption() ?><?php echo $property_edit->ImprovementsValue->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_edit->RightColumnClass ?>"><div <?php echo $property_edit->ImprovementsValue->cellAttributes() ?>>
<span id="el_property_ImprovementsValue">
<input type="text" data-table="property" data-field="x_ImprovementsValue" name="x_ImprovementsValue" id="x_ImprovementsValue" size="30" placeholder="<?php echo HtmlEncode($property_edit->ImprovementsValue->getPlaceHolder()) ?>" value="<?php echo $property_edit->ImprovementsValue->EditValue ?>"<?php echo $property_edit->ImprovementsValue->editAttributes() ?>>
</span>
<?php echo $property_edit->ImprovementsValue->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$property_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $property_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $property_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$property_edit->IsModal) { ?>
<?php echo $property_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$property_edit->showPageFooter();
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
$property_edit->terminate();
?>