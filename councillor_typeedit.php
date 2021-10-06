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
$councillor_type_edit = new councillor_type_edit();

// Run the page
$councillor_type_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$councillor_type_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcouncillor_typeedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fcouncillor_typeedit = currentForm = new ew.Form("fcouncillor_typeedit", "edit");

	// Validate form
	fcouncillor_typeedit.validate = function() {
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
			<?php if ($councillor_type_edit->CouncillorType->Required) { ?>
				elm = this.getElements("x" + infix + "_CouncillorType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillor_type_edit->CouncillorType->caption(), $councillor_type_edit->CouncillorType->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_CouncillorType");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($councillor_type_edit->CouncillorType->errorMessage()) ?>");
			<?php if ($councillor_type_edit->CouncillorTYpeName->Required) { ?>
				elm = this.getElements("x" + infix + "_CouncillorTYpeName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillor_type_edit->CouncillorTYpeName->caption(), $councillor_type_edit->CouncillorTYpeName->RequiredErrorMessage)) ?>");
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
	fcouncillor_typeedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcouncillor_typeedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fcouncillor_typeedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $councillor_type_edit->showPageHeader(); ?>
<?php
$councillor_type_edit->showMessage();
?>
<?php if (!$councillor_type_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $councillor_type_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fcouncillor_typeedit" id="fcouncillor_typeedit" class="<?php echo $councillor_type_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="councillor_type">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$councillor_type_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($councillor_type_edit->CouncillorType->Visible) { // CouncillorType ?>
	<div id="r_CouncillorType" class="form-group row">
		<label id="elh_councillor_type_CouncillorType" for="x_CouncillorType" class="<?php echo $councillor_type_edit->LeftColumnClass ?>"><?php echo $councillor_type_edit->CouncillorType->caption() ?><?php echo $councillor_type_edit->CouncillorType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillor_type_edit->RightColumnClass ?>"><div <?php echo $councillor_type_edit->CouncillorType->cellAttributes() ?>>
<input type="text" data-table="councillor_type" data-field="x_CouncillorType" name="x_CouncillorType" id="x_CouncillorType" size="30" placeholder="<?php echo HtmlEncode($councillor_type_edit->CouncillorType->getPlaceHolder()) ?>" value="<?php echo $councillor_type_edit->CouncillorType->EditValue ?>"<?php echo $councillor_type_edit->CouncillorType->editAttributes() ?>>
<input type="hidden" data-table="councillor_type" data-field="x_CouncillorType" name="o_CouncillorType" id="o_CouncillorType" value="<?php echo HtmlEncode($councillor_type_edit->CouncillorType->OldValue != null ? $councillor_type_edit->CouncillorType->OldValue : $councillor_type_edit->CouncillorType->CurrentValue) ?>">
<?php echo $councillor_type_edit->CouncillorType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillor_type_edit->CouncillorTYpeName->Visible) { // CouncillorTYpeName ?>
	<div id="r_CouncillorTYpeName" class="form-group row">
		<label id="elh_councillor_type_CouncillorTYpeName" for="x_CouncillorTYpeName" class="<?php echo $councillor_type_edit->LeftColumnClass ?>"><?php echo $councillor_type_edit->CouncillorTYpeName->caption() ?><?php echo $councillor_type_edit->CouncillorTYpeName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillor_type_edit->RightColumnClass ?>"><div <?php echo $councillor_type_edit->CouncillorTYpeName->cellAttributes() ?>>
<span id="el_councillor_type_CouncillorTYpeName">
<input type="text" data-table="councillor_type" data-field="x_CouncillorTYpeName" name="x_CouncillorTYpeName" id="x_CouncillorTYpeName" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($councillor_type_edit->CouncillorTYpeName->getPlaceHolder()) ?>" value="<?php echo $councillor_type_edit->CouncillorTYpeName->EditValue ?>"<?php echo $councillor_type_edit->CouncillorTYpeName->editAttributes() ?>>
</span>
<?php echo $councillor_type_edit->CouncillorTYpeName->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$councillor_type_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $councillor_type_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $councillor_type_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$councillor_type_edit->IsModal) { ?>
<?php echo $councillor_type_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$councillor_type_edit->showPageFooter();
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
$councillor_type_edit->terminate();
?>