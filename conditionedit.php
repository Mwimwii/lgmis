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
$condition_edit = new condition_edit();

// Run the page
$condition_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$condition_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fconditionedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fconditionedit = currentForm = new ew.Form("fconditionedit", "edit");

	// Validate form
	fconditionedit.validate = function() {
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
			<?php if ($condition_edit->ConditionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ConditionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $condition_edit->ConditionCode->caption(), $condition_edit->ConditionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($condition_edit->ConditionDesc->Required) { ?>
				elm = this.getElements("x" + infix + "_ConditionDesc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $condition_edit->ConditionDesc->caption(), $condition_edit->ConditionDesc->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($condition_edit->AcceptableIndicator->Required) { ?>
				elm = this.getElements("x" + infix + "_AcceptableIndicator");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $condition_edit->AcceptableIndicator->caption(), $condition_edit->AcceptableIndicator->RequiredErrorMessage)) ?>");
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
	fconditionedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fconditionedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fconditionedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $condition_edit->showPageHeader(); ?>
<?php
$condition_edit->showMessage();
?>
<?php if (!$condition_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $condition_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fconditionedit" id="fconditionedit" class="<?php echo $condition_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="condition">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$condition_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($condition_edit->ConditionCode->Visible) { // ConditionCode ?>
	<div id="r_ConditionCode" class="form-group row">
		<label id="elh_condition_ConditionCode" class="<?php echo $condition_edit->LeftColumnClass ?>"><?php echo $condition_edit->ConditionCode->caption() ?><?php echo $condition_edit->ConditionCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $condition_edit->RightColumnClass ?>"><div <?php echo $condition_edit->ConditionCode->cellAttributes() ?>>
<span id="el_condition_ConditionCode">
<span<?php echo $condition_edit->ConditionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($condition_edit->ConditionCode->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="condition" data-field="x_ConditionCode" name="x_ConditionCode" id="x_ConditionCode" value="<?php echo HtmlEncode($condition_edit->ConditionCode->CurrentValue) ?>">
<?php echo $condition_edit->ConditionCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($condition_edit->ConditionDesc->Visible) { // ConditionDesc ?>
	<div id="r_ConditionDesc" class="form-group row">
		<label id="elh_condition_ConditionDesc" for="x_ConditionDesc" class="<?php echo $condition_edit->LeftColumnClass ?>"><?php echo $condition_edit->ConditionDesc->caption() ?><?php echo $condition_edit->ConditionDesc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $condition_edit->RightColumnClass ?>"><div <?php echo $condition_edit->ConditionDesc->cellAttributes() ?>>
<span id="el_condition_ConditionDesc">
<input type="text" data-table="condition" data-field="x_ConditionDesc" name="x_ConditionDesc" id="x_ConditionDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($condition_edit->ConditionDesc->getPlaceHolder()) ?>" value="<?php echo $condition_edit->ConditionDesc->EditValue ?>"<?php echo $condition_edit->ConditionDesc->editAttributes() ?>>
</span>
<?php echo $condition_edit->ConditionDesc->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($condition_edit->AcceptableIndicator->Visible) { // AcceptableIndicator ?>
	<div id="r_AcceptableIndicator" class="form-group row">
		<label id="elh_condition_AcceptableIndicator" for="x_AcceptableIndicator" class="<?php echo $condition_edit->LeftColumnClass ?>"><?php echo $condition_edit->AcceptableIndicator->caption() ?><?php echo $condition_edit->AcceptableIndicator->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $condition_edit->RightColumnClass ?>"><div <?php echo $condition_edit->AcceptableIndicator->cellAttributes() ?>>
<span id="el_condition_AcceptableIndicator">
<input type="text" data-table="condition" data-field="x_AcceptableIndicator" name="x_AcceptableIndicator" id="x_AcceptableIndicator" size="30" maxlength="1" placeholder="<?php echo HtmlEncode($condition_edit->AcceptableIndicator->getPlaceHolder()) ?>" value="<?php echo $condition_edit->AcceptableIndicator->EditValue ?>"<?php echo $condition_edit->AcceptableIndicator->editAttributes() ?>>
</span>
<?php echo $condition_edit->AcceptableIndicator->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$condition_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $condition_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $condition_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$condition_edit->IsModal) { ?>
<?php echo $condition_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$condition_edit->showPageFooter();
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
$condition_edit->terminate();
?>