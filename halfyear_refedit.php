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
$halfyear_ref_edit = new halfyear_ref_edit();

// Run the page
$halfyear_ref_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$halfyear_ref_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fhalfyear_refedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fhalfyear_refedit = currentForm = new ew.Form("fhalfyear_refedit", "edit");

	// Validate form
	fhalfyear_refedit.validate = function() {
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
			<?php if ($halfyear_ref_edit->HalfYear->Required) { ?>
				elm = this.getElements("x" + infix + "_HalfYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $halfyear_ref_edit->HalfYear->caption(), $halfyear_ref_edit->HalfYear->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($halfyear_ref_edit->BillYear->Required) { ?>
				elm = this.getElements("x" + infix + "_BillYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $halfyear_ref_edit->BillYear->caption(), $halfyear_ref_edit->BillYear->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($halfyear_ref_edit->PropertyGroup->Required) { ?>
				elm = this.getElements("x" + infix + "_PropertyGroup");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $halfyear_ref_edit->PropertyGroup->caption(), $halfyear_ref_edit->PropertyGroup->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($halfyear_ref_edit->StartDate->Required) { ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $halfyear_ref_edit->StartDate->caption(), $halfyear_ref_edit->StartDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($halfyear_ref_edit->StartDate->errorMessage()) ?>");
			<?php if ($halfyear_ref_edit->Enddate->Required) { ?>
				elm = this.getElements("x" + infix + "_Enddate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $halfyear_ref_edit->Enddate->caption(), $halfyear_ref_edit->Enddate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Enddate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($halfyear_ref_edit->Enddate->errorMessage()) ?>");
			<?php if ($halfyear_ref_edit->ID->Required) { ?>
				elm = this.getElements("x" + infix + "_ID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $halfyear_ref_edit->ID->caption(), $halfyear_ref_edit->ID->RequiredErrorMessage)) ?>");
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
	fhalfyear_refedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fhalfyear_refedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fhalfyear_refedit.lists["x_HalfYear"] = <?php echo $halfyear_ref_edit->HalfYear->Lookup->toClientList($halfyear_ref_edit) ?>;
	fhalfyear_refedit.lists["x_HalfYear"].options = <?php echo JsonEncode($halfyear_ref_edit->HalfYear->options(FALSE, TRUE)) ?>;
	fhalfyear_refedit.lists["x_BillYear"] = <?php echo $halfyear_ref_edit->BillYear->Lookup->toClientList($halfyear_ref_edit) ?>;
	fhalfyear_refedit.lists["x_BillYear"].options = <?php echo JsonEncode($halfyear_ref_edit->BillYear->lookupOptions()) ?>;
	fhalfyear_refedit.lists["x_PropertyGroup"] = <?php echo $halfyear_ref_edit->PropertyGroup->Lookup->toClientList($halfyear_ref_edit) ?>;
	fhalfyear_refedit.lists["x_PropertyGroup"].options = <?php echo JsonEncode($halfyear_ref_edit->PropertyGroup->lookupOptions()) ?>;
	loadjs.done("fhalfyear_refedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $halfyear_ref_edit->showPageHeader(); ?>
<?php
$halfyear_ref_edit->showMessage();
?>
<?php if (!$halfyear_ref_edit->IsModal) { ?>
<?php if (!$halfyear_ref->isConfirm()) { // Confirm page ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $halfyear_ref_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fhalfyear_refedit" id="fhalfyear_refedit" class="<?php echo $halfyear_ref_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="halfyear_ref">
<?php if ($halfyear_ref->isConfirm()) { // Confirm page ?>
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="confirm" id="confirm" value="confirm">
<?php } else { ?>
<input type="hidden" name="action" id="action" value="confirm">
<?php } ?>
<input type="hidden" name="modal" value="<?php echo (int)$halfyear_ref_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($halfyear_ref_edit->HalfYear->Visible) { // HalfYear ?>
	<div id="r_HalfYear" class="form-group row">
		<label id="elh_halfyear_ref_HalfYear" for="x_HalfYear" class="<?php echo $halfyear_ref_edit->LeftColumnClass ?>"><?php echo $halfyear_ref_edit->HalfYear->caption() ?><?php echo $halfyear_ref_edit->HalfYear->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $halfyear_ref_edit->RightColumnClass ?>"><div <?php echo $halfyear_ref_edit->HalfYear->cellAttributes() ?>>
<?php if (!$halfyear_ref->isConfirm()) { ?>
<span id="el_halfyear_ref_HalfYear">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="halfyear_ref" data-field="x_HalfYear" data-value-separator="<?php echo $halfyear_ref_edit->HalfYear->displayValueSeparatorAttribute() ?>" id="x_HalfYear" name="x_HalfYear"<?php echo $halfyear_ref_edit->HalfYear->editAttributes() ?>>
			<?php echo $halfyear_ref_edit->HalfYear->selectOptionListHtml("x_HalfYear") ?>
		</select>
</div>
</span>
<?php } else { ?>
<span id="el_halfyear_ref_HalfYear">
<span<?php echo $halfyear_ref_edit->HalfYear->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($halfyear_ref_edit->HalfYear->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="halfyear_ref" data-field="x_HalfYear" name="x_HalfYear" id="x_HalfYear" value="<?php echo HtmlEncode($halfyear_ref_edit->HalfYear->FormValue) ?>">
<?php } ?>
<?php echo $halfyear_ref_edit->HalfYear->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($halfyear_ref_edit->BillYear->Visible) { // BillYear ?>
	<div id="r_BillYear" class="form-group row">
		<label id="elh_halfyear_ref_BillYear" for="x_BillYear" class="<?php echo $halfyear_ref_edit->LeftColumnClass ?>"><?php echo $halfyear_ref_edit->BillYear->caption() ?><?php echo $halfyear_ref_edit->BillYear->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $halfyear_ref_edit->RightColumnClass ?>"><div <?php echo $halfyear_ref_edit->BillYear->cellAttributes() ?>>
<?php if (!$halfyear_ref->isConfirm()) { ?>
<span id="el_halfyear_ref_BillYear">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="halfyear_ref" data-field="x_BillYear" data-value-separator="<?php echo $halfyear_ref_edit->BillYear->displayValueSeparatorAttribute() ?>" id="x_BillYear" name="x_BillYear"<?php echo $halfyear_ref_edit->BillYear->editAttributes() ?>>
			<?php echo $halfyear_ref_edit->BillYear->selectOptionListHtml("x_BillYear") ?>
		</select>
</div>
<?php echo $halfyear_ref_edit->BillYear->Lookup->getParamTag($halfyear_ref_edit, "p_x_BillYear") ?>
</span>
<?php } else { ?>
<span id="el_halfyear_ref_BillYear">
<span<?php echo $halfyear_ref_edit->BillYear->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($halfyear_ref_edit->BillYear->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="halfyear_ref" data-field="x_BillYear" name="x_BillYear" id="x_BillYear" value="<?php echo HtmlEncode($halfyear_ref_edit->BillYear->FormValue) ?>">
<?php } ?>
<?php echo $halfyear_ref_edit->BillYear->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($halfyear_ref_edit->PropertyGroup->Visible) { // PropertyGroup ?>
	<div id="r_PropertyGroup" class="form-group row">
		<label id="elh_halfyear_ref_PropertyGroup" for="x_PropertyGroup" class="<?php echo $halfyear_ref_edit->LeftColumnClass ?>"><?php echo $halfyear_ref_edit->PropertyGroup->caption() ?><?php echo $halfyear_ref_edit->PropertyGroup->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $halfyear_ref_edit->RightColumnClass ?>"><div <?php echo $halfyear_ref_edit->PropertyGroup->cellAttributes() ?>>
<?php if (!$halfyear_ref->isConfirm()) { ?>
<span id="el_halfyear_ref_PropertyGroup">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_PropertyGroup"><?php echo EmptyValue(strval($halfyear_ref_edit->PropertyGroup->ViewValue)) ? $Language->phrase("PleaseSelect") : $halfyear_ref_edit->PropertyGroup->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($halfyear_ref_edit->PropertyGroup->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($halfyear_ref_edit->PropertyGroup->ReadOnly || $halfyear_ref_edit->PropertyGroup->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_PropertyGroup',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $halfyear_ref_edit->PropertyGroup->Lookup->getParamTag($halfyear_ref_edit, "p_x_PropertyGroup") ?>
<input type="hidden" data-table="halfyear_ref" data-field="x_PropertyGroup" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $halfyear_ref_edit->PropertyGroup->displayValueSeparatorAttribute() ?>" name="x_PropertyGroup" id="x_PropertyGroup" value="<?php echo $halfyear_ref_edit->PropertyGroup->CurrentValue ?>"<?php echo $halfyear_ref_edit->PropertyGroup->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_halfyear_ref_PropertyGroup">
<span<?php echo $halfyear_ref_edit->PropertyGroup->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($halfyear_ref_edit->PropertyGroup->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="halfyear_ref" data-field="x_PropertyGroup" name="x_PropertyGroup" id="x_PropertyGroup" value="<?php echo HtmlEncode($halfyear_ref_edit->PropertyGroup->FormValue) ?>">
<?php } ?>
<?php echo $halfyear_ref_edit->PropertyGroup->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($halfyear_ref_edit->StartDate->Visible) { // StartDate ?>
	<div id="r_StartDate" class="form-group row">
		<label id="elh_halfyear_ref_StartDate" for="x_StartDate" class="<?php echo $halfyear_ref_edit->LeftColumnClass ?>"><?php echo $halfyear_ref_edit->StartDate->caption() ?><?php echo $halfyear_ref_edit->StartDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $halfyear_ref_edit->RightColumnClass ?>"><div <?php echo $halfyear_ref_edit->StartDate->cellAttributes() ?>>
<?php if (!$halfyear_ref->isConfirm()) { ?>
<span id="el_halfyear_ref_StartDate">
<input type="text" data-table="halfyear_ref" data-field="x_StartDate" name="x_StartDate" id="x_StartDate" placeholder="<?php echo HtmlEncode($halfyear_ref_edit->StartDate->getPlaceHolder()) ?>" value="<?php echo $halfyear_ref_edit->StartDate->EditValue ?>"<?php echo $halfyear_ref_edit->StartDate->editAttributes() ?>>
<?php if (!$halfyear_ref_edit->StartDate->ReadOnly && !$halfyear_ref_edit->StartDate->Disabled && !isset($halfyear_ref_edit->StartDate->EditAttrs["readonly"]) && !isset($halfyear_ref_edit->StartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fhalfyear_refedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fhalfyear_refedit", "x_StartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el_halfyear_ref_StartDate">
<span<?php echo $halfyear_ref_edit->StartDate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($halfyear_ref_edit->StartDate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="halfyear_ref" data-field="x_StartDate" name="x_StartDate" id="x_StartDate" value="<?php echo HtmlEncode($halfyear_ref_edit->StartDate->FormValue) ?>">
<?php } ?>
<?php echo $halfyear_ref_edit->StartDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($halfyear_ref_edit->Enddate->Visible) { // Enddate ?>
	<div id="r_Enddate" class="form-group row">
		<label id="elh_halfyear_ref_Enddate" for="x_Enddate" class="<?php echo $halfyear_ref_edit->LeftColumnClass ?>"><?php echo $halfyear_ref_edit->Enddate->caption() ?><?php echo $halfyear_ref_edit->Enddate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $halfyear_ref_edit->RightColumnClass ?>"><div <?php echo $halfyear_ref_edit->Enddate->cellAttributes() ?>>
<?php if (!$halfyear_ref->isConfirm()) { ?>
<span id="el_halfyear_ref_Enddate">
<input type="text" data-table="halfyear_ref" data-field="x_Enddate" name="x_Enddate" id="x_Enddate" placeholder="<?php echo HtmlEncode($halfyear_ref_edit->Enddate->getPlaceHolder()) ?>" value="<?php echo $halfyear_ref_edit->Enddate->EditValue ?>"<?php echo $halfyear_ref_edit->Enddate->editAttributes() ?>>
<?php if (!$halfyear_ref_edit->Enddate->ReadOnly && !$halfyear_ref_edit->Enddate->Disabled && !isset($halfyear_ref_edit->Enddate->EditAttrs["readonly"]) && !isset($halfyear_ref_edit->Enddate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fhalfyear_refedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fhalfyear_refedit", "x_Enddate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el_halfyear_ref_Enddate">
<span<?php echo $halfyear_ref_edit->Enddate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($halfyear_ref_edit->Enddate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="halfyear_ref" data-field="x_Enddate" name="x_Enddate" id="x_Enddate" value="<?php echo HtmlEncode($halfyear_ref_edit->Enddate->FormValue) ?>">
<?php } ?>
<?php echo $halfyear_ref_edit->Enddate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($halfyear_ref_edit->ID->Visible) { // ID ?>
	<div id="r_ID" class="form-group row">
		<label id="elh_halfyear_ref_ID" class="<?php echo $halfyear_ref_edit->LeftColumnClass ?>"><?php echo $halfyear_ref_edit->ID->caption() ?><?php echo $halfyear_ref_edit->ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $halfyear_ref_edit->RightColumnClass ?>"><div <?php echo $halfyear_ref_edit->ID->cellAttributes() ?>>
<?php if (!$halfyear_ref->isConfirm()) { ?>
<span id="el_halfyear_ref_ID">
<span<?php echo $halfyear_ref_edit->ID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($halfyear_ref_edit->ID->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="halfyear_ref" data-field="x_ID" name="x_ID" id="x_ID" value="<?php echo HtmlEncode($halfyear_ref_edit->ID->CurrentValue) ?>">
<?php } else { ?>
<span id="el_halfyear_ref_ID">
<span<?php echo $halfyear_ref_edit->ID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($halfyear_ref_edit->ID->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="halfyear_ref" data-field="x_ID" name="x_ID" id="x_ID" value="<?php echo HtmlEncode($halfyear_ref_edit->ID->FormValue) ?>">
<?php } ?>
<?php echo $halfyear_ref_edit->ID->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$halfyear_ref_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $halfyear_ref_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<?php if (!$halfyear_ref->isConfirm()) { // Confirm page ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='confirm';"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $halfyear_ref_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("ConfirmBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="submit" onclick="this.form.action.value='cancel';"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } ?>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$halfyear_ref_edit->IsModal) { ?>
<?php if (!$halfyear_ref->isConfirm()) { // Confirm page ?>
<?php echo $halfyear_ref_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$halfyear_ref_edit->showPageFooter();
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
$halfyear_ref_edit->terminate();
?>