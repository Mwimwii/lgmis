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
$project_type_edit = new project_type_edit();

// Run the page
$project_type_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$project_type_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fproject_typeedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fproject_typeedit = currentForm = new ew.Form("fproject_typeedit", "edit");

	// Validate form
	fproject_typeedit.validate = function() {
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
			<?php if ($project_type_edit->ProjectType->Required) { ?>
				elm = this.getElements("x" + infix + "_ProjectType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_type_edit->ProjectType->caption(), $project_type_edit->ProjectType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($project_type_edit->ProjectTypeDesc->Required) { ?>
				elm = this.getElements("x" + infix + "_ProjectTypeDesc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_type_edit->ProjectTypeDesc->caption(), $project_type_edit->ProjectTypeDesc->RequiredErrorMessage)) ?>");
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
	fproject_typeedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fproject_typeedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fproject_typeedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $project_type_edit->showPageHeader(); ?>
<?php
$project_type_edit->showMessage();
?>
<?php if (!$project_type_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $project_type_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fproject_typeedit" id="fproject_typeedit" class="<?php echo $project_type_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="project_type">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$project_type_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($project_type_edit->ProjectType->Visible) { // ProjectType ?>
	<div id="r_ProjectType" class="form-group row">
		<label id="elh_project_type_ProjectType" class="<?php echo $project_type_edit->LeftColumnClass ?>"><?php echo $project_type_edit->ProjectType->caption() ?><?php echo $project_type_edit->ProjectType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $project_type_edit->RightColumnClass ?>"><div <?php echo $project_type_edit->ProjectType->cellAttributes() ?>>
<span id="el_project_type_ProjectType">
<span<?php echo $project_type_edit->ProjectType->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($project_type_edit->ProjectType->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="project_type" data-field="x_ProjectType" name="x_ProjectType" id="x_ProjectType" value="<?php echo HtmlEncode($project_type_edit->ProjectType->CurrentValue) ?>">
<?php echo $project_type_edit->ProjectType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($project_type_edit->ProjectTypeDesc->Visible) { // ProjectTypeDesc ?>
	<div id="r_ProjectTypeDesc" class="form-group row">
		<label id="elh_project_type_ProjectTypeDesc" for="x_ProjectTypeDesc" class="<?php echo $project_type_edit->LeftColumnClass ?>"><?php echo $project_type_edit->ProjectTypeDesc->caption() ?><?php echo $project_type_edit->ProjectTypeDesc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $project_type_edit->RightColumnClass ?>"><div <?php echo $project_type_edit->ProjectTypeDesc->cellAttributes() ?>>
<span id="el_project_type_ProjectTypeDesc">
<input type="text" data-table="project_type" data-field="x_ProjectTypeDesc" name="x_ProjectTypeDesc" id="x_ProjectTypeDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($project_type_edit->ProjectTypeDesc->getPlaceHolder()) ?>" value="<?php echo $project_type_edit->ProjectTypeDesc->EditValue ?>"<?php echo $project_type_edit->ProjectTypeDesc->editAttributes() ?>>
</span>
<?php echo $project_type_edit->ProjectTypeDesc->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$project_type_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $project_type_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $project_type_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$project_type_edit->IsModal) { ?>
<?php echo $project_type_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$project_type_edit->showPageFooter();
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
$project_type_edit->terminate();
?>