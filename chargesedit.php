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
$charges_edit = new charges_edit();

// Run the page
$charges_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$charges_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fchargesedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fchargesedit = currentForm = new ew.Form("fchargesedit", "edit");

	// Validate form
	fchargesedit.validate = function() {
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
			<?php if ($charges_edit->ChargeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charges_edit->ChargeCode->caption(), $charges_edit->ChargeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($charges_edit->ChargeDesc->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeDesc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charges_edit->ChargeDesc->caption(), $charges_edit->ChargeDesc->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($charges_edit->Fee->Required) { ?>
				elm = this.getElements("x" + infix + "_Fee");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charges_edit->Fee->caption(), $charges_edit->Fee->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Fee");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($charges_edit->Fee->errorMessage()) ?>");
			<?php if ($charges_edit->ChargeType->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charges_edit->ChargeType->caption(), $charges_edit->ChargeType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($charges_edit->Frequency->Required) { ?>
				elm = this.getElements("x" + infix + "_Frequency");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charges_edit->Frequency->caption(), $charges_edit->Frequency->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Frequency");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($charges_edit->Frequency->errorMessage()) ?>");
			<?php if ($charges_edit->Installment->Required) { ?>
				elm = this.getElements("x" + infix + "_Installment");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charges_edit->Installment->caption(), $charges_edit->Installment->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($charges_edit->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charges_edit->DepartmentCode->caption(), $charges_edit->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($charges_edit->GLAccount->Required) { ?>
				elm = this.getElements("x" + infix + "_GLAccount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charges_edit->GLAccount->caption(), $charges_edit->GLAccount->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($charges_edit->ChargeGroup->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeGroup");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charges_edit->ChargeGroup->caption(), $charges_edit->ChargeGroup->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($charges_edit->UnitOfMeasure->Required) { ?>
				elm = this.getElements("x" + infix + "_UnitOfMeasure");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charges_edit->UnitOfMeasure->caption(), $charges_edit->UnitOfMeasure->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($charges_edit->Factor->Required) { ?>
				elm = this.getElements("x" + infix + "_Factor");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charges_edit->Factor->caption(), $charges_edit->Factor->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Factor");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($charges_edit->Factor->errorMessage()) ?>");
			<?php if ($charges_edit->PeriodType->Required) { ?>
				elm = this.getElements("x" + infix + "_PeriodType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charges_edit->PeriodType->caption(), $charges_edit->PeriodType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($charges_edit->ClearedChargeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ClearedChargeCode[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charges_edit->ClearedChargeCode->caption(), $charges_edit->ClearedChargeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($charges_edit->PropertyUse->Required) { ?>
				elm = this.getElements("x" + infix + "_PropertyUse");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charges_edit->PropertyUse->caption(), $charges_edit->PropertyUse->RequiredErrorMessage)) ?>");
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
	fchargesedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fchargesedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fchargesedit.lists["x_ChargeType"] = <?php echo $charges_edit->ChargeType->Lookup->toClientList($charges_edit) ?>;
	fchargesedit.lists["x_ChargeType"].options = <?php echo JsonEncode($charges_edit->ChargeType->lookupOptions()) ?>;
	fchargesedit.lists["x_Installment"] = <?php echo $charges_edit->Installment->Lookup->toClientList($charges_edit) ?>;
	fchargesedit.lists["x_Installment"].options = <?php echo JsonEncode($charges_edit->Installment->lookupOptions()) ?>;
	fchargesedit.lists["x_DepartmentCode"] = <?php echo $charges_edit->DepartmentCode->Lookup->toClientList($charges_edit) ?>;
	fchargesedit.lists["x_DepartmentCode"].options = <?php echo JsonEncode($charges_edit->DepartmentCode->lookupOptions()) ?>;
	fchargesedit.lists["x_GLAccount"] = <?php echo $charges_edit->GLAccount->Lookup->toClientList($charges_edit) ?>;
	fchargesedit.lists["x_GLAccount"].options = <?php echo JsonEncode($charges_edit->GLAccount->lookupOptions()) ?>;
	fchargesedit.lists["x_ChargeGroup"] = <?php echo $charges_edit->ChargeGroup->Lookup->toClientList($charges_edit) ?>;
	fchargesedit.lists["x_ChargeGroup"].options = <?php echo JsonEncode($charges_edit->ChargeGroup->lookupOptions()) ?>;
	fchargesedit.lists["x_UnitOfMeasure"] = <?php echo $charges_edit->UnitOfMeasure->Lookup->toClientList($charges_edit) ?>;
	fchargesedit.lists["x_UnitOfMeasure"].options = <?php echo JsonEncode($charges_edit->UnitOfMeasure->lookupOptions()) ?>;
	fchargesedit.lists["x_PeriodType"] = <?php echo $charges_edit->PeriodType->Lookup->toClientList($charges_edit) ?>;
	fchargesedit.lists["x_PeriodType"].options = <?php echo JsonEncode($charges_edit->PeriodType->lookupOptions()) ?>;
	fchargesedit.lists["x_ClearedChargeCode[]"] = <?php echo $charges_edit->ClearedChargeCode->Lookup->toClientList($charges_edit) ?>;
	fchargesedit.lists["x_ClearedChargeCode[]"].options = <?php echo JsonEncode($charges_edit->ClearedChargeCode->lookupOptions()) ?>;
	fchargesedit.lists["x_PropertyUse"] = <?php echo $charges_edit->PropertyUse->Lookup->toClientList($charges_edit) ?>;
	fchargesedit.lists["x_PropertyUse"].options = <?php echo JsonEncode($charges_edit->PropertyUse->lookupOptions()) ?>;
	loadjs.done("fchargesedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $charges_edit->showPageHeader(); ?>
<?php
$charges_edit->showMessage();
?>
<?php if (!$charges_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $charges_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fchargesedit" id="fchargesedit" class="<?php echo $charges_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="charges">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$charges_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($charges_edit->ChargeCode->Visible) { // ChargeCode ?>
	<div id="r_ChargeCode" class="form-group row">
		<label id="elh_charges_ChargeCode" class="<?php echo $charges_edit->LeftColumnClass ?>"><?php echo $charges_edit->ChargeCode->caption() ?><?php echo $charges_edit->ChargeCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $charges_edit->RightColumnClass ?>"><div <?php echo $charges_edit->ChargeCode->cellAttributes() ?>>
<span id="el_charges_ChargeCode">
<span<?php echo $charges_edit->ChargeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($charges_edit->ChargeCode->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="charges" data-field="x_ChargeCode" name="x_ChargeCode" id="x_ChargeCode" value="<?php echo HtmlEncode($charges_edit->ChargeCode->CurrentValue) ?>">
<?php echo $charges_edit->ChargeCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($charges_edit->ChargeDesc->Visible) { // ChargeDesc ?>
	<div id="r_ChargeDesc" class="form-group row">
		<label id="elh_charges_ChargeDesc" for="x_ChargeDesc" class="<?php echo $charges_edit->LeftColumnClass ?>"><?php echo $charges_edit->ChargeDesc->caption() ?><?php echo $charges_edit->ChargeDesc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $charges_edit->RightColumnClass ?>"><div <?php echo $charges_edit->ChargeDesc->cellAttributes() ?>>
<span id="el_charges_ChargeDesc">
<input type="text" data-table="charges" data-field="x_ChargeDesc" name="x_ChargeDesc" id="x_ChargeDesc" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($charges_edit->ChargeDesc->getPlaceHolder()) ?>" value="<?php echo $charges_edit->ChargeDesc->EditValue ?>"<?php echo $charges_edit->ChargeDesc->editAttributes() ?>>
</span>
<?php echo $charges_edit->ChargeDesc->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($charges_edit->Fee->Visible) { // Fee ?>
	<div id="r_Fee" class="form-group row">
		<label id="elh_charges_Fee" for="x_Fee" class="<?php echo $charges_edit->LeftColumnClass ?>"><?php echo $charges_edit->Fee->caption() ?><?php echo $charges_edit->Fee->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $charges_edit->RightColumnClass ?>"><div <?php echo $charges_edit->Fee->cellAttributes() ?>>
<span id="el_charges_Fee">
<input type="text" data-table="charges" data-field="x_Fee" name="x_Fee" id="x_Fee" size="30" placeholder="<?php echo HtmlEncode($charges_edit->Fee->getPlaceHolder()) ?>" value="<?php echo $charges_edit->Fee->EditValue ?>"<?php echo $charges_edit->Fee->editAttributes() ?>>
</span>
<?php echo $charges_edit->Fee->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($charges_edit->ChargeType->Visible) { // ChargeType ?>
	<div id="r_ChargeType" class="form-group row">
		<label id="elh_charges_ChargeType" for="x_ChargeType" class="<?php echo $charges_edit->LeftColumnClass ?>"><?php echo $charges_edit->ChargeType->caption() ?><?php echo $charges_edit->ChargeType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $charges_edit->RightColumnClass ?>"><div <?php echo $charges_edit->ChargeType->cellAttributes() ?>>
<span id="el_charges_ChargeType">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_ChargeType"><?php echo EmptyValue(strval($charges_edit->ChargeType->ViewValue)) ? $Language->phrase("PleaseSelect") : $charges_edit->ChargeType->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($charges_edit->ChargeType->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($charges_edit->ChargeType->ReadOnly || $charges_edit->ChargeType->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_ChargeType',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $charges_edit->ChargeType->Lookup->getParamTag($charges_edit, "p_x_ChargeType") ?>
<input type="hidden" data-table="charges" data-field="x_ChargeType" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $charges_edit->ChargeType->displayValueSeparatorAttribute() ?>" name="x_ChargeType" id="x_ChargeType" value="<?php echo $charges_edit->ChargeType->CurrentValue ?>"<?php echo $charges_edit->ChargeType->editAttributes() ?>>
</span>
<?php echo $charges_edit->ChargeType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($charges_edit->Frequency->Visible) { // Frequency ?>
	<div id="r_Frequency" class="form-group row">
		<label id="elh_charges_Frequency" for="x_Frequency" class="<?php echo $charges_edit->LeftColumnClass ?>"><?php echo $charges_edit->Frequency->caption() ?><?php echo $charges_edit->Frequency->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $charges_edit->RightColumnClass ?>"><div <?php echo $charges_edit->Frequency->cellAttributes() ?>>
<span id="el_charges_Frequency">
<input type="text" data-table="charges" data-field="x_Frequency" name="x_Frequency" id="x_Frequency" size="30" placeholder="<?php echo HtmlEncode($charges_edit->Frequency->getPlaceHolder()) ?>" value="<?php echo $charges_edit->Frequency->EditValue ?>"<?php echo $charges_edit->Frequency->editAttributes() ?>>
</span>
<?php echo $charges_edit->Frequency->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($charges_edit->Installment->Visible) { // Installment ?>
	<div id="r_Installment" class="form-group row">
		<label id="elh_charges_Installment" for="x_Installment" class="<?php echo $charges_edit->LeftColumnClass ?>"><?php echo $charges_edit->Installment->caption() ?><?php echo $charges_edit->Installment->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $charges_edit->RightColumnClass ?>"><div <?php echo $charges_edit->Installment->cellAttributes() ?>>
<span id="el_charges_Installment">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="charges" data-field="x_Installment" data-value-separator="<?php echo $charges_edit->Installment->displayValueSeparatorAttribute() ?>" id="x_Installment" name="x_Installment"<?php echo $charges_edit->Installment->editAttributes() ?>>
			<?php echo $charges_edit->Installment->selectOptionListHtml("x_Installment") ?>
		</select>
</div>
<?php echo $charges_edit->Installment->Lookup->getParamTag($charges_edit, "p_x_Installment") ?>
</span>
<?php echo $charges_edit->Installment->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($charges_edit->DepartmentCode->Visible) { // DepartmentCode ?>
	<div id="r_DepartmentCode" class="form-group row">
		<label id="elh_charges_DepartmentCode" for="x_DepartmentCode" class="<?php echo $charges_edit->LeftColumnClass ?>"><?php echo $charges_edit->DepartmentCode->caption() ?><?php echo $charges_edit->DepartmentCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $charges_edit->RightColumnClass ?>"><div <?php echo $charges_edit->DepartmentCode->cellAttributes() ?>>
<span id="el_charges_DepartmentCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_DepartmentCode"><?php echo EmptyValue(strval($charges_edit->DepartmentCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $charges_edit->DepartmentCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($charges_edit->DepartmentCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($charges_edit->DepartmentCode->ReadOnly || $charges_edit->DepartmentCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_DepartmentCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $charges_edit->DepartmentCode->Lookup->getParamTag($charges_edit, "p_x_DepartmentCode") ?>
<input type="hidden" data-table="charges" data-field="x_DepartmentCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $charges_edit->DepartmentCode->displayValueSeparatorAttribute() ?>" name="x_DepartmentCode" id="x_DepartmentCode" value="<?php echo $charges_edit->DepartmentCode->CurrentValue ?>"<?php echo $charges_edit->DepartmentCode->editAttributes() ?>>
</span>
<?php echo $charges_edit->DepartmentCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($charges_edit->GLAccount->Visible) { // GLAccount ?>
	<div id="r_GLAccount" class="form-group row">
		<label id="elh_charges_GLAccount" for="x_GLAccount" class="<?php echo $charges_edit->LeftColumnClass ?>"><?php echo $charges_edit->GLAccount->caption() ?><?php echo $charges_edit->GLAccount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $charges_edit->RightColumnClass ?>"><div <?php echo $charges_edit->GLAccount->cellAttributes() ?>>
<span id="el_charges_GLAccount">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_GLAccount"><?php echo EmptyValue(strval($charges_edit->GLAccount->ViewValue)) ? $Language->phrase("PleaseSelect") : $charges_edit->GLAccount->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($charges_edit->GLAccount->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($charges_edit->GLAccount->ReadOnly || $charges_edit->GLAccount->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_GLAccount',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $charges_edit->GLAccount->Lookup->getParamTag($charges_edit, "p_x_GLAccount") ?>
<input type="hidden" data-table="charges" data-field="x_GLAccount" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $charges_edit->GLAccount->displayValueSeparatorAttribute() ?>" name="x_GLAccount" id="x_GLAccount" value="<?php echo $charges_edit->GLAccount->CurrentValue ?>"<?php echo $charges_edit->GLAccount->editAttributes() ?>>
</span>
<?php echo $charges_edit->GLAccount->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($charges_edit->ChargeGroup->Visible) { // ChargeGroup ?>
	<div id="r_ChargeGroup" class="form-group row">
		<label id="elh_charges_ChargeGroup" for="x_ChargeGroup" class="<?php echo $charges_edit->LeftColumnClass ?>"><?php echo $charges_edit->ChargeGroup->caption() ?><?php echo $charges_edit->ChargeGroup->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $charges_edit->RightColumnClass ?>"><div <?php echo $charges_edit->ChargeGroup->cellAttributes() ?>>
<span id="el_charges_ChargeGroup">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="charges" data-field="x_ChargeGroup" data-value-separator="<?php echo $charges_edit->ChargeGroup->displayValueSeparatorAttribute() ?>" id="x_ChargeGroup" name="x_ChargeGroup"<?php echo $charges_edit->ChargeGroup->editAttributes() ?>>
			<?php echo $charges_edit->ChargeGroup->selectOptionListHtml("x_ChargeGroup") ?>
		</select>
</div>
<?php echo $charges_edit->ChargeGroup->Lookup->getParamTag($charges_edit, "p_x_ChargeGroup") ?>
</span>
<?php echo $charges_edit->ChargeGroup->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($charges_edit->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
	<div id="r_UnitOfMeasure" class="form-group row">
		<label id="elh_charges_UnitOfMeasure" for="x_UnitOfMeasure" class="<?php echo $charges_edit->LeftColumnClass ?>"><?php echo $charges_edit->UnitOfMeasure->caption() ?><?php echo $charges_edit->UnitOfMeasure->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $charges_edit->RightColumnClass ?>"><div <?php echo $charges_edit->UnitOfMeasure->cellAttributes() ?>>
<span id="el_charges_UnitOfMeasure">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_UnitOfMeasure"><?php echo EmptyValue(strval($charges_edit->UnitOfMeasure->ViewValue)) ? $Language->phrase("PleaseSelect") : $charges_edit->UnitOfMeasure->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($charges_edit->UnitOfMeasure->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($charges_edit->UnitOfMeasure->ReadOnly || $charges_edit->UnitOfMeasure->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_UnitOfMeasure',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $charges_edit->UnitOfMeasure->Lookup->getParamTag($charges_edit, "p_x_UnitOfMeasure") ?>
<input type="hidden" data-table="charges" data-field="x_UnitOfMeasure" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $charges_edit->UnitOfMeasure->displayValueSeparatorAttribute() ?>" name="x_UnitOfMeasure" id="x_UnitOfMeasure" value="<?php echo $charges_edit->UnitOfMeasure->CurrentValue ?>"<?php echo $charges_edit->UnitOfMeasure->editAttributes() ?>>
</span>
<?php echo $charges_edit->UnitOfMeasure->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($charges_edit->Factor->Visible) { // Factor ?>
	<div id="r_Factor" class="form-group row">
		<label id="elh_charges_Factor" for="x_Factor" class="<?php echo $charges_edit->LeftColumnClass ?>"><?php echo $charges_edit->Factor->caption() ?><?php echo $charges_edit->Factor->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $charges_edit->RightColumnClass ?>"><div <?php echo $charges_edit->Factor->cellAttributes() ?>>
<span id="el_charges_Factor">
<input type="text" data-table="charges" data-field="x_Factor" name="x_Factor" id="x_Factor" size="30" placeholder="<?php echo HtmlEncode($charges_edit->Factor->getPlaceHolder()) ?>" value="<?php echo $charges_edit->Factor->EditValue ?>"<?php echo $charges_edit->Factor->editAttributes() ?>>
</span>
<?php echo $charges_edit->Factor->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($charges_edit->PeriodType->Visible) { // PeriodType ?>
	<div id="r_PeriodType" class="form-group row">
		<label id="elh_charges_PeriodType" for="x_PeriodType" class="<?php echo $charges_edit->LeftColumnClass ?>"><?php echo $charges_edit->PeriodType->caption() ?><?php echo $charges_edit->PeriodType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $charges_edit->RightColumnClass ?>"><div <?php echo $charges_edit->PeriodType->cellAttributes() ?>>
<span id="el_charges_PeriodType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="charges" data-field="x_PeriodType" data-value-separator="<?php echo $charges_edit->PeriodType->displayValueSeparatorAttribute() ?>" id="x_PeriodType" name="x_PeriodType"<?php echo $charges_edit->PeriodType->editAttributes() ?>>
			<?php echo $charges_edit->PeriodType->selectOptionListHtml("x_PeriodType") ?>
		</select>
</div>
<?php echo $charges_edit->PeriodType->Lookup->getParamTag($charges_edit, "p_x_PeriodType") ?>
</span>
<?php echo $charges_edit->PeriodType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($charges_edit->ClearedChargeCode->Visible) { // ClearedChargeCode ?>
	<div id="r_ClearedChargeCode" class="form-group row">
		<label id="elh_charges_ClearedChargeCode" class="<?php echo $charges_edit->LeftColumnClass ?>"><?php echo $charges_edit->ClearedChargeCode->caption() ?><?php echo $charges_edit->ClearedChargeCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $charges_edit->RightColumnClass ?>"><div <?php echo $charges_edit->ClearedChargeCode->cellAttributes() ?>>
<span id="el_charges_ClearedChargeCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_ClearedChargeCode"><?php echo EmptyValue(strval($charges_edit->ClearedChargeCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $charges_edit->ClearedChargeCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($charges_edit->ClearedChargeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($charges_edit->ClearedChargeCode->ReadOnly || $charges_edit->ClearedChargeCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_ClearedChargeCode[]',m:1,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $charges_edit->ClearedChargeCode->Lookup->getParamTag($charges_edit, "p_x_ClearedChargeCode") ?>
<input type="hidden" data-table="charges" data-field="x_ClearedChargeCode" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $charges_edit->ClearedChargeCode->displayValueSeparatorAttribute() ?>" name="x_ClearedChargeCode[]" id="x_ClearedChargeCode[]" value="<?php echo $charges_edit->ClearedChargeCode->CurrentValue ?>"<?php echo $charges_edit->ClearedChargeCode->editAttributes() ?>>
</span>
<?php echo $charges_edit->ClearedChargeCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($charges_edit->PropertyUse->Visible) { // PropertyUse ?>
	<div id="r_PropertyUse" class="form-group row">
		<label id="elh_charges_PropertyUse" for="x_PropertyUse" class="<?php echo $charges_edit->LeftColumnClass ?>"><?php echo $charges_edit->PropertyUse->caption() ?><?php echo $charges_edit->PropertyUse->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $charges_edit->RightColumnClass ?>"><div <?php echo $charges_edit->PropertyUse->cellAttributes() ?>>
<span id="el_charges_PropertyUse">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="charges" data-field="x_PropertyUse" data-value-separator="<?php echo $charges_edit->PropertyUse->displayValueSeparatorAttribute() ?>" id="x_PropertyUse" name="x_PropertyUse"<?php echo $charges_edit->PropertyUse->editAttributes() ?>>
			<?php echo $charges_edit->PropertyUse->selectOptionListHtml("x_PropertyUse") ?>
		</select>
</div>
<?php echo $charges_edit->PropertyUse->Lookup->getParamTag($charges_edit, "p_x_PropertyUse") ?>
</span>
<?php echo $charges_edit->PropertyUse->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$charges_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $charges_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $charges_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$charges_edit->IsModal) { ?>
<?php echo $charges_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$charges_edit->showPageFooter();
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
$charges_edit->terminate();
?>