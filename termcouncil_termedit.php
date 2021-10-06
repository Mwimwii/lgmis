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
$termcouncil_term_edit = new termcouncil_term_edit();

// Run the page
$termcouncil_term_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$termcouncil_term_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftermcouncil_termedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	ftermcouncil_termedit = currentForm = new ew.Form("ftermcouncil_termedit", "edit");

	// Validate form
	ftermcouncil_termedit.validate = function() {
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
			<?php if ($termcouncil_term_edit->TermStartYear->Required) { ?>
				elm = this.getElements("x" + infix + "_TermStartYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $termcouncil_term_edit->TermStartYear->caption(), $termcouncil_term_edit->TermStartYear->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_TermStartYear");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($termcouncil_term_edit->TermStartYear->errorMessage()) ?>");
			<?php if ($termcouncil_term_edit->TermYears->Required) { ?>
				elm = this.getElements("x" + infix + "_TermYears");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $termcouncil_term_edit->TermYears->caption(), $termcouncil_term_edit->TermYears->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_TermYears");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($termcouncil_term_edit->TermYears->errorMessage()) ?>");

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
	ftermcouncil_termedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ftermcouncil_termedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("ftermcouncil_termedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $termcouncil_term_edit->showPageHeader(); ?>
<?php
$termcouncil_term_edit->showMessage();
?>
<?php if (!$termcouncil_term_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $termcouncil_term_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="ftermcouncil_termedit" id="ftermcouncil_termedit" class="<?php echo $termcouncil_term_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="termcouncil_term">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$termcouncil_term_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($termcouncil_term_edit->TermStartYear->Visible) { // TermStartYear ?>
	<div id="r_TermStartYear" class="form-group row">
		<label id="elh_termcouncil_term_TermStartYear" for="x_TermStartYear" class="<?php echo $termcouncil_term_edit->LeftColumnClass ?>"><?php echo $termcouncil_term_edit->TermStartYear->caption() ?><?php echo $termcouncil_term_edit->TermStartYear->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $termcouncil_term_edit->RightColumnClass ?>"><div <?php echo $termcouncil_term_edit->TermStartYear->cellAttributes() ?>>
<input type="text" data-table="termcouncil_term" data-field="x_TermStartYear" name="x_TermStartYear" id="x_TermStartYear" size="30" placeholder="<?php echo HtmlEncode($termcouncil_term_edit->TermStartYear->getPlaceHolder()) ?>" value="<?php echo $termcouncil_term_edit->TermStartYear->EditValue ?>"<?php echo $termcouncil_term_edit->TermStartYear->editAttributes() ?>>
<input type="hidden" data-table="termcouncil_term" data-field="x_TermStartYear" name="o_TermStartYear" id="o_TermStartYear" value="<?php echo HtmlEncode($termcouncil_term_edit->TermStartYear->OldValue != null ? $termcouncil_term_edit->TermStartYear->OldValue : $termcouncil_term_edit->TermStartYear->CurrentValue) ?>">
<?php echo $termcouncil_term_edit->TermStartYear->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($termcouncil_term_edit->TermYears->Visible) { // TermYears ?>
	<div id="r_TermYears" class="form-group row">
		<label id="elh_termcouncil_term_TermYears" for="x_TermYears" class="<?php echo $termcouncil_term_edit->LeftColumnClass ?>"><?php echo $termcouncil_term_edit->TermYears->caption() ?><?php echo $termcouncil_term_edit->TermYears->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $termcouncil_term_edit->RightColumnClass ?>"><div <?php echo $termcouncil_term_edit->TermYears->cellAttributes() ?>>
<span id="el_termcouncil_term_TermYears">
<input type="text" data-table="termcouncil_term" data-field="x_TermYears" name="x_TermYears" id="x_TermYears" size="30" placeholder="<?php echo HtmlEncode($termcouncil_term_edit->TermYears->getPlaceHolder()) ?>" value="<?php echo $termcouncil_term_edit->TermYears->EditValue ?>"<?php echo $termcouncil_term_edit->TermYears->editAttributes() ?>>
</span>
<?php echo $termcouncil_term_edit->TermYears->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$termcouncil_term_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $termcouncil_term_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $termcouncil_term_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$termcouncil_term_edit->IsModal) { ?>
<?php echo $termcouncil_term_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$termcouncil_term_edit->showPageFooter();
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
$termcouncil_term_edit->terminate();
?>