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
$position_councillor_edit = new position_councillor_edit();

// Run the page
$position_councillor_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$position_councillor_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fposition_councilloredit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fposition_councilloredit = currentForm = new ew.Form("fposition_councilloredit", "edit");

	// Validate form
	fposition_councilloredit.validate = function() {
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
			<?php if ($position_councillor_edit->PositionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_PositionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $position_councillor_edit->PositionCode->caption(), $position_councillor_edit->PositionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($position_councillor_edit->PositionName->Required) { ?>
				elm = this.getElements("x" + infix + "_PositionName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $position_councillor_edit->PositionName->caption(), $position_councillor_edit->PositionName->RequiredErrorMessage)) ?>");
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
	fposition_councilloredit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fposition_councilloredit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fposition_councilloredit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $position_councillor_edit->showPageHeader(); ?>
<?php
$position_councillor_edit->showMessage();
?>
<?php if (!$position_councillor_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $position_councillor_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fposition_councilloredit" id="fposition_councilloredit" class="<?php echo $position_councillor_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="position_councillor">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$position_councillor_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($position_councillor_edit->PositionCode->Visible) { // PositionCode ?>
	<div id="r_PositionCode" class="form-group row">
		<label id="elh_position_councillor_PositionCode" class="<?php echo $position_councillor_edit->LeftColumnClass ?>"><?php echo $position_councillor_edit->PositionCode->caption() ?><?php echo $position_councillor_edit->PositionCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $position_councillor_edit->RightColumnClass ?>"><div <?php echo $position_councillor_edit->PositionCode->cellAttributes() ?>>
<span id="el_position_councillor_PositionCode">
<span<?php echo $position_councillor_edit->PositionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($position_councillor_edit->PositionCode->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="position_councillor" data-field="x_PositionCode" name="x_PositionCode" id="x_PositionCode" value="<?php echo HtmlEncode($position_councillor_edit->PositionCode->CurrentValue) ?>">
<?php echo $position_councillor_edit->PositionCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($position_councillor_edit->PositionName->Visible) { // PositionName ?>
	<div id="r_PositionName" class="form-group row">
		<label id="elh_position_councillor_PositionName" for="x_PositionName" class="<?php echo $position_councillor_edit->LeftColumnClass ?>"><?php echo $position_councillor_edit->PositionName->caption() ?><?php echo $position_councillor_edit->PositionName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $position_councillor_edit->RightColumnClass ?>"><div <?php echo $position_councillor_edit->PositionName->cellAttributes() ?>>
<span id="el_position_councillor_PositionName">
<input type="text" data-table="position_councillor" data-field="x_PositionName" name="x_PositionName" id="x_PositionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($position_councillor_edit->PositionName->getPlaceHolder()) ?>" value="<?php echo $position_councillor_edit->PositionName->EditValue ?>"<?php echo $position_councillor_edit->PositionName->editAttributes() ?>>
</span>
<?php echo $position_councillor_edit->PositionName->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$position_councillor_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $position_councillor_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $position_councillor_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$position_councillor_edit->IsModal) { ?>
<?php echo $position_councillor_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$position_councillor_edit->showPageFooter();
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
$position_councillor_edit->terminate();
?>