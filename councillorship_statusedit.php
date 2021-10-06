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
$councillorship_status_edit = new councillorship_status_edit();

// Run the page
$councillorship_status_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$councillorship_status_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcouncillorship_statusedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fcouncillorship_statusedit = currentForm = new ew.Form("fcouncillorship_statusedit", "edit");

	// Validate form
	fcouncillorship_statusedit.validate = function() {
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
			<?php if ($councillorship_status_edit->CouncillorsipStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_CouncillorsipStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_status_edit->CouncillorsipStatus->caption(), $councillorship_status_edit->CouncillorsipStatus->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillorship_status_edit->CouncillorshipStatusDesc->Required) { ?>
				elm = this.getElements("x" + infix + "_CouncillorshipStatusDesc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_status_edit->CouncillorshipStatusDesc->caption(), $councillorship_status_edit->CouncillorshipStatusDesc->RequiredErrorMessage)) ?>");
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
	fcouncillorship_statusedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcouncillorship_statusedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fcouncillorship_statusedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $councillorship_status_edit->showPageHeader(); ?>
<?php
$councillorship_status_edit->showMessage();
?>
<?php if (!$councillorship_status_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $councillorship_status_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fcouncillorship_statusedit" id="fcouncillorship_statusedit" class="<?php echo $councillorship_status_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="councillorship_status">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$councillorship_status_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($councillorship_status_edit->CouncillorsipStatus->Visible) { // CouncillorsipStatus ?>
	<div id="r_CouncillorsipStatus" class="form-group row">
		<label id="elh_councillorship_status_CouncillorsipStatus" class="<?php echo $councillorship_status_edit->LeftColumnClass ?>"><?php echo $councillorship_status_edit->CouncillorsipStatus->caption() ?><?php echo $councillorship_status_edit->CouncillorsipStatus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillorship_status_edit->RightColumnClass ?>"><div <?php echo $councillorship_status_edit->CouncillorsipStatus->cellAttributes() ?>>
<span id="el_councillorship_status_CouncillorsipStatus">
<span<?php echo $councillorship_status_edit->CouncillorsipStatus->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($councillorship_status_edit->CouncillorsipStatus->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="councillorship_status" data-field="x_CouncillorsipStatus" name="x_CouncillorsipStatus" id="x_CouncillorsipStatus" value="<?php echo HtmlEncode($councillorship_status_edit->CouncillorsipStatus->CurrentValue) ?>">
<?php echo $councillorship_status_edit->CouncillorsipStatus->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillorship_status_edit->CouncillorshipStatusDesc->Visible) { // CouncillorshipStatusDesc ?>
	<div id="r_CouncillorshipStatusDesc" class="form-group row">
		<label id="elh_councillorship_status_CouncillorshipStatusDesc" for="x_CouncillorshipStatusDesc" class="<?php echo $councillorship_status_edit->LeftColumnClass ?>"><?php echo $councillorship_status_edit->CouncillorshipStatusDesc->caption() ?><?php echo $councillorship_status_edit->CouncillorshipStatusDesc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillorship_status_edit->RightColumnClass ?>"><div <?php echo $councillorship_status_edit->CouncillorshipStatusDesc->cellAttributes() ?>>
<span id="el_councillorship_status_CouncillorshipStatusDesc">
<input type="text" data-table="councillorship_status" data-field="x_CouncillorshipStatusDesc" name="x_CouncillorshipStatusDesc" id="x_CouncillorshipStatusDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($councillorship_status_edit->CouncillorshipStatusDesc->getPlaceHolder()) ?>" value="<?php echo $councillorship_status_edit->CouncillorshipStatusDesc->EditValue ?>"<?php echo $councillorship_status_edit->CouncillorshipStatusDesc->editAttributes() ?>>
</span>
<?php echo $councillorship_status_edit->CouncillorshipStatusDesc->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$councillorship_status_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $councillorship_status_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $councillorship_status_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$councillorship_status_edit->IsModal) { ?>
<?php echo $councillorship_status_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$councillorship_status_edit->showPageFooter();
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
$councillorship_status_edit->terminate();
?>