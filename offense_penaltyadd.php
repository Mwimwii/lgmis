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
$offense_penalty_add = new offense_penalty_add();

// Run the page
$offense_penalty_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$offense_penalty_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var foffense_penaltyadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	foffense_penaltyadd = currentForm = new ew.Form("foffense_penaltyadd", "add");

	// Validate form
	foffense_penaltyadd.validate = function() {
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
			<?php if ($offense_penalty_add->OffenseCategory->Required) { ?>
				elm = this.getElements("x" + infix + "_OffenseCategory");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $offense_penalty_add->OffenseCategory->caption(), $offense_penalty_add->OffenseCategory->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($offense_penalty_add->OffenseName->Required) { ?>
				elm = this.getElements("x" + infix + "_OffenseName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $offense_penalty_add->OffenseName->caption(), $offense_penalty_add->OffenseName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($offense_penalty_add->Frequency->Required) { ?>
				elm = this.getElements("x" + infix + "_Frequency");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $offense_penalty_add->Frequency->caption(), $offense_penalty_add->Frequency->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Frequency");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($offense_penalty_add->Frequency->errorMessage()) ?>");
			<?php if ($offense_penalty_add->AppropriateAction->Required) { ?>
				elm = this.getElements("x" + infix + "_AppropriateAction");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $offense_penalty_add->AppropriateAction->caption(), $offense_penalty_add->AppropriateAction->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($offense_penalty_add->Authority->Required) { ?>
				elm = this.getElements("x" + infix + "_Authority");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $offense_penalty_add->Authority->caption(), $offense_penalty_add->Authority->RequiredErrorMessage)) ?>");
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
	foffense_penaltyadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	foffense_penaltyadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	foffense_penaltyadd.lists["x_OffenseCategory"] = <?php echo $offense_penalty_add->OffenseCategory->Lookup->toClientList($offense_penalty_add) ?>;
	foffense_penaltyadd.lists["x_OffenseCategory"].options = <?php echo JsonEncode($offense_penalty_add->OffenseCategory->lookupOptions()) ?>;
	foffense_penaltyadd.lists["x_AppropriateAction"] = <?php echo $offense_penalty_add->AppropriateAction->Lookup->toClientList($offense_penalty_add) ?>;
	foffense_penaltyadd.lists["x_AppropriateAction"].options = <?php echo JsonEncode($offense_penalty_add->AppropriateAction->lookupOptions()) ?>;
	loadjs.done("foffense_penaltyadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $offense_penalty_add->showPageHeader(); ?>
<?php
$offense_penalty_add->showMessage();
?>
<form name="foffense_penaltyadd" id="foffense_penaltyadd" class="<?php echo $offense_penalty_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="offense_penalty">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$offense_penalty_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($offense_penalty_add->OffenseCategory->Visible) { // OffenseCategory ?>
	<div id="r_OffenseCategory" class="form-group row">
		<label id="elh_offense_penalty_OffenseCategory" for="x_OffenseCategory" class="<?php echo $offense_penalty_add->LeftColumnClass ?>"><?php echo $offense_penalty_add->OffenseCategory->caption() ?><?php echo $offense_penalty_add->OffenseCategory->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $offense_penalty_add->RightColumnClass ?>"><div <?php echo $offense_penalty_add->OffenseCategory->cellAttributes() ?>>
<span id="el_offense_penalty_OffenseCategory">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="offense_penalty" data-field="x_OffenseCategory" data-value-separator="<?php echo $offense_penalty_add->OffenseCategory->displayValueSeparatorAttribute() ?>" id="x_OffenseCategory" name="x_OffenseCategory"<?php echo $offense_penalty_add->OffenseCategory->editAttributes() ?>>
			<?php echo $offense_penalty_add->OffenseCategory->selectOptionListHtml("x_OffenseCategory") ?>
		</select>
</div>
<?php echo $offense_penalty_add->OffenseCategory->Lookup->getParamTag($offense_penalty_add, "p_x_OffenseCategory") ?>
</span>
<?php echo $offense_penalty_add->OffenseCategory->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($offense_penalty_add->OffenseName->Visible) { // OffenseName ?>
	<div id="r_OffenseName" class="form-group row">
		<label id="elh_offense_penalty_OffenseName" for="x_OffenseName" class="<?php echo $offense_penalty_add->LeftColumnClass ?>"><?php echo $offense_penalty_add->OffenseName->caption() ?><?php echo $offense_penalty_add->OffenseName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $offense_penalty_add->RightColumnClass ?>"><div <?php echo $offense_penalty_add->OffenseName->cellAttributes() ?>>
<span id="el_offense_penalty_OffenseName">
<input type="text" data-table="offense_penalty" data-field="x_OffenseName" name="x_OffenseName" id="x_OffenseName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($offense_penalty_add->OffenseName->getPlaceHolder()) ?>" value="<?php echo $offense_penalty_add->OffenseName->EditValue ?>"<?php echo $offense_penalty_add->OffenseName->editAttributes() ?>>
</span>
<?php echo $offense_penalty_add->OffenseName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($offense_penalty_add->Frequency->Visible) { // Frequency ?>
	<div id="r_Frequency" class="form-group row">
		<label id="elh_offense_penalty_Frequency" for="x_Frequency" class="<?php echo $offense_penalty_add->LeftColumnClass ?>"><?php echo $offense_penalty_add->Frequency->caption() ?><?php echo $offense_penalty_add->Frequency->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $offense_penalty_add->RightColumnClass ?>"><div <?php echo $offense_penalty_add->Frequency->cellAttributes() ?>>
<span id="el_offense_penalty_Frequency">
<input type="text" data-table="offense_penalty" data-field="x_Frequency" name="x_Frequency" id="x_Frequency" size="30" placeholder="<?php echo HtmlEncode($offense_penalty_add->Frequency->getPlaceHolder()) ?>" value="<?php echo $offense_penalty_add->Frequency->EditValue ?>"<?php echo $offense_penalty_add->Frequency->editAttributes() ?>>
</span>
<?php echo $offense_penalty_add->Frequency->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($offense_penalty_add->AppropriateAction->Visible) { // AppropriateAction ?>
	<div id="r_AppropriateAction" class="form-group row">
		<label id="elh_offense_penalty_AppropriateAction" for="x_AppropriateAction" class="<?php echo $offense_penalty_add->LeftColumnClass ?>"><?php echo $offense_penalty_add->AppropriateAction->caption() ?><?php echo $offense_penalty_add->AppropriateAction->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $offense_penalty_add->RightColumnClass ?>"><div <?php echo $offense_penalty_add->AppropriateAction->cellAttributes() ?>>
<span id="el_offense_penalty_AppropriateAction">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="offense_penalty" data-field="x_AppropriateAction" data-value-separator="<?php echo $offense_penalty_add->AppropriateAction->displayValueSeparatorAttribute() ?>" id="x_AppropriateAction" name="x_AppropriateAction"<?php echo $offense_penalty_add->AppropriateAction->editAttributes() ?>>
			<?php echo $offense_penalty_add->AppropriateAction->selectOptionListHtml("x_AppropriateAction") ?>
		</select>
</div>
<?php echo $offense_penalty_add->AppropriateAction->Lookup->getParamTag($offense_penalty_add, "p_x_AppropriateAction") ?>
</span>
<?php echo $offense_penalty_add->AppropriateAction->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($offense_penalty_add->Authority->Visible) { // Authority ?>
	<div id="r_Authority" class="form-group row">
		<label id="elh_offense_penalty_Authority" for="x_Authority" class="<?php echo $offense_penalty_add->LeftColumnClass ?>"><?php echo $offense_penalty_add->Authority->caption() ?><?php echo $offense_penalty_add->Authority->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $offense_penalty_add->RightColumnClass ?>"><div <?php echo $offense_penalty_add->Authority->cellAttributes() ?>>
<span id="el_offense_penalty_Authority">
<input type="text" data-table="offense_penalty" data-field="x_Authority" name="x_Authority" id="x_Authority" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($offense_penalty_add->Authority->getPlaceHolder()) ?>" value="<?php echo $offense_penalty_add->Authority->EditValue ?>"<?php echo $offense_penalty_add->Authority->editAttributes() ?>>
</span>
<?php echo $offense_penalty_add->Authority->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$offense_penalty_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $offense_penalty_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $offense_penalty_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$offense_penalty_add->showPageFooter();
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
$offense_penalty_add->terminate();
?>