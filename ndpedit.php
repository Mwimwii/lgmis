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
$ndp_edit = new ndp_edit();

// Run the page
$ndp_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ndp_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fndpedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fndpedit = currentForm = new ew.Form("fndpedit", "edit");

	// Validate form
	fndpedit.validate = function() {
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
			<?php if ($ndp_edit->NDP->Required) { ?>
				elm = this.getElements("x" + infix + "_NDP");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ndp_edit->NDP->caption(), $ndp_edit->NDP->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_NDP");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ndp_edit->NDP->errorMessage()) ?>");
			<?php if ($ndp_edit->NDPShortName->Required) { ?>
				elm = this.getElements("x" + infix + "_NDPShortName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ndp_edit->NDPShortName->caption(), $ndp_edit->NDPShortName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ndp_edit->FromYear->Required) { ?>
				elm = this.getElements("x" + infix + "_FromYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ndp_edit->FromYear->caption(), $ndp_edit->FromYear->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_FromYear");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ndp_edit->FromYear->errorMessage()) ?>");
			<?php if ($ndp_edit->ToYear->Required) { ?>
				elm = this.getElements("x" + infix + "_ToYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ndp_edit->ToYear->caption(), $ndp_edit->ToYear->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ToYear");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ndp_edit->ToYear->errorMessage()) ?>");
			<?php if ($ndp_edit->NDPDeascription->Required) { ?>
				elm = this.getElements("x" + infix + "_NDPDeascription");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ndp_edit->NDPDeascription->caption(), $ndp_edit->NDPDeascription->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ndp_edit->NDPObjectives->Required) { ?>
				elm = this.getElements("x" + infix + "_NDPObjectives");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ndp_edit->NDPObjectives->caption(), $ndp_edit->NDPObjectives->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ndp_edit->EffectiveDate->Required) { ?>
				elm = this.getElements("x" + infix + "_EffectiveDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ndp_edit->EffectiveDate->caption(), $ndp_edit->EffectiveDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EffectiveDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ndp_edit->EffectiveDate->errorMessage()) ?>");
			<?php if ($ndp_edit->NDPURL->Required) { ?>
				elm = this.getElements("x" + infix + "_NDPURL");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ndp_edit->NDPURL->caption(), $ndp_edit->NDPURL->RequiredErrorMessage)) ?>");
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
	fndpedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fndpedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fndpedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $ndp_edit->showPageHeader(); ?>
<?php
$ndp_edit->showMessage();
?>
<?php if (!$ndp_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ndp_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fndpedit" id="fndpedit" class="<?php echo $ndp_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ndp">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$ndp_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($ndp_edit->NDP->Visible) { // NDP ?>
	<div id="r_NDP" class="form-group row">
		<label id="elh_ndp_NDP" for="x_NDP" class="<?php echo $ndp_edit->LeftColumnClass ?>"><?php echo $ndp_edit->NDP->caption() ?><?php echo $ndp_edit->NDP->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ndp_edit->RightColumnClass ?>"><div <?php echo $ndp_edit->NDP->cellAttributes() ?>>
<input type="text" data-table="ndp" data-field="x_NDP" name="x_NDP" id="x_NDP" size="30" placeholder="<?php echo HtmlEncode($ndp_edit->NDP->getPlaceHolder()) ?>" value="<?php echo $ndp_edit->NDP->EditValue ?>"<?php echo $ndp_edit->NDP->editAttributes() ?>>
<input type="hidden" data-table="ndp" data-field="x_NDP" name="o_NDP" id="o_NDP" value="<?php echo HtmlEncode($ndp_edit->NDP->OldValue != null ? $ndp_edit->NDP->OldValue : $ndp_edit->NDP->CurrentValue) ?>">
<?php echo $ndp_edit->NDP->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ndp_edit->NDPShortName->Visible) { // NDPShortName ?>
	<div id="r_NDPShortName" class="form-group row">
		<label id="elh_ndp_NDPShortName" for="x_NDPShortName" class="<?php echo $ndp_edit->LeftColumnClass ?>"><?php echo $ndp_edit->NDPShortName->caption() ?><?php echo $ndp_edit->NDPShortName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ndp_edit->RightColumnClass ?>"><div <?php echo $ndp_edit->NDPShortName->cellAttributes() ?>>
<span id="el_ndp_NDPShortName">
<input type="text" data-table="ndp" data-field="x_NDPShortName" name="x_NDPShortName" id="x_NDPShortName" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($ndp_edit->NDPShortName->getPlaceHolder()) ?>" value="<?php echo $ndp_edit->NDPShortName->EditValue ?>"<?php echo $ndp_edit->NDPShortName->editAttributes() ?>>
</span>
<?php echo $ndp_edit->NDPShortName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ndp_edit->FromYear->Visible) { // FromYear ?>
	<div id="r_FromYear" class="form-group row">
		<label id="elh_ndp_FromYear" for="x_FromYear" class="<?php echo $ndp_edit->LeftColumnClass ?>"><?php echo $ndp_edit->FromYear->caption() ?><?php echo $ndp_edit->FromYear->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ndp_edit->RightColumnClass ?>"><div <?php echo $ndp_edit->FromYear->cellAttributes() ?>>
<span id="el_ndp_FromYear">
<input type="text" data-table="ndp" data-field="x_FromYear" name="x_FromYear" id="x_FromYear" size="30" placeholder="<?php echo HtmlEncode($ndp_edit->FromYear->getPlaceHolder()) ?>" value="<?php echo $ndp_edit->FromYear->EditValue ?>"<?php echo $ndp_edit->FromYear->editAttributes() ?>>
</span>
<?php echo $ndp_edit->FromYear->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ndp_edit->ToYear->Visible) { // ToYear ?>
	<div id="r_ToYear" class="form-group row">
		<label id="elh_ndp_ToYear" for="x_ToYear" class="<?php echo $ndp_edit->LeftColumnClass ?>"><?php echo $ndp_edit->ToYear->caption() ?><?php echo $ndp_edit->ToYear->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ndp_edit->RightColumnClass ?>"><div <?php echo $ndp_edit->ToYear->cellAttributes() ?>>
<span id="el_ndp_ToYear">
<input type="text" data-table="ndp" data-field="x_ToYear" name="x_ToYear" id="x_ToYear" size="30" placeholder="<?php echo HtmlEncode($ndp_edit->ToYear->getPlaceHolder()) ?>" value="<?php echo $ndp_edit->ToYear->EditValue ?>"<?php echo $ndp_edit->ToYear->editAttributes() ?>>
</span>
<?php echo $ndp_edit->ToYear->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ndp_edit->NDPDeascription->Visible) { // NDPDeascription ?>
	<div id="r_NDPDeascription" class="form-group row">
		<label id="elh_ndp_NDPDeascription" for="x_NDPDeascription" class="<?php echo $ndp_edit->LeftColumnClass ?>"><?php echo $ndp_edit->NDPDeascription->caption() ?><?php echo $ndp_edit->NDPDeascription->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ndp_edit->RightColumnClass ?>"><div <?php echo $ndp_edit->NDPDeascription->cellAttributes() ?>>
<span id="el_ndp_NDPDeascription">
<textarea data-table="ndp" data-field="x_NDPDeascription" name="x_NDPDeascription" id="x_NDPDeascription" cols="35" rows="4" placeholder="<?php echo HtmlEncode($ndp_edit->NDPDeascription->getPlaceHolder()) ?>"<?php echo $ndp_edit->NDPDeascription->editAttributes() ?>><?php echo $ndp_edit->NDPDeascription->EditValue ?></textarea>
</span>
<?php echo $ndp_edit->NDPDeascription->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ndp_edit->NDPObjectives->Visible) { // NDPObjectives ?>
	<div id="r_NDPObjectives" class="form-group row">
		<label id="elh_ndp_NDPObjectives" for="x_NDPObjectives" class="<?php echo $ndp_edit->LeftColumnClass ?>"><?php echo $ndp_edit->NDPObjectives->caption() ?><?php echo $ndp_edit->NDPObjectives->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ndp_edit->RightColumnClass ?>"><div <?php echo $ndp_edit->NDPObjectives->cellAttributes() ?>>
<span id="el_ndp_NDPObjectives">
<textarea data-table="ndp" data-field="x_NDPObjectives" name="x_NDPObjectives" id="x_NDPObjectives" cols="35" rows="4" placeholder="<?php echo HtmlEncode($ndp_edit->NDPObjectives->getPlaceHolder()) ?>"<?php echo $ndp_edit->NDPObjectives->editAttributes() ?>><?php echo $ndp_edit->NDPObjectives->EditValue ?></textarea>
</span>
<?php echo $ndp_edit->NDPObjectives->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ndp_edit->EffectiveDate->Visible) { // EffectiveDate ?>
	<div id="r_EffectiveDate" class="form-group row">
		<label id="elh_ndp_EffectiveDate" for="x_EffectiveDate" class="<?php echo $ndp_edit->LeftColumnClass ?>"><?php echo $ndp_edit->EffectiveDate->caption() ?><?php echo $ndp_edit->EffectiveDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ndp_edit->RightColumnClass ?>"><div <?php echo $ndp_edit->EffectiveDate->cellAttributes() ?>>
<span id="el_ndp_EffectiveDate">
<input type="text" data-table="ndp" data-field="x_EffectiveDate" name="x_EffectiveDate" id="x_EffectiveDate" placeholder="<?php echo HtmlEncode($ndp_edit->EffectiveDate->getPlaceHolder()) ?>" value="<?php echo $ndp_edit->EffectiveDate->EditValue ?>"<?php echo $ndp_edit->EffectiveDate->editAttributes() ?>>
<?php if (!$ndp_edit->EffectiveDate->ReadOnly && !$ndp_edit->EffectiveDate->Disabled && !isset($ndp_edit->EffectiveDate->EditAttrs["readonly"]) && !isset($ndp_edit->EffectiveDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fndpedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fndpedit", "x_EffectiveDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $ndp_edit->EffectiveDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ndp_edit->NDPURL->Visible) { // NDPURL ?>
	<div id="r_NDPURL" class="form-group row">
		<label id="elh_ndp_NDPURL" for="x_NDPURL" class="<?php echo $ndp_edit->LeftColumnClass ?>"><?php echo $ndp_edit->NDPURL->caption() ?><?php echo $ndp_edit->NDPURL->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ndp_edit->RightColumnClass ?>"><div <?php echo $ndp_edit->NDPURL->cellAttributes() ?>>
<span id="el_ndp_NDPURL">
<input type="text" data-table="ndp" data-field="x_NDPURL" name="x_NDPURL" id="x_NDPURL" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($ndp_edit->NDPURL->getPlaceHolder()) ?>" value="<?php echo $ndp_edit->NDPURL->EditValue ?>"<?php echo $ndp_edit->NDPURL->editAttributes() ?>>
</span>
<?php echo $ndp_edit->NDPURL->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("pillars", explode(",", $ndp->getCurrentDetailTable())) && $pillars->DetailEdit) {
?>
<?php if ($ndp->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("pillars", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "pillarsgrid.php" ?>
<?php } ?>
<?php if (!$ndp_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $ndp_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $ndp_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$ndp_edit->IsModal) { ?>
<?php echo $ndp_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$ndp_edit->showPageFooter();
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
$ndp_edit->terminate();
?>