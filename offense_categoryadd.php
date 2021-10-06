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
$offense_category_add = new offense_category_add();

// Run the page
$offense_category_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$offense_category_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var foffense_categoryadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	foffense_categoryadd = currentForm = new ew.Form("foffense_categoryadd", "add");

	// Validate form
	foffense_categoryadd.validate = function() {
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
			<?php if ($offense_category_add->OffenseCategoryName->Required) { ?>
				elm = this.getElements("x" + infix + "_OffenseCategoryName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $offense_category_add->OffenseCategoryName->caption(), $offense_category_add->OffenseCategoryName->RequiredErrorMessage)) ?>");
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
	foffense_categoryadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	foffense_categoryadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("foffense_categoryadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $offense_category_add->showPageHeader(); ?>
<?php
$offense_category_add->showMessage();
?>
<form name="foffense_categoryadd" id="foffense_categoryadd" class="<?php echo $offense_category_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="offense_category">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$offense_category_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($offense_category_add->OffenseCategoryName->Visible) { // OffenseCategoryName ?>
	<div id="r_OffenseCategoryName" class="form-group row">
		<label id="elh_offense_category_OffenseCategoryName" for="x_OffenseCategoryName" class="<?php echo $offense_category_add->LeftColumnClass ?>"><?php echo $offense_category_add->OffenseCategoryName->caption() ?><?php echo $offense_category_add->OffenseCategoryName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $offense_category_add->RightColumnClass ?>"><div <?php echo $offense_category_add->OffenseCategoryName->cellAttributes() ?>>
<span id="el_offense_category_OffenseCategoryName">
<input type="text" data-table="offense_category" data-field="x_OffenseCategoryName" name="x_OffenseCategoryName" id="x_OffenseCategoryName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($offense_category_add->OffenseCategoryName->getPlaceHolder()) ?>" value="<?php echo $offense_category_add->OffenseCategoryName->EditValue ?>"<?php echo $offense_category_add->OffenseCategoryName->editAttributes() ?>>
</span>
<?php echo $offense_category_add->OffenseCategoryName->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$offense_category_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $offense_category_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $offense_category_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$offense_category_add->showPageFooter();
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
$offense_category_add->terminate();
?>