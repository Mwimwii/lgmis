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
$appeal_status_edit = new appeal_status_edit();

// Run the page
$appeal_status_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$appeal_status_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fappeal_statusedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fappeal_statusedit = currentForm = new ew.Form("fappeal_statusedit", "edit");

	// Validate form
	fappeal_statusedit.validate = function() {
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
			<?php if ($appeal_status_edit->AppealStatusCode->Required) { ?>
				elm = this.getElements("x" + infix + "_AppealStatusCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $appeal_status_edit->AppealStatusCode->caption(), $appeal_status_edit->AppealStatusCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($appeal_status_edit->AppealStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_AppealStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $appeal_status_edit->AppealStatus->caption(), $appeal_status_edit->AppealStatus->RequiredErrorMessage)) ?>");
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
	fappeal_statusedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fappeal_statusedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fappeal_statusedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $appeal_status_edit->showPageHeader(); ?>
<?php
$appeal_status_edit->showMessage();
?>
<?php if (!$appeal_status_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $appeal_status_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fappeal_statusedit" id="fappeal_statusedit" class="<?php echo $appeal_status_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="appeal_status">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$appeal_status_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($appeal_status_edit->AppealStatusCode->Visible) { // AppealStatusCode ?>
	<div id="r_AppealStatusCode" class="form-group row">
		<label id="elh_appeal_status_AppealStatusCode" class="<?php echo $appeal_status_edit->LeftColumnClass ?>"><?php echo $appeal_status_edit->AppealStatusCode->caption() ?><?php echo $appeal_status_edit->AppealStatusCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $appeal_status_edit->RightColumnClass ?>"><div <?php echo $appeal_status_edit->AppealStatusCode->cellAttributes() ?>>
<span id="el_appeal_status_AppealStatusCode">
<span<?php echo $appeal_status_edit->AppealStatusCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($appeal_status_edit->AppealStatusCode->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="appeal_status" data-field="x_AppealStatusCode" name="x_AppealStatusCode" id="x_AppealStatusCode" value="<?php echo HtmlEncode($appeal_status_edit->AppealStatusCode->CurrentValue) ?>">
<?php echo $appeal_status_edit->AppealStatusCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($appeal_status_edit->AppealStatus->Visible) { // AppealStatus ?>
	<div id="r_AppealStatus" class="form-group row">
		<label id="elh_appeal_status_AppealStatus" for="x_AppealStatus" class="<?php echo $appeal_status_edit->LeftColumnClass ?>"><?php echo $appeal_status_edit->AppealStatus->caption() ?><?php echo $appeal_status_edit->AppealStatus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $appeal_status_edit->RightColumnClass ?>"><div <?php echo $appeal_status_edit->AppealStatus->cellAttributes() ?>>
<span id="el_appeal_status_AppealStatus">
<input type="text" data-table="appeal_status" data-field="x_AppealStatus" name="x_AppealStatus" id="x_AppealStatus" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($appeal_status_edit->AppealStatus->getPlaceHolder()) ?>" value="<?php echo $appeal_status_edit->AppealStatus->EditValue ?>"<?php echo $appeal_status_edit->AppealStatus->editAttributes() ?>>
</span>
<?php echo $appeal_status_edit->AppealStatus->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$appeal_status_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $appeal_status_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $appeal_status_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$appeal_status_edit->IsModal) { ?>
<?php echo $appeal_status_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$appeal_status_edit->showPageFooter();
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
$appeal_status_edit->terminate();
?>