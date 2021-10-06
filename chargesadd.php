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
$charges_add = new charges_add();

// Run the page
$charges_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$charges_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fchargesadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fchargesadd = currentForm = new ew.Form("fchargesadd", "add");

	// Validate form
	fchargesadd.validate = function() {
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
			<?php if ($charges_add->ChargeDesc->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeDesc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charges_add->ChargeDesc->caption(), $charges_add->ChargeDesc->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($charges_add->Fee->Required) { ?>
				elm = this.getElements("x" + infix + "_Fee");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charges_add->Fee->caption(), $charges_add->Fee->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Fee");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($charges_add->Fee->errorMessage()) ?>");
			<?php if ($charges_add->ChargeType->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charges_add->ChargeType->caption(), $charges_add->ChargeType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($charges_add->Frequency->Required) { ?>
				elm = this.getElements("x" + infix + "_Frequency");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charges_add->Frequency->caption(), $charges_add->Frequency->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Frequency");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($charges_add->Frequency->errorMessage()) ?>");
			<?php if ($charges_add->Installment->Required) { ?>
				elm = this.getElements("x" + infix + "_Installment");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charges_add->Installment->caption(), $charges_add->Installment->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($charges_add->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charges_add->DepartmentCode->caption(), $charges_add->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($charges_add->GLAccount->Required) { ?>
				elm = this.getElements("x" + infix + "_GLAccount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charges_add->GLAccount->caption(), $charges_add->GLAccount->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($charges_add->ChargeGroup->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeGroup");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charges_add->ChargeGroup->caption(), $charges_add->ChargeGroup->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($charges_add->UnitOfMeasure->Required) { ?>
				elm = this.getElements("x" + infix + "_UnitOfMeasure");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charges_add->UnitOfMeasure->caption(), $charges_add->UnitOfMeasure->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($charges_add->Factor->Required) { ?>
				elm = this.getElements("x" + infix + "_Factor");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charges_add->Factor->caption(), $charges_add->Factor->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Factor");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($charges_add->Factor->errorMessage()) ?>");
			<?php if ($charges_add->PeriodType->Required) { ?>
				elm = this.getElements("x" + infix + "_PeriodType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charges_add->PeriodType->caption(), $charges_add->PeriodType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($charges_add->ClearedChargeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ClearedChargeCode[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charges_add->ClearedChargeCode->caption(), $charges_add->ClearedChargeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($charges_add->PropertyUse->Required) { ?>
				elm = this.getElements("x" + infix + "_PropertyUse");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charges_add->PropertyUse->caption(), $charges_add->PropertyUse->RequiredErrorMessage)) ?>");
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
	fchargesadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fchargesadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fchargesadd.lists["x_ChargeType"] = <?php echo $charges_add->ChargeType->Lookup->toClientList($charges_add) ?>;
	fchargesadd.lists["x_ChargeType"].options = <?php echo JsonEncode($charges_add->ChargeType->lookupOptions()) ?>;
	fchargesadd.lists["x_Installment"] = <?php echo $charges_add->Installment->Lookup->toClientList($charges_add) ?>;
	fchargesadd.lists["x_Installment"].options = <?php echo JsonEncode($charges_add->Installment->lookupOptions()) ?>;
	fchargesadd.lists["x_DepartmentCode"] = <?php echo $charges_add->DepartmentCode->Lookup->toClientList($charges_add) ?>;
	fchargesadd.lists["x_DepartmentCode"].options = <?php echo JsonEncode($charges_add->DepartmentCode->lookupOptions()) ?>;
	fchargesadd.lists["x_GLAccount"] = <?php echo $charges_add->GLAccount->Lookup->toClientList($charges_add) ?>;
	fchargesadd.lists["x_GLAccount"].options = <?php echo JsonEncode($charges_add->GLAccount->lookupOptions()) ?>;
	fchargesadd.lists["x_ChargeGroup"] = <?php echo $charges_add->ChargeGroup->Lookup->toClientList($charges_add) ?>;
	fchargesadd.lists["x_ChargeGroup"].options = <?php echo JsonEncode($charges_add->ChargeGroup->lookupOptions()) ?>;
	fchargesadd.lists["x_UnitOfMeasure"] = <?php echo $charges_add->UnitOfMeasure->Lookup->toClientList($charges_add) ?>;
	fchargesadd.lists["x_UnitOfMeasure"].options = <?php echo JsonEncode($charges_add->UnitOfMeasure->lookupOptions()) ?>;
	fchargesadd.lists["x_PeriodType"] = <?php echo $charges_add->PeriodType->Lookup->toClientList($charges_add) ?>;
	fchargesadd.lists["x_PeriodType"].options = <?php echo JsonEncode($charges_add->PeriodType->lookupOptions()) ?>;
	fchargesadd.lists["x_ClearedChargeCode[]"] = <?php echo $charges_add->ClearedChargeCode->Lookup->toClientList($charges_add) ?>;
	fchargesadd.lists["x_ClearedChargeCode[]"].options = <?php echo JsonEncode($charges_add->ClearedChargeCode->lookupOptions()) ?>;
	fchargesadd.lists["x_PropertyUse"] = <?php echo $charges_add->PropertyUse->Lookup->toClientList($charges_add) ?>;
	fchargesadd.lists["x_PropertyUse"].options = <?php echo JsonEncode($charges_add->PropertyUse->lookupOptions()) ?>;
	loadjs.done("fchargesadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $charges_add->showPageHeader(); ?>
<?php
$charges_add->showMessage();
?>
<form name="fchargesadd" id="fchargesadd" class="<?php echo $charges_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="charges">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$charges_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($charges_add->ChargeDesc->Visible) { // ChargeDesc ?>
	<div id="r_ChargeDesc" class="form-group row">
		<label id="elh_charges_ChargeDesc" for="x_ChargeDesc" class="<?php echo $charges_add->LeftColumnClass ?>"><?php echo $charges_add->ChargeDesc->caption() ?><?php echo $charges_add->ChargeDesc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $charges_add->RightColumnClass ?>"><div <?php echo $charges_add->ChargeDesc->cellAttributes() ?>>
<span id="el_charges_ChargeDesc">
<input type="text" data-table="charges" data-field="x_ChargeDesc" name="x_ChargeDesc" id="x_ChargeDesc" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($charges_add->ChargeDesc->getPlaceHolder()) ?>" value="<?php echo $charges_add->ChargeDesc->EditValue ?>"<?php echo $charges_add->ChargeDesc->editAttributes() ?>>
</span>
<?php echo $charges_add->ChargeDesc->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($charges_add->Fee->Visible) { // Fee ?>
	<div id="r_Fee" class="form-group row">
		<label id="elh_charges_Fee" for="x_Fee" class="<?php echo $charges_add->LeftColumnClass ?>"><?php echo $charges_add->Fee->caption() ?><?php echo $charges_add->Fee->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $charges_add->RightColumnClass ?>"><div <?php echo $charges_add->Fee->cellAttributes() ?>>
<span id="el_charges_Fee">
<input type="text" data-table="charges" data-field="x_Fee" name="x_Fee" id="x_Fee" size="30" placeholder="<?php echo HtmlEncode($charges_add->Fee->getPlaceHolder()) ?>" value="<?php echo $charges_add->Fee->EditValue ?>"<?php echo $charges_add->Fee->editAttributes() ?>>
</span>
<?php echo $charges_add->Fee->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($charges_add->ChargeType->Visible) { // ChargeType ?>
	<div id="r_ChargeType" class="form-group row">
		<label id="elh_charges_ChargeType" for="x_ChargeType" class="<?php echo $charges_add->LeftColumnClass ?>"><?php echo $charges_add->ChargeType->caption() ?><?php echo $charges_add->ChargeType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $charges_add->RightColumnClass ?>"><div <?php echo $charges_add->ChargeType->cellAttributes() ?>>
<span id="el_charges_ChargeType">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_ChargeType"><?php echo EmptyValue(strval($charges_add->ChargeType->ViewValue)) ? $Language->phrase("PleaseSelect") : $charges_add->ChargeType->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($charges_add->ChargeType->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($charges_add->ChargeType->ReadOnly || $charges_add->ChargeType->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_ChargeType',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $charges_add->ChargeType->Lookup->getParamTag($charges_add, "p_x_ChargeType") ?>
<input type="hidden" data-table="charges" data-field="x_ChargeType" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $charges_add->ChargeType->displayValueSeparatorAttribute() ?>" name="x_ChargeType" id="x_ChargeType" value="<?php echo $charges_add->ChargeType->CurrentValue ?>"<?php echo $charges_add->ChargeType->editAttributes() ?>>
</span>
<?php echo $charges_add->ChargeType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($charges_add->Frequency->Visible) { // Frequency ?>
	<div id="r_Frequency" class="form-group row">
		<label id="elh_charges_Frequency" for="x_Frequency" class="<?php echo $charges_add->LeftColumnClass ?>"><?php echo $charges_add->Frequency->caption() ?><?php echo $charges_add->Frequency->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $charges_add->RightColumnClass ?>"><div <?php echo $charges_add->Frequency->cellAttributes() ?>>
<span id="el_charges_Frequency">
<input type="text" data-table="charges" data-field="x_Frequency" name="x_Frequency" id="x_Frequency" size="30" placeholder="<?php echo HtmlEncode($charges_add->Frequency->getPlaceHolder()) ?>" value="<?php echo $charges_add->Frequency->EditValue ?>"<?php echo $charges_add->Frequency->editAttributes() ?>>
</span>
<?php echo $charges_add->Frequency->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($charges_add->Installment->Visible) { // Installment ?>
	<div id="r_Installment" class="form-group row">
		<label id="elh_charges_Installment" for="x_Installment" class="<?php echo $charges_add->LeftColumnClass ?>"><?php echo $charges_add->Installment->caption() ?><?php echo $charges_add->Installment->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $charges_add->RightColumnClass ?>"><div <?php echo $charges_add->Installment->cellAttributes() ?>>
<span id="el_charges_Installment">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="charges" data-field="x_Installment" data-value-separator="<?php echo $charges_add->Installment->displayValueSeparatorAttribute() ?>" id="x_Installment" name="x_Installment"<?php echo $charges_add->Installment->editAttributes() ?>>
			<?php echo $charges_add->Installment->selectOptionListHtml("x_Installment") ?>
		</select>
</div>
<?php echo $charges_add->Installment->Lookup->getParamTag($charges_add, "p_x_Installment") ?>
</span>
<?php echo $charges_add->Installment->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($charges_add->DepartmentCode->Visible) { // DepartmentCode ?>
	<div id="r_DepartmentCode" class="form-group row">
		<label id="elh_charges_DepartmentCode" for="x_DepartmentCode" class="<?php echo $charges_add->LeftColumnClass ?>"><?php echo $charges_add->DepartmentCode->caption() ?><?php echo $charges_add->DepartmentCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $charges_add->RightColumnClass ?>"><div <?php echo $charges_add->DepartmentCode->cellAttributes() ?>>
<span id="el_charges_DepartmentCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_DepartmentCode"><?php echo EmptyValue(strval($charges_add->DepartmentCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $charges_add->DepartmentCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($charges_add->DepartmentCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($charges_add->DepartmentCode->ReadOnly || $charges_add->DepartmentCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_DepartmentCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $charges_add->DepartmentCode->Lookup->getParamTag($charges_add, "p_x_DepartmentCode") ?>
<input type="hidden" data-table="charges" data-field="x_DepartmentCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $charges_add->DepartmentCode->displayValueSeparatorAttribute() ?>" name="x_DepartmentCode" id="x_DepartmentCode" value="<?php echo $charges_add->DepartmentCode->CurrentValue ?>"<?php echo $charges_add->DepartmentCode->editAttributes() ?>>
</span>
<?php echo $charges_add->DepartmentCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($charges_add->GLAccount->Visible) { // GLAccount ?>
	<div id="r_GLAccount" class="form-group row">
		<label id="elh_charges_GLAccount" for="x_GLAccount" class="<?php echo $charges_add->LeftColumnClass ?>"><?php echo $charges_add->GLAccount->caption() ?><?php echo $charges_add->GLAccount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $charges_add->RightColumnClass ?>"><div <?php echo $charges_add->GLAccount->cellAttributes() ?>>
<span id="el_charges_GLAccount">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_GLAccount"><?php echo EmptyValue(strval($charges_add->GLAccount->ViewValue)) ? $Language->phrase("PleaseSelect") : $charges_add->GLAccount->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($charges_add->GLAccount->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($charges_add->GLAccount->ReadOnly || $charges_add->GLAccount->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_GLAccount',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $charges_add->GLAccount->Lookup->getParamTag($charges_add, "p_x_GLAccount") ?>
<input type="hidden" data-table="charges" data-field="x_GLAccount" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $charges_add->GLAccount->displayValueSeparatorAttribute() ?>" name="x_GLAccount" id="x_GLAccount" value="<?php echo $charges_add->GLAccount->CurrentValue ?>"<?php echo $charges_add->GLAccount->editAttributes() ?>>
</span>
<?php echo $charges_add->GLAccount->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($charges_add->ChargeGroup->Visible) { // ChargeGroup ?>
	<div id="r_ChargeGroup" class="form-group row">
		<label id="elh_charges_ChargeGroup" for="x_ChargeGroup" class="<?php echo $charges_add->LeftColumnClass ?>"><?php echo $charges_add->ChargeGroup->caption() ?><?php echo $charges_add->ChargeGroup->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $charges_add->RightColumnClass ?>"><div <?php echo $charges_add->ChargeGroup->cellAttributes() ?>>
<span id="el_charges_ChargeGroup">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="charges" data-field="x_ChargeGroup" data-value-separator="<?php echo $charges_add->ChargeGroup->displayValueSeparatorAttribute() ?>" id="x_ChargeGroup" name="x_ChargeGroup"<?php echo $charges_add->ChargeGroup->editAttributes() ?>>
			<?php echo $charges_add->ChargeGroup->selectOptionListHtml("x_ChargeGroup") ?>
		</select>
</div>
<?php echo $charges_add->ChargeGroup->Lookup->getParamTag($charges_add, "p_x_ChargeGroup") ?>
</span>
<?php echo $charges_add->ChargeGroup->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($charges_add->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
	<div id="r_UnitOfMeasure" class="form-group row">
		<label id="elh_charges_UnitOfMeasure" for="x_UnitOfMeasure" class="<?php echo $charges_add->LeftColumnClass ?>"><?php echo $charges_add->UnitOfMeasure->caption() ?><?php echo $charges_add->UnitOfMeasure->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $charges_add->RightColumnClass ?>"><div <?php echo $charges_add->UnitOfMeasure->cellAttributes() ?>>
<span id="el_charges_UnitOfMeasure">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_UnitOfMeasure"><?php echo EmptyValue(strval($charges_add->UnitOfMeasure->ViewValue)) ? $Language->phrase("PleaseSelect") : $charges_add->UnitOfMeasure->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($charges_add->UnitOfMeasure->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($charges_add->UnitOfMeasure->ReadOnly || $charges_add->UnitOfMeasure->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_UnitOfMeasure',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $charges_add->UnitOfMeasure->Lookup->getParamTag($charges_add, "p_x_UnitOfMeasure") ?>
<input type="hidden" data-table="charges" data-field="x_UnitOfMeasure" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $charges_add->UnitOfMeasure->displayValueSeparatorAttribute() ?>" name="x_UnitOfMeasure" id="x_UnitOfMeasure" value="<?php echo $charges_add->UnitOfMeasure->CurrentValue ?>"<?php echo $charges_add->UnitOfMeasure->editAttributes() ?>>
</span>
<?php echo $charges_add->UnitOfMeasure->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($charges_add->Factor->Visible) { // Factor ?>
	<div id="r_Factor" class="form-group row">
		<label id="elh_charges_Factor" for="x_Factor" class="<?php echo $charges_add->LeftColumnClass ?>"><?php echo $charges_add->Factor->caption() ?><?php echo $charges_add->Factor->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $charges_add->RightColumnClass ?>"><div <?php echo $charges_add->Factor->cellAttributes() ?>>
<span id="el_charges_Factor">
<input type="text" data-table="charges" data-field="x_Factor" name="x_Factor" id="x_Factor" size="30" placeholder="<?php echo HtmlEncode($charges_add->Factor->getPlaceHolder()) ?>" value="<?php echo $charges_add->Factor->EditValue ?>"<?php echo $charges_add->Factor->editAttributes() ?>>
</span>
<?php echo $charges_add->Factor->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($charges_add->PeriodType->Visible) { // PeriodType ?>
	<div id="r_PeriodType" class="form-group row">
		<label id="elh_charges_PeriodType" for="x_PeriodType" class="<?php echo $charges_add->LeftColumnClass ?>"><?php echo $charges_add->PeriodType->caption() ?><?php echo $charges_add->PeriodType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $charges_add->RightColumnClass ?>"><div <?php echo $charges_add->PeriodType->cellAttributes() ?>>
<span id="el_charges_PeriodType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="charges" data-field="x_PeriodType" data-value-separator="<?php echo $charges_add->PeriodType->displayValueSeparatorAttribute() ?>" id="x_PeriodType" name="x_PeriodType"<?php echo $charges_add->PeriodType->editAttributes() ?>>
			<?php echo $charges_add->PeriodType->selectOptionListHtml("x_PeriodType") ?>
		</select>
</div>
<?php echo $charges_add->PeriodType->Lookup->getParamTag($charges_add, "p_x_PeriodType") ?>
</span>
<?php echo $charges_add->PeriodType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($charges_add->ClearedChargeCode->Visible) { // ClearedChargeCode ?>
	<div id="r_ClearedChargeCode" class="form-group row">
		<label id="elh_charges_ClearedChargeCode" class="<?php echo $charges_add->LeftColumnClass ?>"><?php echo $charges_add->ClearedChargeCode->caption() ?><?php echo $charges_add->ClearedChargeCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $charges_add->RightColumnClass ?>"><div <?php echo $charges_add->ClearedChargeCode->cellAttributes() ?>>
<span id="el_charges_ClearedChargeCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_ClearedChargeCode"><?php echo EmptyValue(strval($charges_add->ClearedChargeCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $charges_add->ClearedChargeCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($charges_add->ClearedChargeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($charges_add->ClearedChargeCode->ReadOnly || $charges_add->ClearedChargeCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_ClearedChargeCode[]',m:1,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $charges_add->ClearedChargeCode->Lookup->getParamTag($charges_add, "p_x_ClearedChargeCode") ?>
<input type="hidden" data-table="charges" data-field="x_ClearedChargeCode" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $charges_add->ClearedChargeCode->displayValueSeparatorAttribute() ?>" name="x_ClearedChargeCode[]" id="x_ClearedChargeCode[]" value="<?php echo $charges_add->ClearedChargeCode->CurrentValue ?>"<?php echo $charges_add->ClearedChargeCode->editAttributes() ?>>
</span>
<?php echo $charges_add->ClearedChargeCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($charges_add->PropertyUse->Visible) { // PropertyUse ?>
	<div id="r_PropertyUse" class="form-group row">
		<label id="elh_charges_PropertyUse" for="x_PropertyUse" class="<?php echo $charges_add->LeftColumnClass ?>"><?php echo $charges_add->PropertyUse->caption() ?><?php echo $charges_add->PropertyUse->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $charges_add->RightColumnClass ?>"><div <?php echo $charges_add->PropertyUse->cellAttributes() ?>>
<span id="el_charges_PropertyUse">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="charges" data-field="x_PropertyUse" data-value-separator="<?php echo $charges_add->PropertyUse->displayValueSeparatorAttribute() ?>" id="x_PropertyUse" name="x_PropertyUse"<?php echo $charges_add->PropertyUse->editAttributes() ?>>
			<?php echo $charges_add->PropertyUse->selectOptionListHtml("x_PropertyUse") ?>
		</select>
</div>
<?php echo $charges_add->PropertyUse->Lookup->getParamTag($charges_add, "p_x_PropertyUse") ?>
</span>
<?php echo $charges_add->PropertyUse->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$charges_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $charges_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $charges_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$charges_add->showPageFooter();
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
$charges_add->terminate();
?>