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
$acting_status_edit = new acting_status_edit();

// Run the page
$acting_status_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$acting_status_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var facting_statusedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	facting_statusedit = currentForm = new ew.Form("facting_statusedit", "edit");

	// Validate form
	facting_statusedit.validate = function() {
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
			<?php if ($acting_status_edit->ActingStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_ActingStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $acting_status_edit->ActingStatus->caption(), $acting_status_edit->ActingStatus->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($acting_status_edit->ActingStatusDesc->Required) { ?>
				elm = this.getElements("x" + infix + "_ActingStatusDesc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $acting_status_edit->ActingStatusDesc->caption(), $acting_status_edit->ActingStatusDesc->RequiredErrorMessage)) ?>");
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
	facting_statusedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	facting_statusedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("facting_statusedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $acting_status_edit->showPageHeader(); ?>
<?php
$acting_status_edit->showMessage();
?>
<?php if (!$acting_status_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $acting_status_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="facting_statusedit" id="facting_statusedit" class="<?php echo $acting_status_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="acting_status">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$acting_status_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($acting_status_edit->ActingStatus->Visible) { // ActingStatus ?>
	<div id="r_ActingStatus" class="form-group row">
		<label id="elh_acting_status_ActingStatus" class="<?php echo $acting_status_edit->LeftColumnClass ?>"><?php echo $acting_status_edit->ActingStatus->caption() ?><?php echo $acting_status_edit->ActingStatus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $acting_status_edit->RightColumnClass ?>"><div <?php echo $acting_status_edit->ActingStatus->cellAttributes() ?>>
<span id="el_acting_status_ActingStatus">
<span<?php echo $acting_status_edit->ActingStatus->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($acting_status_edit->ActingStatus->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="acting_status" data-field="x_ActingStatus" name="x_ActingStatus" id="x_ActingStatus" value="<?php echo HtmlEncode($acting_status_edit->ActingStatus->CurrentValue) ?>">
<?php echo $acting_status_edit->ActingStatus->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($acting_status_edit->ActingStatusDesc->Visible) { // ActingStatusDesc ?>
	<div id="r_ActingStatusDesc" class="form-group row">
		<label id="elh_acting_status_ActingStatusDesc" for="x_ActingStatusDesc" class="<?php echo $acting_status_edit->LeftColumnClass ?>"><?php echo $acting_status_edit->ActingStatusDesc->caption() ?><?php echo $acting_status_edit->ActingStatusDesc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $acting_status_edit->RightColumnClass ?>"><div <?php echo $acting_status_edit->ActingStatusDesc->cellAttributes() ?>>
<span id="el_acting_status_ActingStatusDesc">
<input type="text" data-table="acting_status" data-field="x_ActingStatusDesc" name="x_ActingStatusDesc" id="x_ActingStatusDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($acting_status_edit->ActingStatusDesc->getPlaceHolder()) ?>" value="<?php echo $acting_status_edit->ActingStatusDesc->EditValue ?>"<?php echo $acting_status_edit->ActingStatusDesc->editAttributes() ?>>
</span>
<?php echo $acting_status_edit->ActingStatusDesc->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$acting_status_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $acting_status_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $acting_status_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$acting_status_edit->IsModal) { ?>
<?php echo $acting_status_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$acting_status_edit->showPageFooter();
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
$acting_status_edit->terminate();
?>