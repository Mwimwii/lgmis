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
$category_add = new category_add();

// Run the page
$category_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$category_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcategoryadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fcategoryadd = currentForm = new ew.Form("fcategoryadd", "add");

	// Validate form
	fcategoryadd.validate = function() {
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
			<?php if ($category_add->CategoryCode->Required) { ?>
				elm = this.getElements("x" + infix + "_CategoryCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $category_add->CategoryCode->caption(), $category_add->CategoryCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_CategoryCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($category_add->CategoryCode->errorMessage()) ?>");
			<?php if ($category_add->CategoryName->Required) { ?>
				elm = this.getElements("x" + infix + "_CategoryName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $category_add->CategoryName->caption(), $category_add->CategoryName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($category_add->CategoryDesc->Required) { ?>
				elm = this.getElements("x" + infix + "_CategoryDesc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $category_add->CategoryDesc->caption(), $category_add->CategoryDesc->RequiredErrorMessage)) ?>");
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
	fcategoryadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcategoryadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fcategoryadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $category_add->showPageHeader(); ?>
<?php
$category_add->showMessage();
?>
<form name="fcategoryadd" id="fcategoryadd" class="<?php echo $category_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="category">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$category_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($category_add->CategoryCode->Visible) { // CategoryCode ?>
	<div id="r_CategoryCode" class="form-group row">
		<label id="elh_category_CategoryCode" for="x_CategoryCode" class="<?php echo $category_add->LeftColumnClass ?>"><?php echo $category_add->CategoryCode->caption() ?><?php echo $category_add->CategoryCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $category_add->RightColumnClass ?>"><div <?php echo $category_add->CategoryCode->cellAttributes() ?>>
<span id="el_category_CategoryCode">
<input type="text" data-table="category" data-field="x_CategoryCode" name="x_CategoryCode" id="x_CategoryCode" placeholder="<?php echo HtmlEncode($category_add->CategoryCode->getPlaceHolder()) ?>" value="<?php echo $category_add->CategoryCode->EditValue ?>"<?php echo $category_add->CategoryCode->editAttributes() ?>>
</span>
<?php echo $category_add->CategoryCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($category_add->CategoryName->Visible) { // CategoryName ?>
	<div id="r_CategoryName" class="form-group row">
		<label id="elh_category_CategoryName" for="x_CategoryName" class="<?php echo $category_add->LeftColumnClass ?>"><?php echo $category_add->CategoryName->caption() ?><?php echo $category_add->CategoryName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $category_add->RightColumnClass ?>"><div <?php echo $category_add->CategoryName->cellAttributes() ?>>
<span id="el_category_CategoryName">
<input type="text" data-table="category" data-field="x_CategoryName" name="x_CategoryName" id="x_CategoryName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($category_add->CategoryName->getPlaceHolder()) ?>" value="<?php echo $category_add->CategoryName->EditValue ?>"<?php echo $category_add->CategoryName->editAttributes() ?>>
</span>
<?php echo $category_add->CategoryName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($category_add->CategoryDesc->Visible) { // CategoryDesc ?>
	<div id="r_CategoryDesc" class="form-group row">
		<label id="elh_category_CategoryDesc" for="x_CategoryDesc" class="<?php echo $category_add->LeftColumnClass ?>"><?php echo $category_add->CategoryDesc->caption() ?><?php echo $category_add->CategoryDesc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $category_add->RightColumnClass ?>"><div <?php echo $category_add->CategoryDesc->cellAttributes() ?>>
<span id="el_category_CategoryDesc">
<input type="text" data-table="category" data-field="x_CategoryDesc" name="x_CategoryDesc" id="x_CategoryDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($category_add->CategoryDesc->getPlaceHolder()) ?>" value="<?php echo $category_add->CategoryDesc->EditValue ?>"<?php echo $category_add->CategoryDesc->editAttributes() ?>>
</span>
<?php echo $category_add->CategoryDesc->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$category_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $category_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $category_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$category_add->showPageFooter();
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
$category_add->terminate();
?>