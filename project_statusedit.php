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
$project_status_edit = new project_status_edit();

// Run the page
$project_status_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$project_status_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fproject_statusedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fproject_statusedit = currentForm = new ew.Form("fproject_statusedit", "edit");

	// Validate form
	fproject_statusedit.validate = function() {
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
			<?php if ($project_status_edit->ProjectStatusCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProjectStatusCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_status_edit->ProjectStatusCode->caption(), $project_status_edit->ProjectStatusCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($project_status_edit->ProjectStatusDesc->Required) { ?>
				elm = this.getElements("x" + infix + "_ProjectStatusDesc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_status_edit->ProjectStatusDesc->caption(), $project_status_edit->ProjectStatusDesc->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($project_status_edit->LastUserID->Required) { ?>
				elm = this.getElements("x" + infix + "_LastUserID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_status_edit->LastUserID->caption(), $project_status_edit->LastUserID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($project_status_edit->LastUpdated->Required) { ?>
				elm = this.getElements("x" + infix + "_LastUpdated");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_status_edit->LastUpdated->caption(), $project_status_edit->LastUpdated->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LastUpdated");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($project_status_edit->LastUpdated->errorMessage()) ?>");

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
	fproject_statusedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fproject_statusedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fproject_statusedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $project_status_edit->showPageHeader(); ?>
<?php
$project_status_edit->showMessage();
?>
<?php if (!$project_status_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $project_status_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fproject_statusedit" id="fproject_statusedit" class="<?php echo $project_status_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="project_status">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$project_status_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($project_status_edit->ProjectStatusCode->Visible) { // ProjectStatusCode ?>
	<div id="r_ProjectStatusCode" class="form-group row">
		<label id="elh_project_status_ProjectStatusCode" class="<?php echo $project_status_edit->LeftColumnClass ?>"><?php echo $project_status_edit->ProjectStatusCode->caption() ?><?php echo $project_status_edit->ProjectStatusCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $project_status_edit->RightColumnClass ?>"><div <?php echo $project_status_edit->ProjectStatusCode->cellAttributes() ?>>
<span id="el_project_status_ProjectStatusCode">
<span<?php echo $project_status_edit->ProjectStatusCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($project_status_edit->ProjectStatusCode->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="project_status" data-field="x_ProjectStatusCode" name="x_ProjectStatusCode" id="x_ProjectStatusCode" value="<?php echo HtmlEncode($project_status_edit->ProjectStatusCode->CurrentValue) ?>">
<?php echo $project_status_edit->ProjectStatusCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($project_status_edit->ProjectStatusDesc->Visible) { // ProjectStatusDesc ?>
	<div id="r_ProjectStatusDesc" class="form-group row">
		<label id="elh_project_status_ProjectStatusDesc" for="x_ProjectStatusDesc" class="<?php echo $project_status_edit->LeftColumnClass ?>"><?php echo $project_status_edit->ProjectStatusDesc->caption() ?><?php echo $project_status_edit->ProjectStatusDesc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $project_status_edit->RightColumnClass ?>"><div <?php echo $project_status_edit->ProjectStatusDesc->cellAttributes() ?>>
<span id="el_project_status_ProjectStatusDesc">
<input type="text" data-table="project_status" data-field="x_ProjectStatusDesc" name="x_ProjectStatusDesc" id="x_ProjectStatusDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($project_status_edit->ProjectStatusDesc->getPlaceHolder()) ?>" value="<?php echo $project_status_edit->ProjectStatusDesc->EditValue ?>"<?php echo $project_status_edit->ProjectStatusDesc->editAttributes() ?>>
</span>
<?php echo $project_status_edit->ProjectStatusDesc->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($project_status_edit->LastUserID->Visible) { // LastUserID ?>
	<div id="r_LastUserID" class="form-group row">
		<label id="elh_project_status_LastUserID" for="x_LastUserID" class="<?php echo $project_status_edit->LeftColumnClass ?>"><?php echo $project_status_edit->LastUserID->caption() ?><?php echo $project_status_edit->LastUserID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $project_status_edit->RightColumnClass ?>"><div <?php echo $project_status_edit->LastUserID->cellAttributes() ?>>
<span id="el_project_status_LastUserID">
<input type="text" data-table="project_status" data-field="x_LastUserID" name="x_LastUserID" id="x_LastUserID" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($project_status_edit->LastUserID->getPlaceHolder()) ?>" value="<?php echo $project_status_edit->LastUserID->EditValue ?>"<?php echo $project_status_edit->LastUserID->editAttributes() ?>>
</span>
<?php echo $project_status_edit->LastUserID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($project_status_edit->LastUpdated->Visible) { // LastUpdated ?>
	<div id="r_LastUpdated" class="form-group row">
		<label id="elh_project_status_LastUpdated" for="x_LastUpdated" class="<?php echo $project_status_edit->LeftColumnClass ?>"><?php echo $project_status_edit->LastUpdated->caption() ?><?php echo $project_status_edit->LastUpdated->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $project_status_edit->RightColumnClass ?>"><div <?php echo $project_status_edit->LastUpdated->cellAttributes() ?>>
<span id="el_project_status_LastUpdated">
<input type="text" data-table="project_status" data-field="x_LastUpdated" name="x_LastUpdated" id="x_LastUpdated" placeholder="<?php echo HtmlEncode($project_status_edit->LastUpdated->getPlaceHolder()) ?>" value="<?php echo $project_status_edit->LastUpdated->EditValue ?>"<?php echo $project_status_edit->LastUpdated->editAttributes() ?>>
</span>
<?php echo $project_status_edit->LastUpdated->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$project_status_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $project_status_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $project_status_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$project_status_edit->IsModal) { ?>
<?php echo $project_status_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$project_status_edit->showPageFooter();
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
$project_status_edit->terminate();
?>