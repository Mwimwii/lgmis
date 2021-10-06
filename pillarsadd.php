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
$pillars_add = new pillars_add();

// Run the page
$pillars_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$pillars_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpillarsadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fpillarsadd = currentForm = new ew.Form("fpillarsadd", "add");

	// Validate form
	fpillarsadd.validate = function() {
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
			<?php if ($pillars_add->NDP->Required) { ?>
				elm = this.getElements("x" + infix + "_NDP");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pillars_add->NDP->caption(), $pillars_add->NDP->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_NDP");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($pillars_add->NDP->errorMessage()) ?>");
			<?php if ($pillars_add->PillarNo->Required) { ?>
				elm = this.getElements("x" + infix + "_PillarNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pillars_add->PillarNo->caption(), $pillars_add->PillarNo->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PillarNo");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($pillars_add->PillarNo->errorMessage()) ?>");
			<?php if ($pillars_add->PillarName->Required) { ?>
				elm = this.getElements("x" + infix + "_PillarName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pillars_add->PillarName->caption(), $pillars_add->PillarName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($pillars_add->PillarObjective->Required) { ?>
				elm = this.getElements("x" + infix + "_PillarObjective");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pillars_add->PillarObjective->caption(), $pillars_add->PillarObjective->RequiredErrorMessage)) ?>");
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
	fpillarsadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpillarsadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fpillarsadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $pillars_add->showPageHeader(); ?>
<?php
$pillars_add->showMessage();
?>
<form name="fpillarsadd" id="fpillarsadd" class="<?php echo $pillars_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="pillars">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$pillars_add->IsModal ?>">
<?php if ($pillars->getCurrentMasterTable() == "ndp") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="ndp">
<input type="hidden" name="fk_NDP" value="<?php echo HtmlEncode($pillars_add->NDP->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($pillars_add->NDP->Visible) { // NDP ?>
	<div id="r_NDP" class="form-group row">
		<label id="elh_pillars_NDP" for="x_NDP" class="<?php echo $pillars_add->LeftColumnClass ?>"><?php echo $pillars_add->NDP->caption() ?><?php echo $pillars_add->NDP->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pillars_add->RightColumnClass ?>"><div <?php echo $pillars_add->NDP->cellAttributes() ?>>
<?php if ($pillars_add->NDP->getSessionValue() != "") { ?>
<span id="el_pillars_NDP">
<span<?php echo $pillars_add->NDP->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($pillars_add->NDP->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_NDP" name="x_NDP" value="<?php echo HtmlEncode($pillars_add->NDP->CurrentValue) ?>">
<?php } else { ?>
<span id="el_pillars_NDP">
<input type="text" data-table="pillars" data-field="x_NDP" name="x_NDP" id="x_NDP" size="30" placeholder="<?php echo HtmlEncode($pillars_add->NDP->getPlaceHolder()) ?>" value="<?php echo $pillars_add->NDP->EditValue ?>"<?php echo $pillars_add->NDP->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $pillars_add->NDP->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pillars_add->PillarNo->Visible) { // PillarNo ?>
	<div id="r_PillarNo" class="form-group row">
		<label id="elh_pillars_PillarNo" for="x_PillarNo" class="<?php echo $pillars_add->LeftColumnClass ?>"><?php echo $pillars_add->PillarNo->caption() ?><?php echo $pillars_add->PillarNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pillars_add->RightColumnClass ?>"><div <?php echo $pillars_add->PillarNo->cellAttributes() ?>>
<span id="el_pillars_PillarNo">
<input type="text" data-table="pillars" data-field="x_PillarNo" name="x_PillarNo" id="x_PillarNo" size="30" placeholder="<?php echo HtmlEncode($pillars_add->PillarNo->getPlaceHolder()) ?>" value="<?php echo $pillars_add->PillarNo->EditValue ?>"<?php echo $pillars_add->PillarNo->editAttributes() ?>>
</span>
<?php echo $pillars_add->PillarNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pillars_add->PillarName->Visible) { // PillarName ?>
	<div id="r_PillarName" class="form-group row">
		<label id="elh_pillars_PillarName" for="x_PillarName" class="<?php echo $pillars_add->LeftColumnClass ?>"><?php echo $pillars_add->PillarName->caption() ?><?php echo $pillars_add->PillarName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pillars_add->RightColumnClass ?>"><div <?php echo $pillars_add->PillarName->cellAttributes() ?>>
<span id="el_pillars_PillarName">
<textarea data-table="pillars" data-field="x_PillarName" name="x_PillarName" id="x_PillarName" cols="35" rows="2" placeholder="<?php echo HtmlEncode($pillars_add->PillarName->getPlaceHolder()) ?>"<?php echo $pillars_add->PillarName->editAttributes() ?>><?php echo $pillars_add->PillarName->EditValue ?></textarea>
</span>
<?php echo $pillars_add->PillarName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pillars_add->PillarObjective->Visible) { // PillarObjective ?>
	<div id="r_PillarObjective" class="form-group row">
		<label id="elh_pillars_PillarObjective" for="x_PillarObjective" class="<?php echo $pillars_add->LeftColumnClass ?>"><?php echo $pillars_add->PillarObjective->caption() ?><?php echo $pillars_add->PillarObjective->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pillars_add->RightColumnClass ?>"><div <?php echo $pillars_add->PillarObjective->cellAttributes() ?>>
<span id="el_pillars_PillarObjective">
<textarea data-table="pillars" data-field="x_PillarObjective" name="x_PillarObjective" id="x_PillarObjective" cols="35" rows="4" placeholder="<?php echo HtmlEncode($pillars_add->PillarObjective->getPlaceHolder()) ?>"<?php echo $pillars_add->PillarObjective->editAttributes() ?>><?php echo $pillars_add->PillarObjective->EditValue ?></textarea>
</span>
<?php echo $pillars_add->PillarObjective->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$pillars_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $pillars_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $pillars_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$pillars_add->showPageFooter();
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
$pillars_add->terminate();
?>