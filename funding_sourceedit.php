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
$funding_source_edit = new funding_source_edit();

// Run the page
$funding_source_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$funding_source_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ffunding_sourceedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	ffunding_sourceedit = currentForm = new ew.Form("ffunding_sourceedit", "edit");

	// Validate form
	ffunding_sourceedit.validate = function() {
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
			<?php if ($funding_source_edit->FundingSource->Required) { ?>
				elm = this.getElements("x" + infix + "_FundingSource");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $funding_source_edit->FundingSource->caption(), $funding_source_edit->FundingSource->RequiredErrorMessage)) ?>");
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
	ffunding_sourceedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ffunding_sourceedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("ffunding_sourceedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $funding_source_edit->showPageHeader(); ?>
<?php
$funding_source_edit->showMessage();
?>
<?php if (!$funding_source_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $funding_source_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="ffunding_sourceedit" id="ffunding_sourceedit" class="<?php echo $funding_source_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="funding_source">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$funding_source_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($funding_source_edit->FundingSource->Visible) { // FundingSource ?>
	<div id="r_FundingSource" class="form-group row">
		<label id="elh_funding_source_FundingSource" for="x_FundingSource" class="<?php echo $funding_source_edit->LeftColumnClass ?>"><?php echo $funding_source_edit->FundingSource->caption() ?><?php echo $funding_source_edit->FundingSource->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $funding_source_edit->RightColumnClass ?>"><div <?php echo $funding_source_edit->FundingSource->cellAttributes() ?>>
<input type="text" data-table="funding_source" data-field="x_FundingSource" name="x_FundingSource" id="x_FundingSource" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($funding_source_edit->FundingSource->getPlaceHolder()) ?>" value="<?php echo $funding_source_edit->FundingSource->EditValue ?>"<?php echo $funding_source_edit->FundingSource->editAttributes() ?>>
<input type="hidden" data-table="funding_source" data-field="x_FundingSource" name="o_FundingSource" id="o_FundingSource" value="<?php echo HtmlEncode($funding_source_edit->FundingSource->OldValue != null ? $funding_source_edit->FundingSource->OldValue : $funding_source_edit->FundingSource->CurrentValue) ?>">
<?php echo $funding_source_edit->FundingSource->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$funding_source_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $funding_source_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $funding_source_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$funding_source_edit->IsModal) { ?>
<?php echo $funding_source_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$funding_source_edit->showPageFooter();
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
$funding_source_edit->terminate();
?>