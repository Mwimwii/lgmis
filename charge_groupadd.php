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
$charge_group_add = new charge_group_add();

// Run the page
$charge_group_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$charge_group_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcharge_groupadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fcharge_groupadd = currentForm = new ew.Form("fcharge_groupadd", "add");

	// Validate form
	fcharge_groupadd.validate = function() {
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
			<?php if ($charge_group_add->ChargeGroup->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeGroup");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charge_group_add->ChargeGroup->caption(), $charge_group_add->ChargeGroup->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($charge_group_add->ChargeGroupDesc->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeGroupDesc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charge_group_add->ChargeGroupDesc->caption(), $charge_group_add->ChargeGroupDesc->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($charge_group_add->Charges->Required) { ?>
				elm = this.getElements("x" + infix + "_Charges[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charge_group_add->Charges->caption(), $charge_group_add->Charges->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($charge_group_add->Account->Required) { ?>
				elm = this.getElements("x" + infix + "_Account");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charge_group_add->Account->caption(), $charge_group_add->Account->RequiredErrorMessage)) ?>");
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
	fcharge_groupadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcharge_groupadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fcharge_groupadd.lists["x_Charges[]"] = <?php echo $charge_group_add->Charges->Lookup->toClientList($charge_group_add) ?>;
	fcharge_groupadd.lists["x_Charges[]"].options = <?php echo JsonEncode($charge_group_add->Charges->lookupOptions()) ?>;
	fcharge_groupadd.lists["x_Account"] = <?php echo $charge_group_add->Account->Lookup->toClientList($charge_group_add) ?>;
	fcharge_groupadd.lists["x_Account"].options = <?php echo JsonEncode($charge_group_add->Account->lookupOptions()) ?>;
	loadjs.done("fcharge_groupadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $charge_group_add->showPageHeader(); ?>
<?php
$charge_group_add->showMessage();
?>
<form name="fcharge_groupadd" id="fcharge_groupadd" class="<?php echo $charge_group_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="charge_group">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$charge_group_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($charge_group_add->ChargeGroup->Visible) { // ChargeGroup ?>
	<div id="r_ChargeGroup" class="form-group row">
		<label id="elh_charge_group_ChargeGroup" for="x_ChargeGroup" class="<?php echo $charge_group_add->LeftColumnClass ?>"><?php echo $charge_group_add->ChargeGroup->caption() ?><?php echo $charge_group_add->ChargeGroup->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $charge_group_add->RightColumnClass ?>"><div <?php echo $charge_group_add->ChargeGroup->cellAttributes() ?>>
<span id="el_charge_group_ChargeGroup">
<input type="text" data-table="charge_group" data-field="x_ChargeGroup" name="x_ChargeGroup" id="x_ChargeGroup" size="30" maxlength="2" placeholder="<?php echo HtmlEncode($charge_group_add->ChargeGroup->getPlaceHolder()) ?>" value="<?php echo $charge_group_add->ChargeGroup->EditValue ?>"<?php echo $charge_group_add->ChargeGroup->editAttributes() ?>>
</span>
<?php echo $charge_group_add->ChargeGroup->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($charge_group_add->ChargeGroupDesc->Visible) { // ChargeGroupDesc ?>
	<div id="r_ChargeGroupDesc" class="form-group row">
		<label id="elh_charge_group_ChargeGroupDesc" for="x_ChargeGroupDesc" class="<?php echo $charge_group_add->LeftColumnClass ?>"><?php echo $charge_group_add->ChargeGroupDesc->caption() ?><?php echo $charge_group_add->ChargeGroupDesc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $charge_group_add->RightColumnClass ?>"><div <?php echo $charge_group_add->ChargeGroupDesc->cellAttributes() ?>>
<span id="el_charge_group_ChargeGroupDesc">
<input type="text" data-table="charge_group" data-field="x_ChargeGroupDesc" name="x_ChargeGroupDesc" id="x_ChargeGroupDesc" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($charge_group_add->ChargeGroupDesc->getPlaceHolder()) ?>" value="<?php echo $charge_group_add->ChargeGroupDesc->EditValue ?>"<?php echo $charge_group_add->ChargeGroupDesc->editAttributes() ?>>
</span>
<?php echo $charge_group_add->ChargeGroupDesc->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($charge_group_add->Charges->Visible) { // Charges ?>
	<div id="r_Charges" class="form-group row">
		<label id="elh_charge_group_Charges" class="<?php echo $charge_group_add->LeftColumnClass ?>"><?php echo $charge_group_add->Charges->caption() ?><?php echo $charge_group_add->Charges->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $charge_group_add->RightColumnClass ?>"><div <?php echo $charge_group_add->Charges->cellAttributes() ?>>
<span id="el_charge_group_Charges">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_Charges"><?php echo EmptyValue(strval($charge_group_add->Charges->ViewValue)) ? $Language->phrase("PleaseSelect") : $charge_group_add->Charges->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($charge_group_add->Charges->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($charge_group_add->Charges->ReadOnly || $charge_group_add->Charges->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_Charges[]',m:1,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $charge_group_add->Charges->Lookup->getParamTag($charge_group_add, "p_x_Charges") ?>
<input type="hidden" data-table="charge_group" data-field="x_Charges" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $charge_group_add->Charges->displayValueSeparatorAttribute() ?>" name="x_Charges[]" id="x_Charges[]" value="<?php echo $charge_group_add->Charges->CurrentValue ?>"<?php echo $charge_group_add->Charges->editAttributes() ?>>
</span>
<?php echo $charge_group_add->Charges->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($charge_group_add->Account->Visible) { // Account ?>
	<div id="r_Account" class="form-group row">
		<label id="elh_charge_group_Account" class="<?php echo $charge_group_add->LeftColumnClass ?>"><?php echo $charge_group_add->Account->caption() ?><?php echo $charge_group_add->Account->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $charge_group_add->RightColumnClass ?>"><div <?php echo $charge_group_add->Account->cellAttributes() ?>>
<span id="el_charge_group_Account">
<div id="tp_x_Account" class="ew-template"><input type="radio" class="custom-control-input" data-table="charge_group" data-field="x_Account" data-value-separator="<?php echo $charge_group_add->Account->displayValueSeparatorAttribute() ?>" name="x_Account" id="x_Account" value="{value}"<?php echo $charge_group_add->Account->editAttributes() ?>></div>
<div id="dsl_x_Account" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $charge_group_add->Account->radioButtonListHtml(FALSE, "x_Account") ?>
</div></div>
<?php echo $charge_group_add->Account->Lookup->getParamTag($charge_group_add, "p_x_Account") ?>
</span>
<?php echo $charge_group_add->Account->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$charge_group_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $charge_group_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $charge_group_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$charge_group_add->showPageFooter();
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
$charge_group_add->terminate();
?>