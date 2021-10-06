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
$condition_add = new condition_add();

// Run the page
$condition_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$condition_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fconditionadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fconditionadd = currentForm = new ew.Form("fconditionadd", "add");

	// Validate form
	fconditionadd.validate = function() {
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
			<?php if ($condition_add->ConditionDesc->Required) { ?>
				elm = this.getElements("x" + infix + "_ConditionDesc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $condition_add->ConditionDesc->caption(), $condition_add->ConditionDesc->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($condition_add->AcceptableIndicator->Required) { ?>
				elm = this.getElements("x" + infix + "_AcceptableIndicator");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $condition_add->AcceptableIndicator->caption(), $condition_add->AcceptableIndicator->RequiredErrorMessage)) ?>");
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
	fconditionadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fconditionadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fconditionadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $condition_add->showPageHeader(); ?>
<?php
$condition_add->showMessage();
?>
<form name="fconditionadd" id="fconditionadd" class="<?php echo $condition_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="condition">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$condition_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($condition_add->ConditionDesc->Visible) { // ConditionDesc ?>
	<div id="r_ConditionDesc" class="form-group row">
		<label id="elh_condition_ConditionDesc" for="x_ConditionDesc" class="<?php echo $condition_add->LeftColumnClass ?>"><?php echo $condition_add->ConditionDesc->caption() ?><?php echo $condition_add->ConditionDesc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $condition_add->RightColumnClass ?>"><div <?php echo $condition_add->ConditionDesc->cellAttributes() ?>>
<span id="el_condition_ConditionDesc">
<input type="text" data-table="condition" data-field="x_ConditionDesc" name="x_ConditionDesc" id="x_ConditionDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($condition_add->ConditionDesc->getPlaceHolder()) ?>" value="<?php echo $condition_add->ConditionDesc->EditValue ?>"<?php echo $condition_add->ConditionDesc->editAttributes() ?>>
</span>
<?php echo $condition_add->ConditionDesc->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($condition_add->AcceptableIndicator->Visible) { // AcceptableIndicator ?>
	<div id="r_AcceptableIndicator" class="form-group row">
		<label id="elh_condition_AcceptableIndicator" for="x_AcceptableIndicator" class="<?php echo $condition_add->LeftColumnClass ?>"><?php echo $condition_add->AcceptableIndicator->caption() ?><?php echo $condition_add->AcceptableIndicator->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $condition_add->RightColumnClass ?>"><div <?php echo $condition_add->AcceptableIndicator->cellAttributes() ?>>
<span id="el_condition_AcceptableIndicator">
<input type="text" data-table="condition" data-field="x_AcceptableIndicator" name="x_AcceptableIndicator" id="x_AcceptableIndicator" size="30" maxlength="1" placeholder="<?php echo HtmlEncode($condition_add->AcceptableIndicator->getPlaceHolder()) ?>" value="<?php echo $condition_add->AcceptableIndicator->EditValue ?>"<?php echo $condition_add->AcceptableIndicator->editAttributes() ?>>
</span>
<?php echo $condition_add->AcceptableIndicator->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$condition_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $condition_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $condition_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$condition_add->showPageFooter();
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
$condition_add->terminate();
?>