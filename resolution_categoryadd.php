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
$resolution_category_add = new resolution_category_add();

// Run the page
$resolution_category_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$resolution_category_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fresolution_categoryadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fresolution_categoryadd = currentForm = new ew.Form("fresolution_categoryadd", "add");

	// Validate form
	fresolution_categoryadd.validate = function() {
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
			<?php if ($resolution_category_add->ResolutionCategoryName->Required) { ?>
				elm = this.getElements("x" + infix + "_ResolutionCategoryName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $resolution_category_add->ResolutionCategoryName->caption(), $resolution_category_add->ResolutionCategoryName->RequiredErrorMessage)) ?>");
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
	fresolution_categoryadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fresolution_categoryadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fresolution_categoryadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $resolution_category_add->showPageHeader(); ?>
<?php
$resolution_category_add->showMessage();
?>
<form name="fresolution_categoryadd" id="fresolution_categoryadd" class="<?php echo $resolution_category_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="resolution_category">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$resolution_category_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($resolution_category_add->ResolutionCategoryName->Visible) { // ResolutionCategoryName ?>
	<div id="r_ResolutionCategoryName" class="form-group row">
		<label id="elh_resolution_category_ResolutionCategoryName" for="x_ResolutionCategoryName" class="<?php echo $resolution_category_add->LeftColumnClass ?>"><?php echo $resolution_category_add->ResolutionCategoryName->caption() ?><?php echo $resolution_category_add->ResolutionCategoryName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $resolution_category_add->RightColumnClass ?>"><div <?php echo $resolution_category_add->ResolutionCategoryName->cellAttributes() ?>>
<span id="el_resolution_category_ResolutionCategoryName">
<input type="text" data-table="resolution_category" data-field="x_ResolutionCategoryName" name="x_ResolutionCategoryName" id="x_ResolutionCategoryName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($resolution_category_add->ResolutionCategoryName->getPlaceHolder()) ?>" value="<?php echo $resolution_category_add->ResolutionCategoryName->EditValue ?>"<?php echo $resolution_category_add->ResolutionCategoryName->editAttributes() ?>>
</span>
<?php echo $resolution_category_add->ResolutionCategoryName->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$resolution_category_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $resolution_category_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $resolution_category_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$resolution_category_add->showPageFooter();
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
$resolution_category_add->terminate();
?>