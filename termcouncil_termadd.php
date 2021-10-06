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
$termcouncil_term_add = new termcouncil_term_add();

// Run the page
$termcouncil_term_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$termcouncil_term_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftermcouncil_termadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	ftermcouncil_termadd = currentForm = new ew.Form("ftermcouncil_termadd", "add");

	// Validate form
	ftermcouncil_termadd.validate = function() {
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
			<?php if ($termcouncil_term_add->TermStartYear->Required) { ?>
				elm = this.getElements("x" + infix + "_TermStartYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $termcouncil_term_add->TermStartYear->caption(), $termcouncil_term_add->TermStartYear->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_TermStartYear");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($termcouncil_term_add->TermStartYear->errorMessage()) ?>");
			<?php if ($termcouncil_term_add->TermYears->Required) { ?>
				elm = this.getElements("x" + infix + "_TermYears");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $termcouncil_term_add->TermYears->caption(), $termcouncil_term_add->TermYears->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_TermYears");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($termcouncil_term_add->TermYears->errorMessage()) ?>");

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
	ftermcouncil_termadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ftermcouncil_termadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("ftermcouncil_termadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $termcouncil_term_add->showPageHeader(); ?>
<?php
$termcouncil_term_add->showMessage();
?>
<form name="ftermcouncil_termadd" id="ftermcouncil_termadd" class="<?php echo $termcouncil_term_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="termcouncil_term">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$termcouncil_term_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($termcouncil_term_add->TermStartYear->Visible) { // TermStartYear ?>
	<div id="r_TermStartYear" class="form-group row">
		<label id="elh_termcouncil_term_TermStartYear" for="x_TermStartYear" class="<?php echo $termcouncil_term_add->LeftColumnClass ?>"><?php echo $termcouncil_term_add->TermStartYear->caption() ?><?php echo $termcouncil_term_add->TermStartYear->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $termcouncil_term_add->RightColumnClass ?>"><div <?php echo $termcouncil_term_add->TermStartYear->cellAttributes() ?>>
<span id="el_termcouncil_term_TermStartYear">
<input type="text" data-table="termcouncil_term" data-field="x_TermStartYear" name="x_TermStartYear" id="x_TermStartYear" size="30" placeholder="<?php echo HtmlEncode($termcouncil_term_add->TermStartYear->getPlaceHolder()) ?>" value="<?php echo $termcouncil_term_add->TermStartYear->EditValue ?>"<?php echo $termcouncil_term_add->TermStartYear->editAttributes() ?>>
</span>
<?php echo $termcouncil_term_add->TermStartYear->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($termcouncil_term_add->TermYears->Visible) { // TermYears ?>
	<div id="r_TermYears" class="form-group row">
		<label id="elh_termcouncil_term_TermYears" for="x_TermYears" class="<?php echo $termcouncil_term_add->LeftColumnClass ?>"><?php echo $termcouncil_term_add->TermYears->caption() ?><?php echo $termcouncil_term_add->TermYears->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $termcouncil_term_add->RightColumnClass ?>"><div <?php echo $termcouncil_term_add->TermYears->cellAttributes() ?>>
<span id="el_termcouncil_term_TermYears">
<input type="text" data-table="termcouncil_term" data-field="x_TermYears" name="x_TermYears" id="x_TermYears" size="30" placeholder="<?php echo HtmlEncode($termcouncil_term_add->TermYears->getPlaceHolder()) ?>" value="<?php echo $termcouncil_term_add->TermYears->EditValue ?>"<?php echo $termcouncil_term_add->TermYears->editAttributes() ?>>
</span>
<?php echo $termcouncil_term_add->TermYears->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$termcouncil_term_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $termcouncil_term_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $termcouncil_term_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$termcouncil_term_add->showPageFooter();
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
$termcouncil_term_add->terminate();
?>