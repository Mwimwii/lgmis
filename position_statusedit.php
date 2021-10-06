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
$position_status_edit = new position_status_edit();

// Run the page
$position_status_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$position_status_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fposition_statusedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fposition_statusedit = currentForm = new ew.Form("fposition_statusedit", "edit");

	// Validate form
	fposition_statusedit.validate = function() {
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
			<?php if ($position_status_edit->PositionStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_PositionStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $position_status_edit->PositionStatus->caption(), $position_status_edit->PositionStatus->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($position_status_edit->PositionStatusDesc->Required) { ?>
				elm = this.getElements("x" + infix + "_PositionStatusDesc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $position_status_edit->PositionStatusDesc->caption(), $position_status_edit->PositionStatusDesc->RequiredErrorMessage)) ?>");
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
	fposition_statusedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fposition_statusedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fposition_statusedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $position_status_edit->showPageHeader(); ?>
<?php
$position_status_edit->showMessage();
?>
<?php if (!$position_status_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $position_status_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fposition_statusedit" id="fposition_statusedit" class="<?php echo $position_status_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="position_status">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$position_status_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($position_status_edit->PositionStatus->Visible) { // PositionStatus ?>
	<div id="r_PositionStatus" class="form-group row">
		<label id="elh_position_status_PositionStatus" class="<?php echo $position_status_edit->LeftColumnClass ?>"><?php echo $position_status_edit->PositionStatus->caption() ?><?php echo $position_status_edit->PositionStatus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $position_status_edit->RightColumnClass ?>"><div <?php echo $position_status_edit->PositionStatus->cellAttributes() ?>>
<span id="el_position_status_PositionStatus">
<span<?php echo $position_status_edit->PositionStatus->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($position_status_edit->PositionStatus->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="position_status" data-field="x_PositionStatus" name="x_PositionStatus" id="x_PositionStatus" value="<?php echo HtmlEncode($position_status_edit->PositionStatus->CurrentValue) ?>">
<?php echo $position_status_edit->PositionStatus->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($position_status_edit->PositionStatusDesc->Visible) { // PositionStatusDesc ?>
	<div id="r_PositionStatusDesc" class="form-group row">
		<label id="elh_position_status_PositionStatusDesc" for="x_PositionStatusDesc" class="<?php echo $position_status_edit->LeftColumnClass ?>"><?php echo $position_status_edit->PositionStatusDesc->caption() ?><?php echo $position_status_edit->PositionStatusDesc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $position_status_edit->RightColumnClass ?>"><div <?php echo $position_status_edit->PositionStatusDesc->cellAttributes() ?>>
<span id="el_position_status_PositionStatusDesc">
<input type="text" data-table="position_status" data-field="x_PositionStatusDesc" name="x_PositionStatusDesc" id="x_PositionStatusDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($position_status_edit->PositionStatusDesc->getPlaceHolder()) ?>" value="<?php echo $position_status_edit->PositionStatusDesc->EditValue ?>"<?php echo $position_status_edit->PositionStatusDesc->editAttributes() ?>>
</span>
<?php echo $position_status_edit->PositionStatusDesc->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$position_status_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $position_status_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $position_status_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$position_status_edit->IsModal) { ?>
<?php echo $position_status_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$position_status_edit->showPageFooter();
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
$position_status_edit->terminate();
?>