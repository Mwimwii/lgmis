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
$ndp_add = new ndp_add();

// Run the page
$ndp_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ndp_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fndpadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fndpadd = currentForm = new ew.Form("fndpadd", "add");

	// Validate form
	fndpadd.validate = function() {
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
			<?php if ($ndp_add->NDP->Required) { ?>
				elm = this.getElements("x" + infix + "_NDP");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ndp_add->NDP->caption(), $ndp_add->NDP->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_NDP");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ndp_add->NDP->errorMessage()) ?>");
			<?php if ($ndp_add->NDPShortName->Required) { ?>
				elm = this.getElements("x" + infix + "_NDPShortName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ndp_add->NDPShortName->caption(), $ndp_add->NDPShortName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ndp_add->FromYear->Required) { ?>
				elm = this.getElements("x" + infix + "_FromYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ndp_add->FromYear->caption(), $ndp_add->FromYear->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_FromYear");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ndp_add->FromYear->errorMessage()) ?>");
			<?php if ($ndp_add->ToYear->Required) { ?>
				elm = this.getElements("x" + infix + "_ToYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ndp_add->ToYear->caption(), $ndp_add->ToYear->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ToYear");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ndp_add->ToYear->errorMessage()) ?>");
			<?php if ($ndp_add->NDPDeascription->Required) { ?>
				elm = this.getElements("x" + infix + "_NDPDeascription");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ndp_add->NDPDeascription->caption(), $ndp_add->NDPDeascription->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ndp_add->NDPObjectives->Required) { ?>
				elm = this.getElements("x" + infix + "_NDPObjectives");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ndp_add->NDPObjectives->caption(), $ndp_add->NDPObjectives->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ndp_add->EffectiveDate->Required) { ?>
				elm = this.getElements("x" + infix + "_EffectiveDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ndp_add->EffectiveDate->caption(), $ndp_add->EffectiveDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EffectiveDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ndp_add->EffectiveDate->errorMessage()) ?>");
			<?php if ($ndp_add->NDPURL->Required) { ?>
				elm = this.getElements("x" + infix + "_NDPURL");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ndp_add->NDPURL->caption(), $ndp_add->NDPURL->RequiredErrorMessage)) ?>");
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
	fndpadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fndpadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fndpadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $ndp_add->showPageHeader(); ?>
<?php
$ndp_add->showMessage();
?>
<form name="fndpadd" id="fndpadd" class="<?php echo $ndp_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ndp">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$ndp_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($ndp_add->NDP->Visible) { // NDP ?>
	<div id="r_NDP" class="form-group row">
		<label id="elh_ndp_NDP" for="x_NDP" class="<?php echo $ndp_add->LeftColumnClass ?>"><?php echo $ndp_add->NDP->caption() ?><?php echo $ndp_add->NDP->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ndp_add->RightColumnClass ?>"><div <?php echo $ndp_add->NDP->cellAttributes() ?>>
<span id="el_ndp_NDP">
<input type="text" data-table="ndp" data-field="x_NDP" name="x_NDP" id="x_NDP" size="30" placeholder="<?php echo HtmlEncode($ndp_add->NDP->getPlaceHolder()) ?>" value="<?php echo $ndp_add->NDP->EditValue ?>"<?php echo $ndp_add->NDP->editAttributes() ?>>
</span>
<?php echo $ndp_add->NDP->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ndp_add->NDPShortName->Visible) { // NDPShortName ?>
	<div id="r_NDPShortName" class="form-group row">
		<label id="elh_ndp_NDPShortName" for="x_NDPShortName" class="<?php echo $ndp_add->LeftColumnClass ?>"><?php echo $ndp_add->NDPShortName->caption() ?><?php echo $ndp_add->NDPShortName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ndp_add->RightColumnClass ?>"><div <?php echo $ndp_add->NDPShortName->cellAttributes() ?>>
<span id="el_ndp_NDPShortName">
<input type="text" data-table="ndp" data-field="x_NDPShortName" name="x_NDPShortName" id="x_NDPShortName" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($ndp_add->NDPShortName->getPlaceHolder()) ?>" value="<?php echo $ndp_add->NDPShortName->EditValue ?>"<?php echo $ndp_add->NDPShortName->editAttributes() ?>>
</span>
<?php echo $ndp_add->NDPShortName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ndp_add->FromYear->Visible) { // FromYear ?>
	<div id="r_FromYear" class="form-group row">
		<label id="elh_ndp_FromYear" for="x_FromYear" class="<?php echo $ndp_add->LeftColumnClass ?>"><?php echo $ndp_add->FromYear->caption() ?><?php echo $ndp_add->FromYear->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ndp_add->RightColumnClass ?>"><div <?php echo $ndp_add->FromYear->cellAttributes() ?>>
<span id="el_ndp_FromYear">
<input type="text" data-table="ndp" data-field="x_FromYear" name="x_FromYear" id="x_FromYear" size="30" placeholder="<?php echo HtmlEncode($ndp_add->FromYear->getPlaceHolder()) ?>" value="<?php echo $ndp_add->FromYear->EditValue ?>"<?php echo $ndp_add->FromYear->editAttributes() ?>>
</span>
<?php echo $ndp_add->FromYear->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ndp_add->ToYear->Visible) { // ToYear ?>
	<div id="r_ToYear" class="form-group row">
		<label id="elh_ndp_ToYear" for="x_ToYear" class="<?php echo $ndp_add->LeftColumnClass ?>"><?php echo $ndp_add->ToYear->caption() ?><?php echo $ndp_add->ToYear->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ndp_add->RightColumnClass ?>"><div <?php echo $ndp_add->ToYear->cellAttributes() ?>>
<span id="el_ndp_ToYear">
<input type="text" data-table="ndp" data-field="x_ToYear" name="x_ToYear" id="x_ToYear" size="30" placeholder="<?php echo HtmlEncode($ndp_add->ToYear->getPlaceHolder()) ?>" value="<?php echo $ndp_add->ToYear->EditValue ?>"<?php echo $ndp_add->ToYear->editAttributes() ?>>
</span>
<?php echo $ndp_add->ToYear->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ndp_add->NDPDeascription->Visible) { // NDPDeascription ?>
	<div id="r_NDPDeascription" class="form-group row">
		<label id="elh_ndp_NDPDeascription" for="x_NDPDeascription" class="<?php echo $ndp_add->LeftColumnClass ?>"><?php echo $ndp_add->NDPDeascription->caption() ?><?php echo $ndp_add->NDPDeascription->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ndp_add->RightColumnClass ?>"><div <?php echo $ndp_add->NDPDeascription->cellAttributes() ?>>
<span id="el_ndp_NDPDeascription">
<textarea data-table="ndp" data-field="x_NDPDeascription" name="x_NDPDeascription" id="x_NDPDeascription" cols="35" rows="4" placeholder="<?php echo HtmlEncode($ndp_add->NDPDeascription->getPlaceHolder()) ?>"<?php echo $ndp_add->NDPDeascription->editAttributes() ?>><?php echo $ndp_add->NDPDeascription->EditValue ?></textarea>
</span>
<?php echo $ndp_add->NDPDeascription->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ndp_add->NDPObjectives->Visible) { // NDPObjectives ?>
	<div id="r_NDPObjectives" class="form-group row">
		<label id="elh_ndp_NDPObjectives" for="x_NDPObjectives" class="<?php echo $ndp_add->LeftColumnClass ?>"><?php echo $ndp_add->NDPObjectives->caption() ?><?php echo $ndp_add->NDPObjectives->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ndp_add->RightColumnClass ?>"><div <?php echo $ndp_add->NDPObjectives->cellAttributes() ?>>
<span id="el_ndp_NDPObjectives">
<textarea data-table="ndp" data-field="x_NDPObjectives" name="x_NDPObjectives" id="x_NDPObjectives" cols="35" rows="4" placeholder="<?php echo HtmlEncode($ndp_add->NDPObjectives->getPlaceHolder()) ?>"<?php echo $ndp_add->NDPObjectives->editAttributes() ?>><?php echo $ndp_add->NDPObjectives->EditValue ?></textarea>
</span>
<?php echo $ndp_add->NDPObjectives->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ndp_add->EffectiveDate->Visible) { // EffectiveDate ?>
	<div id="r_EffectiveDate" class="form-group row">
		<label id="elh_ndp_EffectiveDate" for="x_EffectiveDate" class="<?php echo $ndp_add->LeftColumnClass ?>"><?php echo $ndp_add->EffectiveDate->caption() ?><?php echo $ndp_add->EffectiveDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ndp_add->RightColumnClass ?>"><div <?php echo $ndp_add->EffectiveDate->cellAttributes() ?>>
<span id="el_ndp_EffectiveDate">
<input type="text" data-table="ndp" data-field="x_EffectiveDate" name="x_EffectiveDate" id="x_EffectiveDate" placeholder="<?php echo HtmlEncode($ndp_add->EffectiveDate->getPlaceHolder()) ?>" value="<?php echo $ndp_add->EffectiveDate->EditValue ?>"<?php echo $ndp_add->EffectiveDate->editAttributes() ?>>
<?php if (!$ndp_add->EffectiveDate->ReadOnly && !$ndp_add->EffectiveDate->Disabled && !isset($ndp_add->EffectiveDate->EditAttrs["readonly"]) && !isset($ndp_add->EffectiveDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fndpadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fndpadd", "x_EffectiveDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $ndp_add->EffectiveDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ndp_add->NDPURL->Visible) { // NDPURL ?>
	<div id="r_NDPURL" class="form-group row">
		<label id="elh_ndp_NDPURL" for="x_NDPURL" class="<?php echo $ndp_add->LeftColumnClass ?>"><?php echo $ndp_add->NDPURL->caption() ?><?php echo $ndp_add->NDPURL->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ndp_add->RightColumnClass ?>"><div <?php echo $ndp_add->NDPURL->cellAttributes() ?>>
<span id="el_ndp_NDPURL">
<input type="text" data-table="ndp" data-field="x_NDPURL" name="x_NDPURL" id="x_NDPURL" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($ndp_add->NDPURL->getPlaceHolder()) ?>" value="<?php echo $ndp_add->NDPURL->EditValue ?>"<?php echo $ndp_add->NDPURL->editAttributes() ?>>
</span>
<?php echo $ndp_add->NDPURL->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("pillars", explode(",", $ndp->getCurrentDetailTable())) && $pillars->DetailAdd) {
?>
<?php if ($ndp->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("pillars", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "pillarsgrid.php" ?>
<?php } ?>
<?php if (!$ndp_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $ndp_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $ndp_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$ndp_add->showPageFooter();
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
$ndp_add->terminate();
?>