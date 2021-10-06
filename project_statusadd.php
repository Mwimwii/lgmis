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
$project_status_add = new project_status_add();

// Run the page
$project_status_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$project_status_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fproject_statusadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fproject_statusadd = currentForm = new ew.Form("fproject_statusadd", "add");

	// Validate form
	fproject_statusadd.validate = function() {
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
			<?php if ($project_status_add->ProjectStatusDesc->Required) { ?>
				elm = this.getElements("x" + infix + "_ProjectStatusDesc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_status_add->ProjectStatusDesc->caption(), $project_status_add->ProjectStatusDesc->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($project_status_add->LastUserID->Required) { ?>
				elm = this.getElements("x" + infix + "_LastUserID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_status_add->LastUserID->caption(), $project_status_add->LastUserID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($project_status_add->LastUpdated->Required) { ?>
				elm = this.getElements("x" + infix + "_LastUpdated");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_status_add->LastUpdated->caption(), $project_status_add->LastUpdated->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LastUpdated");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($project_status_add->LastUpdated->errorMessage()) ?>");

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
	fproject_statusadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fproject_statusadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fproject_statusadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $project_status_add->showPageHeader(); ?>
<?php
$project_status_add->showMessage();
?>
<form name="fproject_statusadd" id="fproject_statusadd" class="<?php echo $project_status_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="project_status">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$project_status_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($project_status_add->ProjectStatusDesc->Visible) { // ProjectStatusDesc ?>
	<div id="r_ProjectStatusDesc" class="form-group row">
		<label id="elh_project_status_ProjectStatusDesc" for="x_ProjectStatusDesc" class="<?php echo $project_status_add->LeftColumnClass ?>"><?php echo $project_status_add->ProjectStatusDesc->caption() ?><?php echo $project_status_add->ProjectStatusDesc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $project_status_add->RightColumnClass ?>"><div <?php echo $project_status_add->ProjectStatusDesc->cellAttributes() ?>>
<span id="el_project_status_ProjectStatusDesc">
<input type="text" data-table="project_status" data-field="x_ProjectStatusDesc" name="x_ProjectStatusDesc" id="x_ProjectStatusDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($project_status_add->ProjectStatusDesc->getPlaceHolder()) ?>" value="<?php echo $project_status_add->ProjectStatusDesc->EditValue ?>"<?php echo $project_status_add->ProjectStatusDesc->editAttributes() ?>>
</span>
<?php echo $project_status_add->ProjectStatusDesc->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($project_status_add->LastUserID->Visible) { // LastUserID ?>
	<div id="r_LastUserID" class="form-group row">
		<label id="elh_project_status_LastUserID" for="x_LastUserID" class="<?php echo $project_status_add->LeftColumnClass ?>"><?php echo $project_status_add->LastUserID->caption() ?><?php echo $project_status_add->LastUserID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $project_status_add->RightColumnClass ?>"><div <?php echo $project_status_add->LastUserID->cellAttributes() ?>>
<span id="el_project_status_LastUserID">
<input type="text" data-table="project_status" data-field="x_LastUserID" name="x_LastUserID" id="x_LastUserID" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($project_status_add->LastUserID->getPlaceHolder()) ?>" value="<?php echo $project_status_add->LastUserID->EditValue ?>"<?php echo $project_status_add->LastUserID->editAttributes() ?>>
</span>
<?php echo $project_status_add->LastUserID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($project_status_add->LastUpdated->Visible) { // LastUpdated ?>
	<div id="r_LastUpdated" class="form-group row">
		<label id="elh_project_status_LastUpdated" for="x_LastUpdated" class="<?php echo $project_status_add->LeftColumnClass ?>"><?php echo $project_status_add->LastUpdated->caption() ?><?php echo $project_status_add->LastUpdated->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $project_status_add->RightColumnClass ?>"><div <?php echo $project_status_add->LastUpdated->cellAttributes() ?>>
<span id="el_project_status_LastUpdated">
<input type="text" data-table="project_status" data-field="x_LastUpdated" name="x_LastUpdated" id="x_LastUpdated" placeholder="<?php echo HtmlEncode($project_status_add->LastUpdated->getPlaceHolder()) ?>" value="<?php echo $project_status_add->LastUpdated->EditValue ?>"<?php echo $project_status_add->LastUpdated->editAttributes() ?>>
</span>
<?php echo $project_status_add->LastUpdated->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$project_status_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $project_status_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $project_status_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$project_status_add->showPageFooter();
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
$project_status_add->terminate();
?>