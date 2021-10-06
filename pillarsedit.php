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
$pillars_edit = new pillars_edit();

// Run the page
$pillars_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$pillars_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpillarsedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fpillarsedit = currentForm = new ew.Form("fpillarsedit", "edit");

	// Validate form
	fpillarsedit.validate = function() {
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
			<?php if ($pillars_edit->NDP->Required) { ?>
				elm = this.getElements("x" + infix + "_NDP");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pillars_edit->NDP->caption(), $pillars_edit->NDP->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_NDP");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($pillars_edit->NDP->errorMessage()) ?>");
			<?php if ($pillars_edit->PillarNo->Required) { ?>
				elm = this.getElements("x" + infix + "_PillarNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pillars_edit->PillarNo->caption(), $pillars_edit->PillarNo->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PillarNo");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($pillars_edit->PillarNo->errorMessage()) ?>");
			<?php if ($pillars_edit->PillarName->Required) { ?>
				elm = this.getElements("x" + infix + "_PillarName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pillars_edit->PillarName->caption(), $pillars_edit->PillarName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($pillars_edit->PillarObjective->Required) { ?>
				elm = this.getElements("x" + infix + "_PillarObjective");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pillars_edit->PillarObjective->caption(), $pillars_edit->PillarObjective->RequiredErrorMessage)) ?>");
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
	fpillarsedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpillarsedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fpillarsedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $pillars_edit->showPageHeader(); ?>
<?php
$pillars_edit->showMessage();
?>
<?php if (!$pillars_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $pillars_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fpillarsedit" id="fpillarsedit" class="<?php echo $pillars_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="pillars">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$pillars_edit->IsModal ?>">
<?php if ($pillars->getCurrentMasterTable() == "ndp") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="ndp">
<input type="hidden" name="fk_NDP" value="<?php echo HtmlEncode($pillars_edit->NDP->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($pillars_edit->NDP->Visible) { // NDP ?>
	<div id="r_NDP" class="form-group row">
		<label id="elh_pillars_NDP" for="x_NDP" class="<?php echo $pillars_edit->LeftColumnClass ?>"><?php echo $pillars_edit->NDP->caption() ?><?php echo $pillars_edit->NDP->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pillars_edit->RightColumnClass ?>"><div <?php echo $pillars_edit->NDP->cellAttributes() ?>>
<?php if ($pillars_edit->NDP->getSessionValue() != "") { ?>
<span id="el_pillars_NDP">
<span<?php echo $pillars_edit->NDP->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($pillars_edit->NDP->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_NDP" name="x_NDP" value="<?php echo HtmlEncode($pillars_edit->NDP->CurrentValue) ?>">
<?php } else { ?>
<span id="el_pillars_NDP">
<input type="text" data-table="pillars" data-field="x_NDP" name="x_NDP" id="x_NDP" size="30" placeholder="<?php echo HtmlEncode($pillars_edit->NDP->getPlaceHolder()) ?>" value="<?php echo $pillars_edit->NDP->EditValue ?>"<?php echo $pillars_edit->NDP->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $pillars_edit->NDP->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pillars_edit->PillarNo->Visible) { // PillarNo ?>
	<div id="r_PillarNo" class="form-group row">
		<label id="elh_pillars_PillarNo" for="x_PillarNo" class="<?php echo $pillars_edit->LeftColumnClass ?>"><?php echo $pillars_edit->PillarNo->caption() ?><?php echo $pillars_edit->PillarNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pillars_edit->RightColumnClass ?>"><div <?php echo $pillars_edit->PillarNo->cellAttributes() ?>>
<input type="text" data-table="pillars" data-field="x_PillarNo" name="x_PillarNo" id="x_PillarNo" size="30" placeholder="<?php echo HtmlEncode($pillars_edit->PillarNo->getPlaceHolder()) ?>" value="<?php echo $pillars_edit->PillarNo->EditValue ?>"<?php echo $pillars_edit->PillarNo->editAttributes() ?>>
<input type="hidden" data-table="pillars" data-field="x_PillarNo" name="o_PillarNo" id="o_PillarNo" value="<?php echo HtmlEncode($pillars_edit->PillarNo->OldValue != null ? $pillars_edit->PillarNo->OldValue : $pillars_edit->PillarNo->CurrentValue) ?>">
<?php echo $pillars_edit->PillarNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pillars_edit->PillarName->Visible) { // PillarName ?>
	<div id="r_PillarName" class="form-group row">
		<label id="elh_pillars_PillarName" for="x_PillarName" class="<?php echo $pillars_edit->LeftColumnClass ?>"><?php echo $pillars_edit->PillarName->caption() ?><?php echo $pillars_edit->PillarName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pillars_edit->RightColumnClass ?>"><div <?php echo $pillars_edit->PillarName->cellAttributes() ?>>
<span id="el_pillars_PillarName">
<textarea data-table="pillars" data-field="x_PillarName" name="x_PillarName" id="x_PillarName" cols="35" rows="2" placeholder="<?php echo HtmlEncode($pillars_edit->PillarName->getPlaceHolder()) ?>"<?php echo $pillars_edit->PillarName->editAttributes() ?>><?php echo $pillars_edit->PillarName->EditValue ?></textarea>
</span>
<?php echo $pillars_edit->PillarName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pillars_edit->PillarObjective->Visible) { // PillarObjective ?>
	<div id="r_PillarObjective" class="form-group row">
		<label id="elh_pillars_PillarObjective" for="x_PillarObjective" class="<?php echo $pillars_edit->LeftColumnClass ?>"><?php echo $pillars_edit->PillarObjective->caption() ?><?php echo $pillars_edit->PillarObjective->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pillars_edit->RightColumnClass ?>"><div <?php echo $pillars_edit->PillarObjective->cellAttributes() ?>>
<span id="el_pillars_PillarObjective">
<textarea data-table="pillars" data-field="x_PillarObjective" name="x_PillarObjective" id="x_PillarObjective" cols="35" rows="4" placeholder="<?php echo HtmlEncode($pillars_edit->PillarObjective->getPlaceHolder()) ?>"<?php echo $pillars_edit->PillarObjective->editAttributes() ?>><?php echo $pillars_edit->PillarObjective->EditValue ?></textarea>
</span>
<?php echo $pillars_edit->PillarObjective->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$pillars_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $pillars_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $pillars_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$pillars_edit->IsModal) { ?>
<?php echo $pillars_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$pillars_edit->showPageFooter();
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
$pillars_edit->terminate();
?>