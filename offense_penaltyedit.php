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
$offense_penalty_edit = new offense_penalty_edit();

// Run the page
$offense_penalty_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$offense_penalty_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var foffense_penaltyedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	foffense_penaltyedit = currentForm = new ew.Form("foffense_penaltyedit", "edit");

	// Validate form
	foffense_penaltyedit.validate = function() {
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
			<?php if ($offense_penalty_edit->OffenseCode->Required) { ?>
				elm = this.getElements("x" + infix + "_OffenseCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $offense_penalty_edit->OffenseCode->caption(), $offense_penalty_edit->OffenseCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($offense_penalty_edit->OffenseCategory->Required) { ?>
				elm = this.getElements("x" + infix + "_OffenseCategory");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $offense_penalty_edit->OffenseCategory->caption(), $offense_penalty_edit->OffenseCategory->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($offense_penalty_edit->OffenseName->Required) { ?>
				elm = this.getElements("x" + infix + "_OffenseName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $offense_penalty_edit->OffenseName->caption(), $offense_penalty_edit->OffenseName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($offense_penalty_edit->Frequency->Required) { ?>
				elm = this.getElements("x" + infix + "_Frequency");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $offense_penalty_edit->Frequency->caption(), $offense_penalty_edit->Frequency->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Frequency");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($offense_penalty_edit->Frequency->errorMessage()) ?>");
			<?php if ($offense_penalty_edit->AppropriateAction->Required) { ?>
				elm = this.getElements("x" + infix + "_AppropriateAction");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $offense_penalty_edit->AppropriateAction->caption(), $offense_penalty_edit->AppropriateAction->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($offense_penalty_edit->Authority->Required) { ?>
				elm = this.getElements("x" + infix + "_Authority");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $offense_penalty_edit->Authority->caption(), $offense_penalty_edit->Authority->RequiredErrorMessage)) ?>");
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
	foffense_penaltyedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	foffense_penaltyedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	foffense_penaltyedit.lists["x_OffenseCategory"] = <?php echo $offense_penalty_edit->OffenseCategory->Lookup->toClientList($offense_penalty_edit) ?>;
	foffense_penaltyedit.lists["x_OffenseCategory"].options = <?php echo JsonEncode($offense_penalty_edit->OffenseCategory->lookupOptions()) ?>;
	foffense_penaltyedit.lists["x_AppropriateAction"] = <?php echo $offense_penalty_edit->AppropriateAction->Lookup->toClientList($offense_penalty_edit) ?>;
	foffense_penaltyedit.lists["x_AppropriateAction"].options = <?php echo JsonEncode($offense_penalty_edit->AppropriateAction->lookupOptions()) ?>;
	loadjs.done("foffense_penaltyedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $offense_penalty_edit->showPageHeader(); ?>
<?php
$offense_penalty_edit->showMessage();
?>
<?php if (!$offense_penalty_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $offense_penalty_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="foffense_penaltyedit" id="foffense_penaltyedit" class="<?php echo $offense_penalty_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="offense_penalty">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$offense_penalty_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($offense_penalty_edit->OffenseCode->Visible) { // OffenseCode ?>
	<div id="r_OffenseCode" class="form-group row">
		<label id="elh_offense_penalty_OffenseCode" class="<?php echo $offense_penalty_edit->LeftColumnClass ?>"><?php echo $offense_penalty_edit->OffenseCode->caption() ?><?php echo $offense_penalty_edit->OffenseCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $offense_penalty_edit->RightColumnClass ?>"><div <?php echo $offense_penalty_edit->OffenseCode->cellAttributes() ?>>
<span id="el_offense_penalty_OffenseCode">
<span<?php echo $offense_penalty_edit->OffenseCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($offense_penalty_edit->OffenseCode->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="offense_penalty" data-field="x_OffenseCode" name="x_OffenseCode" id="x_OffenseCode" value="<?php echo HtmlEncode($offense_penalty_edit->OffenseCode->CurrentValue) ?>">
<?php echo $offense_penalty_edit->OffenseCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($offense_penalty_edit->OffenseCategory->Visible) { // OffenseCategory ?>
	<div id="r_OffenseCategory" class="form-group row">
		<label id="elh_offense_penalty_OffenseCategory" for="x_OffenseCategory" class="<?php echo $offense_penalty_edit->LeftColumnClass ?>"><?php echo $offense_penalty_edit->OffenseCategory->caption() ?><?php echo $offense_penalty_edit->OffenseCategory->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $offense_penalty_edit->RightColumnClass ?>"><div <?php echo $offense_penalty_edit->OffenseCategory->cellAttributes() ?>>
<span id="el_offense_penalty_OffenseCategory">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="offense_penalty" data-field="x_OffenseCategory" data-value-separator="<?php echo $offense_penalty_edit->OffenseCategory->displayValueSeparatorAttribute() ?>" id="x_OffenseCategory" name="x_OffenseCategory"<?php echo $offense_penalty_edit->OffenseCategory->editAttributes() ?>>
			<?php echo $offense_penalty_edit->OffenseCategory->selectOptionListHtml("x_OffenseCategory") ?>
		</select>
</div>
<?php echo $offense_penalty_edit->OffenseCategory->Lookup->getParamTag($offense_penalty_edit, "p_x_OffenseCategory") ?>
</span>
<?php echo $offense_penalty_edit->OffenseCategory->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($offense_penalty_edit->OffenseName->Visible) { // OffenseName ?>
	<div id="r_OffenseName" class="form-group row">
		<label id="elh_offense_penalty_OffenseName" for="x_OffenseName" class="<?php echo $offense_penalty_edit->LeftColumnClass ?>"><?php echo $offense_penalty_edit->OffenseName->caption() ?><?php echo $offense_penalty_edit->OffenseName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $offense_penalty_edit->RightColumnClass ?>"><div <?php echo $offense_penalty_edit->OffenseName->cellAttributes() ?>>
<span id="el_offense_penalty_OffenseName">
<input type="text" data-table="offense_penalty" data-field="x_OffenseName" name="x_OffenseName" id="x_OffenseName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($offense_penalty_edit->OffenseName->getPlaceHolder()) ?>" value="<?php echo $offense_penalty_edit->OffenseName->EditValue ?>"<?php echo $offense_penalty_edit->OffenseName->editAttributes() ?>>
</span>
<?php echo $offense_penalty_edit->OffenseName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($offense_penalty_edit->Frequency->Visible) { // Frequency ?>
	<div id="r_Frequency" class="form-group row">
		<label id="elh_offense_penalty_Frequency" for="x_Frequency" class="<?php echo $offense_penalty_edit->LeftColumnClass ?>"><?php echo $offense_penalty_edit->Frequency->caption() ?><?php echo $offense_penalty_edit->Frequency->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $offense_penalty_edit->RightColumnClass ?>"><div <?php echo $offense_penalty_edit->Frequency->cellAttributes() ?>>
<span id="el_offense_penalty_Frequency">
<input type="text" data-table="offense_penalty" data-field="x_Frequency" name="x_Frequency" id="x_Frequency" size="30" placeholder="<?php echo HtmlEncode($offense_penalty_edit->Frequency->getPlaceHolder()) ?>" value="<?php echo $offense_penalty_edit->Frequency->EditValue ?>"<?php echo $offense_penalty_edit->Frequency->editAttributes() ?>>
</span>
<?php echo $offense_penalty_edit->Frequency->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($offense_penalty_edit->AppropriateAction->Visible) { // AppropriateAction ?>
	<div id="r_AppropriateAction" class="form-group row">
		<label id="elh_offense_penalty_AppropriateAction" for="x_AppropriateAction" class="<?php echo $offense_penalty_edit->LeftColumnClass ?>"><?php echo $offense_penalty_edit->AppropriateAction->caption() ?><?php echo $offense_penalty_edit->AppropriateAction->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $offense_penalty_edit->RightColumnClass ?>"><div <?php echo $offense_penalty_edit->AppropriateAction->cellAttributes() ?>>
<span id="el_offense_penalty_AppropriateAction">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="offense_penalty" data-field="x_AppropriateAction" data-value-separator="<?php echo $offense_penalty_edit->AppropriateAction->displayValueSeparatorAttribute() ?>" id="x_AppropriateAction" name="x_AppropriateAction"<?php echo $offense_penalty_edit->AppropriateAction->editAttributes() ?>>
			<?php echo $offense_penalty_edit->AppropriateAction->selectOptionListHtml("x_AppropriateAction") ?>
		</select>
</div>
<?php echo $offense_penalty_edit->AppropriateAction->Lookup->getParamTag($offense_penalty_edit, "p_x_AppropriateAction") ?>
</span>
<?php echo $offense_penalty_edit->AppropriateAction->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($offense_penalty_edit->Authority->Visible) { // Authority ?>
	<div id="r_Authority" class="form-group row">
		<label id="elh_offense_penalty_Authority" for="x_Authority" class="<?php echo $offense_penalty_edit->LeftColumnClass ?>"><?php echo $offense_penalty_edit->Authority->caption() ?><?php echo $offense_penalty_edit->Authority->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $offense_penalty_edit->RightColumnClass ?>"><div <?php echo $offense_penalty_edit->Authority->cellAttributes() ?>>
<span id="el_offense_penalty_Authority">
<input type="text" data-table="offense_penalty" data-field="x_Authority" name="x_Authority" id="x_Authority" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($offense_penalty_edit->Authority->getPlaceHolder()) ?>" value="<?php echo $offense_penalty_edit->Authority->EditValue ?>"<?php echo $offense_penalty_edit->Authority->editAttributes() ?>>
</span>
<?php echo $offense_penalty_edit->Authority->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$offense_penalty_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $offense_penalty_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $offense_penalty_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$offense_penalty_edit->IsModal) { ?>
<?php echo $offense_penalty_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$offense_penalty_edit->showPageFooter();
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
$offense_penalty_edit->terminate();
?>