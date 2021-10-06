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
$physical_challenge_edit = new physical_challenge_edit();

// Run the page
$physical_challenge_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$physical_challenge_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fphysical_challengeedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fphysical_challengeedit = currentForm = new ew.Form("fphysical_challengeedit", "edit");

	// Validate form
	fphysical_challengeedit.validate = function() {
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
			<?php if ($physical_challenge_edit->PhysicalChallenge->Required) { ?>
				elm = this.getElements("x" + infix + "_PhysicalChallenge");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $physical_challenge_edit->PhysicalChallenge->caption(), $physical_challenge_edit->PhysicalChallenge->RequiredErrorMessage)) ?>");
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
	fphysical_challengeedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fphysical_challengeedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fphysical_challengeedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $physical_challenge_edit->showPageHeader(); ?>
<?php
$physical_challenge_edit->showMessage();
?>
<?php if (!$physical_challenge_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $physical_challenge_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fphysical_challengeedit" id="fphysical_challengeedit" class="<?php echo $physical_challenge_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="physical_challenge">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$physical_challenge_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($physical_challenge_edit->PhysicalChallenge->Visible) { // PhysicalChallenge ?>
	<div id="r_PhysicalChallenge" class="form-group row">
		<label id="elh_physical_challenge_PhysicalChallenge" for="x_PhysicalChallenge" class="<?php echo $physical_challenge_edit->LeftColumnClass ?>"><?php echo $physical_challenge_edit->PhysicalChallenge->caption() ?><?php echo $physical_challenge_edit->PhysicalChallenge->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $physical_challenge_edit->RightColumnClass ?>"><div <?php echo $physical_challenge_edit->PhysicalChallenge->cellAttributes() ?>>
<input type="text" data-table="physical_challenge" data-field="x_PhysicalChallenge" name="x_PhysicalChallenge" id="x_PhysicalChallenge" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($physical_challenge_edit->PhysicalChallenge->getPlaceHolder()) ?>" value="<?php echo $physical_challenge_edit->PhysicalChallenge->EditValue ?>"<?php echo $physical_challenge_edit->PhysicalChallenge->editAttributes() ?>>
<input type="hidden" data-table="physical_challenge" data-field="x_PhysicalChallenge" name="o_PhysicalChallenge" id="o_PhysicalChallenge" value="<?php echo HtmlEncode($physical_challenge_edit->PhysicalChallenge->OldValue != null ? $physical_challenge_edit->PhysicalChallenge->OldValue : $physical_challenge_edit->PhysicalChallenge->CurrentValue) ?>">
<?php echo $physical_challenge_edit->PhysicalChallenge->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$physical_challenge_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $physical_challenge_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $physical_challenge_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$physical_challenge_edit->IsModal) { ?>
<?php echo $physical_challenge_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$physical_challenge_edit->showPageFooter();
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
$physical_challenge_edit->terminate();
?>