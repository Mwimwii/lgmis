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
$property_add = new property_add();

// Run the page
$property_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$property_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpropertyadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fpropertyadd = currentForm = new ew.Form("fpropertyadd", "add");

	// Validate form
	fpropertyadd.validate = function() {
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
			<?php if ($property_add->PropertyNo->Required) { ?>
				elm = this.getElements("x" + infix + "_PropertyNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_add->PropertyNo->caption(), $property_add->PropertyNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_add->ClientSerNo->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientSerNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_add->ClientSerNo->caption(), $property_add->ClientSerNo->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ClientSerNo");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_add->ClientSerNo->errorMessage()) ?>");
			<?php if ($property_add->ClientID->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_add->ClientID->caption(), $property_add->ClientID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_add->PropertyGroup->Required) { ?>
				elm = this.getElements("x" + infix + "_PropertyGroup");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_add->PropertyGroup->caption(), $property_add->PropertyGroup->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_add->PropertyType->Required) { ?>
				elm = this.getElements("x" + infix + "_PropertyType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_add->PropertyType->caption(), $property_add->PropertyType->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PropertyType");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_add->PropertyType->errorMessage()) ?>");
			<?php if ($property_add->Location->Required) { ?>
				elm = this.getElements("x" + infix + "_Location[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_add->Location->caption(), $property_add->Location->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_add->PropertyStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_PropertyStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_add->PropertyStatus->caption(), $property_add->PropertyStatus->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PropertyStatus");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_add->PropertyStatus->errorMessage()) ?>");
			<?php if ($property_add->PropertyUse->Required) { ?>
				elm = this.getElements("x" + infix + "_PropertyUse[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_add->PropertyUse->caption(), $property_add->PropertyUse->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_add->LandExtentInHA->Required) { ?>
				elm = this.getElements("x" + infix + "_LandExtentInHA");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_add->LandExtentInHA->caption(), $property_add->LandExtentInHA->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LandExtentInHA");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_add->LandExtentInHA->errorMessage()) ?>");
			<?php if ($property_add->RateableValue->Required) { ?>
				elm = this.getElements("x" + infix + "_RateableValue");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_add->RateableValue->caption(), $property_add->RateableValue->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_RateableValue");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_add->RateableValue->errorMessage()) ?>");
			<?php if ($property_add->SupplementaryValue->Required) { ?>
				elm = this.getElements("x" + infix + "_SupplementaryValue");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_add->SupplementaryValue->caption(), $property_add->SupplementaryValue->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_SupplementaryValue");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_add->SupplementaryValue->errorMessage()) ?>");
			<?php if ($property_add->ExemptCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ExemptCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_add->ExemptCode->caption(), $property_add->ExemptCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ExemptCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_add->ExemptCode->errorMessage()) ?>");
			<?php if ($property_add->Improvements->Required) { ?>
				elm = this.getElements("x" + infix + "_Improvements");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_add->Improvements->caption(), $property_add->Improvements->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_add->StreetAddress->Required) { ?>
				elm = this.getElements("x" + infix + "_StreetAddress");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_add->StreetAddress->caption(), $property_add->StreetAddress->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_add->Longitude->Required) { ?>
				elm = this.getElements("x" + infix + "_Longitude");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_add->Longitude->caption(), $property_add->Longitude->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Longitude");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_add->Longitude->errorMessage()) ?>");
			<?php if ($property_add->Latitude->Required) { ?>
				elm = this.getElements("x" + infix + "_Latitude");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_add->Latitude->caption(), $property_add->Latitude->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Latitude");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_add->Latitude->errorMessage()) ?>");
			<?php if ($property_add->Incumberance->Required) { ?>
				elm = this.getElements("x" + infix + "_Incumberance");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_add->Incumberance->caption(), $property_add->Incumberance->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_add->SubDivisionOf->Required) { ?>
				elm = this.getElements("x" + infix + "_SubDivisionOf");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_add->SubDivisionOf->caption(), $property_add->SubDivisionOf->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_SubDivisionOf");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_add->SubDivisionOf->errorMessage()) ?>");
			<?php if ($property_add->LastUpdatedBy->Required) { ?>
				elm = this.getElements("x" + infix + "_LastUpdatedBy");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_add->LastUpdatedBy->caption(), $property_add->LastUpdatedBy->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_add->LastUpdateDate->Required) { ?>
				elm = this.getElements("x" + infix + "_LastUpdateDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_add->LastUpdateDate->caption(), $property_add->LastUpdateDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LastUpdateDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_add->LastUpdateDate->errorMessage()) ?>");
			<?php if ($property_add->LandValue->Required) { ?>
				elm = this.getElements("x" + infix + "_LandValue");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_add->LandValue->caption(), $property_add->LandValue->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LandValue");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_add->LandValue->errorMessage()) ?>");
			<?php if ($property_add->ImprovementsValue->Required) { ?>
				elm = this.getElements("x" + infix + "_ImprovementsValue");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_add->ImprovementsValue->caption(), $property_add->ImprovementsValue->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ImprovementsValue");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_add->ImprovementsValue->errorMessage()) ?>");

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
	fpropertyadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpropertyadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fpropertyadd.lists["x_ClientSerNo"] = <?php echo $property_add->ClientSerNo->Lookup->toClientList($property_add) ?>;
	fpropertyadd.lists["x_ClientSerNo"].options = <?php echo JsonEncode($property_add->ClientSerNo->lookupOptions()) ?>;
	fpropertyadd.autoSuggests["x_ClientSerNo"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fpropertyadd.lists["x_ClientID"] = <?php echo $property_add->ClientID->Lookup->toClientList($property_add) ?>;
	fpropertyadd.lists["x_ClientID"].options = <?php echo JsonEncode($property_add->ClientID->lookupOptions()) ?>;
	fpropertyadd.autoSuggests["x_ClientID"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fpropertyadd.lists["x_PropertyGroup"] = <?php echo $property_add->PropertyGroup->Lookup->toClientList($property_add) ?>;
	fpropertyadd.lists["x_PropertyGroup"].options = <?php echo JsonEncode($property_add->PropertyGroup->lookupOptions()) ?>;
	fpropertyadd.lists["x_PropertyType"] = <?php echo $property_add->PropertyType->Lookup->toClientList($property_add) ?>;
	fpropertyadd.lists["x_PropertyType"].options = <?php echo JsonEncode($property_add->PropertyType->lookupOptions()) ?>;
	fpropertyadd.autoSuggests["x_PropertyType"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fpropertyadd.lists["x_Location[]"] = <?php echo $property_add->Location->Lookup->toClientList($property_add) ?>;
	fpropertyadd.lists["x_Location[]"].options = <?php echo JsonEncode($property_add->Location->lookupOptions()) ?>;
	fpropertyadd.lists["x_PropertyUse[]"] = <?php echo $property_add->PropertyUse->Lookup->toClientList($property_add) ?>;
	fpropertyadd.lists["x_PropertyUse[]"].options = <?php echo JsonEncode($property_add->PropertyUse->lookupOptions()) ?>;
	loadjs.done("fpropertyadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $property_add->showPageHeader(); ?>
<?php
$property_add->showMessage();
?>
<form name="fpropertyadd" id="fpropertyadd" class="<?php echo $property_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="property">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$property_add->IsModal ?>">
<?php if ($property->getCurrentMasterTable() == "client") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="client">
<input type="hidden" name="fk_ClientSerNo" value="<?php echo HtmlEncode($property_add->ClientSerNo->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($property_add->PropertyNo->Visible) { // PropertyNo ?>
	<div id="r_PropertyNo" class="form-group row">
		<label id="elh_property_PropertyNo" for="x_PropertyNo" class="<?php echo $property_add->LeftColumnClass ?>"><?php echo $property_add->PropertyNo->caption() ?><?php echo $property_add->PropertyNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_add->RightColumnClass ?>"><div <?php echo $property_add->PropertyNo->cellAttributes() ?>>
<span id="el_property_PropertyNo">
<input type="text" data-table="property" data-field="x_PropertyNo" name="x_PropertyNo" id="x_PropertyNo" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($property_add->PropertyNo->getPlaceHolder()) ?>" value="<?php echo $property_add->PropertyNo->EditValue ?>"<?php echo $property_add->PropertyNo->editAttributes() ?>>
</span>
<?php echo $property_add->PropertyNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_add->ClientSerNo->Visible) { // ClientSerNo ?>
	<div id="r_ClientSerNo" class="form-group row">
		<label id="elh_property_ClientSerNo" class="<?php echo $property_add->LeftColumnClass ?>"><?php echo $property_add->ClientSerNo->caption() ?><?php echo $property_add->ClientSerNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_add->RightColumnClass ?>"><div <?php echo $property_add->ClientSerNo->cellAttributes() ?>>
<?php if ($property_add->ClientSerNo->getSessionValue() != "") { ?>
<span id="el_property_ClientSerNo">
<span<?php echo $property_add->ClientSerNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_add->ClientSerNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_ClientSerNo" name="x_ClientSerNo" value="<?php echo HtmlEncode($property_add->ClientSerNo->CurrentValue) ?>">
<?php } else { ?>
<span id="el_property_ClientSerNo">
<?php
$onchange = $property_add->ClientSerNo->EditAttrs->prepend("onchange", "ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$property_add->ClientSerNo->EditAttrs["onchange"] = "";
?>
<span id="as_x_ClientSerNo">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_ClientSerNo" id="sv_x_ClientSerNo" value="<?php echo RemoveHtml($property_add->ClientSerNo->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($property_add->ClientSerNo->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($property_add->ClientSerNo->getPlaceHolder()) ?>"<?php echo $property_add->ClientSerNo->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($property_add->ClientSerNo->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_ClientSerNo',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($property_add->ClientSerNo->ReadOnly || $property_add->ClientSerNo->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="property" data-field="x_ClientSerNo" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $property_add->ClientSerNo->displayValueSeparatorAttribute() ?>" name="x_ClientSerNo" id="x_ClientSerNo" value="<?php echo HtmlEncode($property_add->ClientSerNo->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fpropertyadd"], function() {
	fpropertyadd.createAutoSuggest({"id":"x_ClientSerNo","forceSelect":true});
});
</script>
<?php echo $property_add->ClientSerNo->Lookup->getParamTag($property_add, "p_x_ClientSerNo") ?>
</span>
<?php } ?>
<?php echo $property_add->ClientSerNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_add->ClientID->Visible) { // ClientID ?>
	<div id="r_ClientID" class="form-group row">
		<label id="elh_property_ClientID" class="<?php echo $property_add->LeftColumnClass ?>"><?php echo $property_add->ClientID->caption() ?><?php echo $property_add->ClientID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_add->RightColumnClass ?>"><div <?php echo $property_add->ClientID->cellAttributes() ?>>
<span id="el_property_ClientID">
<?php
$onchange = $property_add->ClientID->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$property_add->ClientID->EditAttrs["onchange"] = "";
?>
<span id="as_x_ClientID">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_ClientID" id="sv_x_ClientID" value="<?php echo RemoveHtml($property_add->ClientID->EditValue) ?>" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($property_add->ClientID->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($property_add->ClientID->getPlaceHolder()) ?>"<?php echo $property_add->ClientID->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($property_add->ClientID->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_ClientID',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($property_add->ClientID->ReadOnly || $property_add->ClientID->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="property" data-field="x_ClientID" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $property_add->ClientID->displayValueSeparatorAttribute() ?>" name="x_ClientID" id="x_ClientID" value="<?php echo HtmlEncode($property_add->ClientID->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fpropertyadd"], function() {
	fpropertyadd.createAutoSuggest({"id":"x_ClientID","forceSelect":false});
});
</script>
<?php echo $property_add->ClientID->Lookup->getParamTag($property_add, "p_x_ClientID") ?>
</span>
<?php echo $property_add->ClientID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_add->PropertyGroup->Visible) { // PropertyGroup ?>
	<div id="r_PropertyGroup" class="form-group row">
		<label id="elh_property_PropertyGroup" for="x_PropertyGroup" class="<?php echo $property_add->LeftColumnClass ?>"><?php echo $property_add->PropertyGroup->caption() ?><?php echo $property_add->PropertyGroup->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_add->RightColumnClass ?>"><div <?php echo $property_add->PropertyGroup->cellAttributes() ?>>
<span id="el_property_PropertyGroup">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="property" data-field="x_PropertyGroup" data-value-separator="<?php echo $property_add->PropertyGroup->displayValueSeparatorAttribute() ?>" id="x_PropertyGroup" name="x_PropertyGroup"<?php echo $property_add->PropertyGroup->editAttributes() ?>>
			<?php echo $property_add->PropertyGroup->selectOptionListHtml("x_PropertyGroup") ?>
		</select>
</div>
<?php echo $property_add->PropertyGroup->Lookup->getParamTag($property_add, "p_x_PropertyGroup") ?>
</span>
<?php echo $property_add->PropertyGroup->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_add->PropertyType->Visible) { // PropertyType ?>
	<div id="r_PropertyType" class="form-group row">
		<label id="elh_property_PropertyType" class="<?php echo $property_add->LeftColumnClass ?>"><?php echo $property_add->PropertyType->caption() ?><?php echo $property_add->PropertyType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_add->RightColumnClass ?>"><div <?php echo $property_add->PropertyType->cellAttributes() ?>>
<span id="el_property_PropertyType">
<?php
$onchange = $property_add->PropertyType->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$property_add->PropertyType->EditAttrs["onchange"] = "";
?>
<span id="as_x_PropertyType">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_PropertyType" id="sv_x_PropertyType" value="<?php echo RemoveHtml($property_add->PropertyType->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($property_add->PropertyType->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($property_add->PropertyType->getPlaceHolder()) ?>"<?php echo $property_add->PropertyType->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($property_add->PropertyType->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_PropertyType',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($property_add->PropertyType->ReadOnly || $property_add->PropertyType->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="property" data-field="x_PropertyType" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $property_add->PropertyType->displayValueSeparatorAttribute() ?>" name="x_PropertyType" id="x_PropertyType" value="<?php echo HtmlEncode($property_add->PropertyType->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fpropertyadd"], function() {
	fpropertyadd.createAutoSuggest({"id":"x_PropertyType","forceSelect":false});
});
</script>
<?php echo $property_add->PropertyType->Lookup->getParamTag($property_add, "p_x_PropertyType") ?>
</span>
<?php echo $property_add->PropertyType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_add->Location->Visible) { // Location ?>
	<div id="r_Location" class="form-group row">
		<label id="elh_property_Location" class="<?php echo $property_add->LeftColumnClass ?>"><?php echo $property_add->Location->caption() ?><?php echo $property_add->Location->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_add->RightColumnClass ?>"><div <?php echo $property_add->Location->cellAttributes() ?>>
<span id="el_property_Location">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_Location"><?php echo EmptyValue(strval($property_add->Location->ViewValue)) ? $Language->phrase("PleaseSelect") : $property_add->Location->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($property_add->Location->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($property_add->Location->ReadOnly || $property_add->Location->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_Location[]',m:1,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $property_add->Location->Lookup->getParamTag($property_add, "p_x_Location") ?>
<input type="hidden" data-table="property" data-field="x_Location" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $property_add->Location->displayValueSeparatorAttribute() ?>" name="x_Location[]" id="x_Location[]" value="<?php echo $property_add->Location->CurrentValue ?>"<?php echo $property_add->Location->editAttributes() ?>>
</span>
<?php echo $property_add->Location->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_add->PropertyStatus->Visible) { // PropertyStatus ?>
	<div id="r_PropertyStatus" class="form-group row">
		<label id="elh_property_PropertyStatus" for="x_PropertyStatus" class="<?php echo $property_add->LeftColumnClass ?>"><?php echo $property_add->PropertyStatus->caption() ?><?php echo $property_add->PropertyStatus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_add->RightColumnClass ?>"><div <?php echo $property_add->PropertyStatus->cellAttributes() ?>>
<span id="el_property_PropertyStatus">
<input type="text" data-table="property" data-field="x_PropertyStatus" name="x_PropertyStatus" id="x_PropertyStatus" size="30" placeholder="<?php echo HtmlEncode($property_add->PropertyStatus->getPlaceHolder()) ?>" value="<?php echo $property_add->PropertyStatus->EditValue ?>"<?php echo $property_add->PropertyStatus->editAttributes() ?>>
</span>
<?php echo $property_add->PropertyStatus->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_add->PropertyUse->Visible) { // PropertyUse ?>
	<div id="r_PropertyUse" class="form-group row">
		<label id="elh_property_PropertyUse" class="<?php echo $property_add->LeftColumnClass ?>"><?php echo $property_add->PropertyUse->caption() ?><?php echo $property_add->PropertyUse->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_add->RightColumnClass ?>"><div <?php echo $property_add->PropertyUse->cellAttributes() ?>>
<span id="el_property_PropertyUse">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_PropertyUse"><?php echo EmptyValue(strval($property_add->PropertyUse->ViewValue)) ? $Language->phrase("PleaseSelect") : $property_add->PropertyUse->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($property_add->PropertyUse->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($property_add->PropertyUse->ReadOnly || $property_add->PropertyUse->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_PropertyUse[]',m:1,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $property_add->PropertyUse->Lookup->getParamTag($property_add, "p_x_PropertyUse") ?>
<input type="hidden" data-table="property" data-field="x_PropertyUse" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $property_add->PropertyUse->displayValueSeparatorAttribute() ?>" name="x_PropertyUse[]" id="x_PropertyUse[]" value="<?php echo $property_add->PropertyUse->CurrentValue ?>"<?php echo $property_add->PropertyUse->editAttributes() ?>>
</span>
<?php echo $property_add->PropertyUse->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_add->LandExtentInHA->Visible) { // LandExtentInHA ?>
	<div id="r_LandExtentInHA" class="form-group row">
		<label id="elh_property_LandExtentInHA" for="x_LandExtentInHA" class="<?php echo $property_add->LeftColumnClass ?>"><?php echo $property_add->LandExtentInHA->caption() ?><?php echo $property_add->LandExtentInHA->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_add->RightColumnClass ?>"><div <?php echo $property_add->LandExtentInHA->cellAttributes() ?>>
<span id="el_property_LandExtentInHA">
<input type="text" data-table="property" data-field="x_LandExtentInHA" name="x_LandExtentInHA" id="x_LandExtentInHA" size="30" placeholder="<?php echo HtmlEncode($property_add->LandExtentInHA->getPlaceHolder()) ?>" value="<?php echo $property_add->LandExtentInHA->EditValue ?>"<?php echo $property_add->LandExtentInHA->editAttributes() ?>>
</span>
<?php echo $property_add->LandExtentInHA->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_add->RateableValue->Visible) { // RateableValue ?>
	<div id="r_RateableValue" class="form-group row">
		<label id="elh_property_RateableValue" for="x_RateableValue" class="<?php echo $property_add->LeftColumnClass ?>"><?php echo $property_add->RateableValue->caption() ?><?php echo $property_add->RateableValue->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_add->RightColumnClass ?>"><div <?php echo $property_add->RateableValue->cellAttributes() ?>>
<span id="el_property_RateableValue">
<input type="text" data-table="property" data-field="x_RateableValue" name="x_RateableValue" id="x_RateableValue" size="30" placeholder="<?php echo HtmlEncode($property_add->RateableValue->getPlaceHolder()) ?>" value="<?php echo $property_add->RateableValue->EditValue ?>"<?php echo $property_add->RateableValue->editAttributes() ?>>
</span>
<?php echo $property_add->RateableValue->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_add->SupplementaryValue->Visible) { // SupplementaryValue ?>
	<div id="r_SupplementaryValue" class="form-group row">
		<label id="elh_property_SupplementaryValue" for="x_SupplementaryValue" class="<?php echo $property_add->LeftColumnClass ?>"><?php echo $property_add->SupplementaryValue->caption() ?><?php echo $property_add->SupplementaryValue->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_add->RightColumnClass ?>"><div <?php echo $property_add->SupplementaryValue->cellAttributes() ?>>
<span id="el_property_SupplementaryValue">
<input type="text" data-table="property" data-field="x_SupplementaryValue" name="x_SupplementaryValue" id="x_SupplementaryValue" size="30" placeholder="<?php echo HtmlEncode($property_add->SupplementaryValue->getPlaceHolder()) ?>" value="<?php echo $property_add->SupplementaryValue->EditValue ?>"<?php echo $property_add->SupplementaryValue->editAttributes() ?>>
</span>
<?php echo $property_add->SupplementaryValue->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_add->ExemptCode->Visible) { // ExemptCode ?>
	<div id="r_ExemptCode" class="form-group row">
		<label id="elh_property_ExemptCode" for="x_ExemptCode" class="<?php echo $property_add->LeftColumnClass ?>"><?php echo $property_add->ExemptCode->caption() ?><?php echo $property_add->ExemptCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_add->RightColumnClass ?>"><div <?php echo $property_add->ExemptCode->cellAttributes() ?>>
<span id="el_property_ExemptCode">
<input type="text" data-table="property" data-field="x_ExemptCode" name="x_ExemptCode" id="x_ExemptCode" size="30" placeholder="<?php echo HtmlEncode($property_add->ExemptCode->getPlaceHolder()) ?>" value="<?php echo $property_add->ExemptCode->EditValue ?>"<?php echo $property_add->ExemptCode->editAttributes() ?>>
</span>
<?php echo $property_add->ExemptCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_add->Improvements->Visible) { // Improvements ?>
	<div id="r_Improvements" class="form-group row">
		<label id="elh_property_Improvements" for="x_Improvements" class="<?php echo $property_add->LeftColumnClass ?>"><?php echo $property_add->Improvements->caption() ?><?php echo $property_add->Improvements->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_add->RightColumnClass ?>"><div <?php echo $property_add->Improvements->cellAttributes() ?>>
<span id="el_property_Improvements">
<textarea data-table="property" data-field="x_Improvements" name="x_Improvements" id="x_Improvements" cols="50" rows="2" placeholder="<?php echo HtmlEncode($property_add->Improvements->getPlaceHolder()) ?>"<?php echo $property_add->Improvements->editAttributes() ?>><?php echo $property_add->Improvements->EditValue ?></textarea>
</span>
<?php echo $property_add->Improvements->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_add->StreetAddress->Visible) { // StreetAddress ?>
	<div id="r_StreetAddress" class="form-group row">
		<label id="elh_property_StreetAddress" for="x_StreetAddress" class="<?php echo $property_add->LeftColumnClass ?>"><?php echo $property_add->StreetAddress->caption() ?><?php echo $property_add->StreetAddress->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_add->RightColumnClass ?>"><div <?php echo $property_add->StreetAddress->cellAttributes() ?>>
<span id="el_property_StreetAddress">
<textarea data-table="property" data-field="x_StreetAddress" name="x_StreetAddress" id="x_StreetAddress" cols="50" rows="2" placeholder="<?php echo HtmlEncode($property_add->StreetAddress->getPlaceHolder()) ?>"<?php echo $property_add->StreetAddress->editAttributes() ?>><?php echo $property_add->StreetAddress->EditValue ?></textarea>
</span>
<?php echo $property_add->StreetAddress->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_add->Longitude->Visible) { // Longitude ?>
	<div id="r_Longitude" class="form-group row">
		<label id="elh_property_Longitude" for="x_Longitude" class="<?php echo $property_add->LeftColumnClass ?>"><?php echo $property_add->Longitude->caption() ?><?php echo $property_add->Longitude->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_add->RightColumnClass ?>"><div <?php echo $property_add->Longitude->cellAttributes() ?>>
<span id="el_property_Longitude">
<input type="text" data-table="property" data-field="x_Longitude" name="x_Longitude" id="x_Longitude" size="30" placeholder="<?php echo HtmlEncode($property_add->Longitude->getPlaceHolder()) ?>" value="<?php echo $property_add->Longitude->EditValue ?>"<?php echo $property_add->Longitude->editAttributes() ?>>
</span>
<?php echo $property_add->Longitude->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_add->Latitude->Visible) { // Latitude ?>
	<div id="r_Latitude" class="form-group row">
		<label id="elh_property_Latitude" for="x_Latitude" class="<?php echo $property_add->LeftColumnClass ?>"><?php echo $property_add->Latitude->caption() ?><?php echo $property_add->Latitude->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_add->RightColumnClass ?>"><div <?php echo $property_add->Latitude->cellAttributes() ?>>
<span id="el_property_Latitude">
<input type="text" data-table="property" data-field="x_Latitude" name="x_Latitude" id="x_Latitude" size="30" placeholder="<?php echo HtmlEncode($property_add->Latitude->getPlaceHolder()) ?>" value="<?php echo $property_add->Latitude->EditValue ?>"<?php echo $property_add->Latitude->editAttributes() ?>>
</span>
<?php echo $property_add->Latitude->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_add->Incumberance->Visible) { // Incumberance ?>
	<div id="r_Incumberance" class="form-group row">
		<label id="elh_property_Incumberance" for="x_Incumberance" class="<?php echo $property_add->LeftColumnClass ?>"><?php echo $property_add->Incumberance->caption() ?><?php echo $property_add->Incumberance->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_add->RightColumnClass ?>"><div <?php echo $property_add->Incumberance->cellAttributes() ?>>
<span id="el_property_Incumberance">
<input type="text" data-table="property" data-field="x_Incumberance" name="x_Incumberance" id="x_Incumberance" size="30" maxlength="1" placeholder="<?php echo HtmlEncode($property_add->Incumberance->getPlaceHolder()) ?>" value="<?php echo $property_add->Incumberance->EditValue ?>"<?php echo $property_add->Incumberance->editAttributes() ?>>
</span>
<?php echo $property_add->Incumberance->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_add->SubDivisionOf->Visible) { // SubDivisionOf ?>
	<div id="r_SubDivisionOf" class="form-group row">
		<label id="elh_property_SubDivisionOf" for="x_SubDivisionOf" class="<?php echo $property_add->LeftColumnClass ?>"><?php echo $property_add->SubDivisionOf->caption() ?><?php echo $property_add->SubDivisionOf->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_add->RightColumnClass ?>"><div <?php echo $property_add->SubDivisionOf->cellAttributes() ?>>
<span id="el_property_SubDivisionOf">
<input type="text" data-table="property" data-field="x_SubDivisionOf" name="x_SubDivisionOf" id="x_SubDivisionOf" size="30" placeholder="<?php echo HtmlEncode($property_add->SubDivisionOf->getPlaceHolder()) ?>" value="<?php echo $property_add->SubDivisionOf->EditValue ?>"<?php echo $property_add->SubDivisionOf->editAttributes() ?>>
</span>
<?php echo $property_add->SubDivisionOf->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_add->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
	<div id="r_LastUpdatedBy" class="form-group row">
		<label id="elh_property_LastUpdatedBy" for="x_LastUpdatedBy" class="<?php echo $property_add->LeftColumnClass ?>"><?php echo $property_add->LastUpdatedBy->caption() ?><?php echo $property_add->LastUpdatedBy->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_add->RightColumnClass ?>"><div <?php echo $property_add->LastUpdatedBy->cellAttributes() ?>>
<span id="el_property_LastUpdatedBy">
<input type="text" data-table="property" data-field="x_LastUpdatedBy" name="x_LastUpdatedBy" id="x_LastUpdatedBy" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($property_add->LastUpdatedBy->getPlaceHolder()) ?>" value="<?php echo $property_add->LastUpdatedBy->EditValue ?>"<?php echo $property_add->LastUpdatedBy->editAttributes() ?>>
</span>
<?php echo $property_add->LastUpdatedBy->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_add->LastUpdateDate->Visible) { // LastUpdateDate ?>
	<div id="r_LastUpdateDate" class="form-group row">
		<label id="elh_property_LastUpdateDate" for="x_LastUpdateDate" class="<?php echo $property_add->LeftColumnClass ?>"><?php echo $property_add->LastUpdateDate->caption() ?><?php echo $property_add->LastUpdateDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_add->RightColumnClass ?>"><div <?php echo $property_add->LastUpdateDate->cellAttributes() ?>>
<span id="el_property_LastUpdateDate">
<input type="text" data-table="property" data-field="x_LastUpdateDate" name="x_LastUpdateDate" id="x_LastUpdateDate" placeholder="<?php echo HtmlEncode($property_add->LastUpdateDate->getPlaceHolder()) ?>" value="<?php echo $property_add->LastUpdateDate->EditValue ?>"<?php echo $property_add->LastUpdateDate->editAttributes() ?>>
</span>
<?php echo $property_add->LastUpdateDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_add->LandValue->Visible) { // LandValue ?>
	<div id="r_LandValue" class="form-group row">
		<label id="elh_property_LandValue" for="x_LandValue" class="<?php echo $property_add->LeftColumnClass ?>"><?php echo $property_add->LandValue->caption() ?><?php echo $property_add->LandValue->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_add->RightColumnClass ?>"><div <?php echo $property_add->LandValue->cellAttributes() ?>>
<span id="el_property_LandValue">
<input type="text" data-table="property" data-field="x_LandValue" name="x_LandValue" id="x_LandValue" size="30" placeholder="<?php echo HtmlEncode($property_add->LandValue->getPlaceHolder()) ?>" value="<?php echo $property_add->LandValue->EditValue ?>"<?php echo $property_add->LandValue->editAttributes() ?>>
</span>
<?php echo $property_add->LandValue->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_add->ImprovementsValue->Visible) { // ImprovementsValue ?>
	<div id="r_ImprovementsValue" class="form-group row">
		<label id="elh_property_ImprovementsValue" for="x_ImprovementsValue" class="<?php echo $property_add->LeftColumnClass ?>"><?php echo $property_add->ImprovementsValue->caption() ?><?php echo $property_add->ImprovementsValue->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_add->RightColumnClass ?>"><div <?php echo $property_add->ImprovementsValue->cellAttributes() ?>>
<span id="el_property_ImprovementsValue">
<input type="text" data-table="property" data-field="x_ImprovementsValue" name="x_ImprovementsValue" id="x_ImprovementsValue" size="30" placeholder="<?php echo HtmlEncode($property_add->ImprovementsValue->getPlaceHolder()) ?>" value="<?php echo $property_add->ImprovementsValue->EditValue ?>"<?php echo $property_add->ImprovementsValue->editAttributes() ?>>
</span>
<?php echo $property_add->ImprovementsValue->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$property_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $property_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $property_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$property_add->showPageFooter();
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
$property_add->terminate();
?>