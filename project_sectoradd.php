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
$project_sector_add = new project_sector_add();

// Run the page
$project_sector_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$project_sector_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fproject_sectoradd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fproject_sectoradd = currentForm = new ew.Form("fproject_sectoradd", "add");

	// Validate form
	fproject_sectoradd.validate = function() {
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
			<?php if ($project_sector_add->ProjectSectorDesc->Required) { ?>
				elm = this.getElements("x" + infix + "_ProjectSectorDesc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_sector_add->ProjectSectorDesc->caption(), $project_sector_add->ProjectSectorDesc->RequiredErrorMessage)) ?>");
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
	fproject_sectoradd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fproject_sectoradd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fproject_sectoradd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $project_sector_add->showPageHeader(); ?>
<?php
$project_sector_add->showMessage();
?>
<form name="fproject_sectoradd" id="fproject_sectoradd" class="<?php echo $project_sector_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="project_sector">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$project_sector_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($project_sector_add->ProjectSectorDesc->Visible) { // ProjectSectorDesc ?>
	<div id="r_ProjectSectorDesc" class="form-group row">
		<label id="elh_project_sector_ProjectSectorDesc" for="x_ProjectSectorDesc" class="<?php echo $project_sector_add->LeftColumnClass ?>"><?php echo $project_sector_add->ProjectSectorDesc->caption() ?><?php echo $project_sector_add->ProjectSectorDesc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $project_sector_add->RightColumnClass ?>"><div <?php echo $project_sector_add->ProjectSectorDesc->cellAttributes() ?>>
<span id="el_project_sector_ProjectSectorDesc">
<input type="text" data-table="project_sector" data-field="x_ProjectSectorDesc" name="x_ProjectSectorDesc" id="x_ProjectSectorDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($project_sector_add->ProjectSectorDesc->getPlaceHolder()) ?>" value="<?php echo $project_sector_add->ProjectSectorDesc->EditValue ?>"<?php echo $project_sector_add->ProjectSectorDesc->editAttributes() ?>>
</span>
<?php echo $project_sector_add->ProjectSectorDesc->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$project_sector_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $project_sector_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $project_sector_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$project_sector_add->showPageFooter();
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
$project_sector_add->terminate();
?>