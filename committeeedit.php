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
$committee_edit = new committee_edit();

// Run the page
$committee_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$committee_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcommitteeedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fcommitteeedit = currentForm = new ew.Form("fcommitteeedit", "edit");

	// Validate form
	fcommitteeedit.validate = function() {
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
			<?php if ($committee_edit->CommitteCode->Required) { ?>
				elm = this.getElements("x" + infix + "_CommitteCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $committee_edit->CommitteCode->caption(), $committee_edit->CommitteCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($committee_edit->CommitteeName->Required) { ?>
				elm = this.getElements("x" + infix + "_CommitteeName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $committee_edit->CommitteeName->caption(), $committee_edit->CommitteeName->RequiredErrorMessage)) ?>");
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
	fcommitteeedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcommitteeedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fcommitteeedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $committee_edit->showPageHeader(); ?>
<?php
$committee_edit->showMessage();
?>
<?php if (!$committee_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $committee_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fcommitteeedit" id="fcommitteeedit" class="<?php echo $committee_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="committee">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$committee_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($committee_edit->CommitteCode->Visible) { // CommitteCode ?>
	<div id="r_CommitteCode" class="form-group row">
		<label id="elh_committee_CommitteCode" class="<?php echo $committee_edit->LeftColumnClass ?>"><?php echo $committee_edit->CommitteCode->caption() ?><?php echo $committee_edit->CommitteCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $committee_edit->RightColumnClass ?>"><div <?php echo $committee_edit->CommitteCode->cellAttributes() ?>>
<span id="el_committee_CommitteCode">
<span<?php echo $committee_edit->CommitteCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($committee_edit->CommitteCode->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="committee" data-field="x_CommitteCode" name="x_CommitteCode" id="x_CommitteCode" value="<?php echo HtmlEncode($committee_edit->CommitteCode->CurrentValue) ?>">
<?php echo $committee_edit->CommitteCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($committee_edit->CommitteeName->Visible) { // CommitteeName ?>
	<div id="r_CommitteeName" class="form-group row">
		<label id="elh_committee_CommitteeName" for="x_CommitteeName" class="<?php echo $committee_edit->LeftColumnClass ?>"><?php echo $committee_edit->CommitteeName->caption() ?><?php echo $committee_edit->CommitteeName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $committee_edit->RightColumnClass ?>"><div <?php echo $committee_edit->CommitteeName->cellAttributes() ?>>
<span id="el_committee_CommitteeName">
<input type="text" data-table="committee" data-field="x_CommitteeName" name="x_CommitteeName" id="x_CommitteeName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($committee_edit->CommitteeName->getPlaceHolder()) ?>" value="<?php echo $committee_edit->CommitteeName->EditValue ?>"<?php echo $committee_edit->CommitteeName->editAttributes() ?>>
</span>
<?php echo $committee_edit->CommitteeName->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$committee_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $committee_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $committee_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$committee_edit->IsModal) { ?>
<?php echo $committee_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$committee_edit->showPageFooter();
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
$committee_edit->terminate();
?>