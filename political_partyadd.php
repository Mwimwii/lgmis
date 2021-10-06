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
$political_party_add = new political_party_add();

// Run the page
$political_party_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$political_party_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpolitical_partyadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fpolitical_partyadd = currentForm = new ew.Form("fpolitical_partyadd", "add");

	// Validate form
	fpolitical_partyadd.validate = function() {
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
			<?php if ($political_party_add->PoliticalParty->Required) { ?>
				elm = this.getElements("x" + infix + "_PoliticalParty");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $political_party_add->PoliticalParty->caption(), $political_party_add->PoliticalParty->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($political_party_add->Remarks->Required) { ?>
				elm = this.getElements("x" + infix + "_Remarks");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $political_party_add->Remarks->caption(), $political_party_add->Remarks->RequiredErrorMessage)) ?>");
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
	fpolitical_partyadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpolitical_partyadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fpolitical_partyadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $political_party_add->showPageHeader(); ?>
<?php
$political_party_add->showMessage();
?>
<form name="fpolitical_partyadd" id="fpolitical_partyadd" class="<?php echo $political_party_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="political_party">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$political_party_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($political_party_add->PoliticalParty->Visible) { // PoliticalParty ?>
	<div id="r_PoliticalParty" class="form-group row">
		<label id="elh_political_party_PoliticalParty" for="x_PoliticalParty" class="<?php echo $political_party_add->LeftColumnClass ?>"><?php echo $political_party_add->PoliticalParty->caption() ?><?php echo $political_party_add->PoliticalParty->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $political_party_add->RightColumnClass ?>"><div <?php echo $political_party_add->PoliticalParty->cellAttributes() ?>>
<span id="el_political_party_PoliticalParty">
<input type="text" data-table="political_party" data-field="x_PoliticalParty" name="x_PoliticalParty" id="x_PoliticalParty" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($political_party_add->PoliticalParty->getPlaceHolder()) ?>" value="<?php echo $political_party_add->PoliticalParty->EditValue ?>"<?php echo $political_party_add->PoliticalParty->editAttributes() ?>>
</span>
<?php echo $political_party_add->PoliticalParty->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($political_party_add->Remarks->Visible) { // Remarks ?>
	<div id="r_Remarks" class="form-group row">
		<label id="elh_political_party_Remarks" for="x_Remarks" class="<?php echo $political_party_add->LeftColumnClass ?>"><?php echo $political_party_add->Remarks->caption() ?><?php echo $political_party_add->Remarks->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $political_party_add->RightColumnClass ?>"><div <?php echo $political_party_add->Remarks->cellAttributes() ?>>
<span id="el_political_party_Remarks">
<input type="text" data-table="political_party" data-field="x_Remarks" name="x_Remarks" id="x_Remarks" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($political_party_add->Remarks->getPlaceHolder()) ?>" value="<?php echo $political_party_add->Remarks->EditValue ?>"<?php echo $political_party_add->Remarks->editAttributes() ?>>
</span>
<?php echo $political_party_add->Remarks->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$political_party_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $political_party_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $political_party_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$political_party_add->showPageFooter();
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
$political_party_add->terminate();
?>