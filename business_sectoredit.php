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
$business_sector_edit = new business_sector_edit();

// Run the page
$business_sector_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$business_sector_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fbusiness_sectoredit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fbusiness_sectoredit = currentForm = new ew.Form("fbusiness_sectoredit", "edit");

	// Validate form
	fbusiness_sectoredit.validate = function() {
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
			<?php if ($business_sector_edit->business_sector_code->Required) { ?>
				elm = this.getElements("x" + infix + "_business_sector_code");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_sector_edit->business_sector_code->caption(), $business_sector_edit->business_sector_code->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($business_sector_edit->business_sector_name->Required) { ?>
				elm = this.getElements("x" + infix + "_business_sector_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_sector_edit->business_sector_name->caption(), $business_sector_edit->business_sector_name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($business_sector_edit->business_sector_desc->Required) { ?>
				elm = this.getElements("x" + infix + "_business_sector_desc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_sector_edit->business_sector_desc->caption(), $business_sector_edit->business_sector_desc->RequiredErrorMessage)) ?>");
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
	fbusiness_sectoredit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fbusiness_sectoredit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fbusiness_sectoredit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $business_sector_edit->showPageHeader(); ?>
<?php
$business_sector_edit->showMessage();
?>
<?php if (!$business_sector_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $business_sector_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fbusiness_sectoredit" id="fbusiness_sectoredit" class="<?php echo $business_sector_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="business_sector">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$business_sector_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($business_sector_edit->business_sector_code->Visible) { // business_sector_code ?>
	<div id="r_business_sector_code" class="form-group row">
		<label id="elh_business_sector_business_sector_code" class="<?php echo $business_sector_edit->LeftColumnClass ?>"><?php echo $business_sector_edit->business_sector_code->caption() ?><?php echo $business_sector_edit->business_sector_code->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $business_sector_edit->RightColumnClass ?>"><div <?php echo $business_sector_edit->business_sector_code->cellAttributes() ?>>
<span id="el_business_sector_business_sector_code">
<span<?php echo $business_sector_edit->business_sector_code->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($business_sector_edit->business_sector_code->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="business_sector" data-field="x_business_sector_code" name="x_business_sector_code" id="x_business_sector_code" value="<?php echo HtmlEncode($business_sector_edit->business_sector_code->CurrentValue) ?>">
<?php echo $business_sector_edit->business_sector_code->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($business_sector_edit->business_sector_name->Visible) { // business_sector_name ?>
	<div id="r_business_sector_name" class="form-group row">
		<label id="elh_business_sector_business_sector_name" for="x_business_sector_name" class="<?php echo $business_sector_edit->LeftColumnClass ?>"><?php echo $business_sector_edit->business_sector_name->caption() ?><?php echo $business_sector_edit->business_sector_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $business_sector_edit->RightColumnClass ?>"><div <?php echo $business_sector_edit->business_sector_name->cellAttributes() ?>>
<span id="el_business_sector_business_sector_name">
<input type="text" data-table="business_sector" data-field="x_business_sector_name" name="x_business_sector_name" id="x_business_sector_name" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($business_sector_edit->business_sector_name->getPlaceHolder()) ?>" value="<?php echo $business_sector_edit->business_sector_name->EditValue ?>"<?php echo $business_sector_edit->business_sector_name->editAttributes() ?>>
</span>
<?php echo $business_sector_edit->business_sector_name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($business_sector_edit->business_sector_desc->Visible) { // business_sector_desc ?>
	<div id="r_business_sector_desc" class="form-group row">
		<label id="elh_business_sector_business_sector_desc" for="x_business_sector_desc" class="<?php echo $business_sector_edit->LeftColumnClass ?>"><?php echo $business_sector_edit->business_sector_desc->caption() ?><?php echo $business_sector_edit->business_sector_desc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $business_sector_edit->RightColumnClass ?>"><div <?php echo $business_sector_edit->business_sector_desc->cellAttributes() ?>>
<span id="el_business_sector_business_sector_desc">
<input type="text" data-table="business_sector" data-field="x_business_sector_desc" name="x_business_sector_desc" id="x_business_sector_desc" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($business_sector_edit->business_sector_desc->getPlaceHolder()) ?>" value="<?php echo $business_sector_edit->business_sector_desc->EditValue ?>"<?php echo $business_sector_edit->business_sector_desc->editAttributes() ?>>
</span>
<?php echo $business_sector_edit->business_sector_desc->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$business_sector_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $business_sector_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $business_sector_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$business_sector_edit->IsModal) { ?>
<?php echo $business_sector_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$business_sector_edit->showPageFooter();
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
$business_sector_edit->terminate();
?>