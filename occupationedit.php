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
$occupation_edit = new occupation_edit();

// Run the page
$occupation_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$occupation_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var foccupationedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	foccupationedit = currentForm = new ew.Form("foccupationedit", "edit");

	// Validate form
	foccupationedit.validate = function() {
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
			<?php if ($occupation_edit->OccupationCode->Required) { ?>
				elm = this.getElements("x" + infix + "_OccupationCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $occupation_edit->OccupationCode->caption(), $occupation_edit->OccupationCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($occupation_edit->OccupationName->Required) { ?>
				elm = this.getElements("x" + infix + "_OccupationName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $occupation_edit->OccupationName->caption(), $occupation_edit->OccupationName->RequiredErrorMessage)) ?>");
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
	foccupationedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	foccupationedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("foccupationedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $occupation_edit->showPageHeader(); ?>
<?php
$occupation_edit->showMessage();
?>
<?php if (!$occupation_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $occupation_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="foccupationedit" id="foccupationedit" class="<?php echo $occupation_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="occupation">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$occupation_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($occupation_edit->OccupationCode->Visible) { // OccupationCode ?>
	<div id="r_OccupationCode" class="form-group row">
		<label id="elh_occupation_OccupationCode" class="<?php echo $occupation_edit->LeftColumnClass ?>"><?php echo $occupation_edit->OccupationCode->caption() ?><?php echo $occupation_edit->OccupationCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $occupation_edit->RightColumnClass ?>"><div <?php echo $occupation_edit->OccupationCode->cellAttributes() ?>>
<span id="el_occupation_OccupationCode">
<span<?php echo $occupation_edit->OccupationCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($occupation_edit->OccupationCode->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="occupation" data-field="x_OccupationCode" name="x_OccupationCode" id="x_OccupationCode" value="<?php echo HtmlEncode($occupation_edit->OccupationCode->CurrentValue) ?>">
<?php echo $occupation_edit->OccupationCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($occupation_edit->OccupationName->Visible) { // OccupationName ?>
	<div id="r_OccupationName" class="form-group row">
		<label id="elh_occupation_OccupationName" for="x_OccupationName" class="<?php echo $occupation_edit->LeftColumnClass ?>"><?php echo $occupation_edit->OccupationName->caption() ?><?php echo $occupation_edit->OccupationName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $occupation_edit->RightColumnClass ?>"><div <?php echo $occupation_edit->OccupationName->cellAttributes() ?>>
<span id="el_occupation_OccupationName">
<input type="text" data-table="occupation" data-field="x_OccupationName" name="x_OccupationName" id="x_OccupationName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($occupation_edit->OccupationName->getPlaceHolder()) ?>" value="<?php echo $occupation_edit->OccupationName->EditValue ?>"<?php echo $occupation_edit->OccupationName->editAttributes() ?>>
</span>
<?php echo $occupation_edit->OccupationName->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$occupation_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $occupation_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $occupation_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$occupation_edit->IsModal) { ?>
<?php echo $occupation_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$occupation_edit->showPageFooter();
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
$occupation_edit->terminate();
?>