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
$appraisal_status_edit = new appraisal_status_edit();

// Run the page
$appraisal_status_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$appraisal_status_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fappraisal_statusedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fappraisal_statusedit = currentForm = new ew.Form("fappraisal_statusedit", "edit");

	// Validate form
	fappraisal_statusedit.validate = function() {
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
			<?php if ($appraisal_status_edit->AppraisalStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_AppraisalStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $appraisal_status_edit->AppraisalStatus->caption(), $appraisal_status_edit->AppraisalStatus->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($appraisal_status_edit->AppraisalStatusDesc->Required) { ?>
				elm = this.getElements("x" + infix + "_AppraisalStatusDesc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $appraisal_status_edit->AppraisalStatusDesc->caption(), $appraisal_status_edit->AppraisalStatusDesc->RequiredErrorMessage)) ?>");
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
	fappraisal_statusedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fappraisal_statusedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fappraisal_statusedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $appraisal_status_edit->showPageHeader(); ?>
<?php
$appraisal_status_edit->showMessage();
?>
<?php if (!$appraisal_status_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $appraisal_status_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fappraisal_statusedit" id="fappraisal_statusedit" class="<?php echo $appraisal_status_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="appraisal_status">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$appraisal_status_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($appraisal_status_edit->AppraisalStatus->Visible) { // AppraisalStatus ?>
	<div id="r_AppraisalStatus" class="form-group row">
		<label id="elh_appraisal_status_AppraisalStatus" class="<?php echo $appraisal_status_edit->LeftColumnClass ?>"><?php echo $appraisal_status_edit->AppraisalStatus->caption() ?><?php echo $appraisal_status_edit->AppraisalStatus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $appraisal_status_edit->RightColumnClass ?>"><div <?php echo $appraisal_status_edit->AppraisalStatus->cellAttributes() ?>>
<span id="el_appraisal_status_AppraisalStatus">
<span<?php echo $appraisal_status_edit->AppraisalStatus->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($appraisal_status_edit->AppraisalStatus->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="appraisal_status" data-field="x_AppraisalStatus" name="x_AppraisalStatus" id="x_AppraisalStatus" value="<?php echo HtmlEncode($appraisal_status_edit->AppraisalStatus->CurrentValue) ?>">
<?php echo $appraisal_status_edit->AppraisalStatus->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($appraisal_status_edit->AppraisalStatusDesc->Visible) { // AppraisalStatusDesc ?>
	<div id="r_AppraisalStatusDesc" class="form-group row">
		<label id="elh_appraisal_status_AppraisalStatusDesc" for="x_AppraisalStatusDesc" class="<?php echo $appraisal_status_edit->LeftColumnClass ?>"><?php echo $appraisal_status_edit->AppraisalStatusDesc->caption() ?><?php echo $appraisal_status_edit->AppraisalStatusDesc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $appraisal_status_edit->RightColumnClass ?>"><div <?php echo $appraisal_status_edit->AppraisalStatusDesc->cellAttributes() ?>>
<span id="el_appraisal_status_AppraisalStatusDesc">
<input type="text" data-table="appraisal_status" data-field="x_AppraisalStatusDesc" name="x_AppraisalStatusDesc" id="x_AppraisalStatusDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($appraisal_status_edit->AppraisalStatusDesc->getPlaceHolder()) ?>" value="<?php echo $appraisal_status_edit->AppraisalStatusDesc->EditValue ?>"<?php echo $appraisal_status_edit->AppraisalStatusDesc->editAttributes() ?>>
</span>
<?php echo $appraisal_status_edit->AppraisalStatusDesc->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$appraisal_status_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $appraisal_status_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $appraisal_status_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$appraisal_status_edit->IsModal) { ?>
<?php echo $appraisal_status_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$appraisal_status_edit->showPageFooter();
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
$appraisal_status_edit->terminate();
?>