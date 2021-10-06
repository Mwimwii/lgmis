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
$progress_status_edit = new progress_status_edit();

// Run the page
$progress_status_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$progress_status_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fprogress_statusedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fprogress_statusedit = currentForm = new ew.Form("fprogress_statusedit", "edit");

	// Validate form
	fprogress_statusedit.validate = function() {
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
			<?php if ($progress_status_edit->ProgressCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProgressCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $progress_status_edit->ProgressCode->caption(), $progress_status_edit->ProgressCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($progress_status_edit->ProgressDescription->Required) { ?>
				elm = this.getElements("x" + infix + "_ProgressDescription");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $progress_status_edit->ProgressDescription->caption(), $progress_status_edit->ProgressDescription->RequiredErrorMessage)) ?>");
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
	fprogress_statusedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fprogress_statusedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fprogress_statusedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $progress_status_edit->showPageHeader(); ?>
<?php
$progress_status_edit->showMessage();
?>
<?php if (!$progress_status_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $progress_status_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fprogress_statusedit" id="fprogress_statusedit" class="<?php echo $progress_status_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="progress_status">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$progress_status_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($progress_status_edit->ProgressCode->Visible) { // ProgressCode ?>
	<div id="r_ProgressCode" class="form-group row">
		<label id="elh_progress_status_ProgressCode" class="<?php echo $progress_status_edit->LeftColumnClass ?>"><?php echo $progress_status_edit->ProgressCode->caption() ?><?php echo $progress_status_edit->ProgressCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $progress_status_edit->RightColumnClass ?>"><div <?php echo $progress_status_edit->ProgressCode->cellAttributes() ?>>
<span id="el_progress_status_ProgressCode">
<span<?php echo $progress_status_edit->ProgressCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($progress_status_edit->ProgressCode->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="progress_status" data-field="x_ProgressCode" name="x_ProgressCode" id="x_ProgressCode" value="<?php echo HtmlEncode($progress_status_edit->ProgressCode->CurrentValue) ?>">
<?php echo $progress_status_edit->ProgressCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($progress_status_edit->ProgressDescription->Visible) { // ProgressDescription ?>
	<div id="r_ProgressDescription" class="form-group row">
		<label id="elh_progress_status_ProgressDescription" for="x_ProgressDescription" class="<?php echo $progress_status_edit->LeftColumnClass ?>"><?php echo $progress_status_edit->ProgressDescription->caption() ?><?php echo $progress_status_edit->ProgressDescription->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $progress_status_edit->RightColumnClass ?>"><div <?php echo $progress_status_edit->ProgressDescription->cellAttributes() ?>>
<span id="el_progress_status_ProgressDescription">
<input type="text" data-table="progress_status" data-field="x_ProgressDescription" name="x_ProgressDescription" id="x_ProgressDescription" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($progress_status_edit->ProgressDescription->getPlaceHolder()) ?>" value="<?php echo $progress_status_edit->ProgressDescription->EditValue ?>"<?php echo $progress_status_edit->ProgressDescription->editAttributes() ?>>
</span>
<?php echo $progress_status_edit->ProgressDescription->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$progress_status_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $progress_status_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $progress_status_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$progress_status_edit->IsModal) { ?>
<?php echo $progress_status_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$progress_status_edit->showPageFooter();
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
$progress_status_edit->terminate();
?>