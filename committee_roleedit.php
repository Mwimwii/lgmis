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
$committee_role_edit = new committee_role_edit();

// Run the page
$committee_role_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$committee_role_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcommittee_roleedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fcommittee_roleedit = currentForm = new ew.Form("fcommittee_roleedit", "edit");

	// Validate form
	fcommittee_roleedit.validate = function() {
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
			<?php if ($committee_role_edit->CommitteeRole->Required) { ?>
				elm = this.getElements("x" + infix + "_CommitteeRole");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $committee_role_edit->CommitteeRole->caption(), $committee_role_edit->CommitteeRole->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($committee_role_edit->CommitteeRoleDesc->Required) { ?>
				elm = this.getElements("x" + infix + "_CommitteeRoleDesc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $committee_role_edit->CommitteeRoleDesc->caption(), $committee_role_edit->CommitteeRoleDesc->RequiredErrorMessage)) ?>");
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
	fcommittee_roleedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcommittee_roleedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fcommittee_roleedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $committee_role_edit->showPageHeader(); ?>
<?php
$committee_role_edit->showMessage();
?>
<?php if (!$committee_role_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $committee_role_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fcommittee_roleedit" id="fcommittee_roleedit" class="<?php echo $committee_role_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="committee_role">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$committee_role_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($committee_role_edit->CommitteeRole->Visible) { // CommitteeRole ?>
	<div id="r_CommitteeRole" class="form-group row">
		<label id="elh_committee_role_CommitteeRole" class="<?php echo $committee_role_edit->LeftColumnClass ?>"><?php echo $committee_role_edit->CommitteeRole->caption() ?><?php echo $committee_role_edit->CommitteeRole->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $committee_role_edit->RightColumnClass ?>"><div <?php echo $committee_role_edit->CommitteeRole->cellAttributes() ?>>
<span id="el_committee_role_CommitteeRole">
<span<?php echo $committee_role_edit->CommitteeRole->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($committee_role_edit->CommitteeRole->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="committee_role" data-field="x_CommitteeRole" name="x_CommitteeRole" id="x_CommitteeRole" value="<?php echo HtmlEncode($committee_role_edit->CommitteeRole->CurrentValue) ?>">
<?php echo $committee_role_edit->CommitteeRole->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($committee_role_edit->CommitteeRoleDesc->Visible) { // CommitteeRoleDesc ?>
	<div id="r_CommitteeRoleDesc" class="form-group row">
		<label id="elh_committee_role_CommitteeRoleDesc" for="x_CommitteeRoleDesc" class="<?php echo $committee_role_edit->LeftColumnClass ?>"><?php echo $committee_role_edit->CommitteeRoleDesc->caption() ?><?php echo $committee_role_edit->CommitteeRoleDesc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $committee_role_edit->RightColumnClass ?>"><div <?php echo $committee_role_edit->CommitteeRoleDesc->cellAttributes() ?>>
<span id="el_committee_role_CommitteeRoleDesc">
<input type="text" data-table="committee_role" data-field="x_CommitteeRoleDesc" name="x_CommitteeRoleDesc" id="x_CommitteeRoleDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($committee_role_edit->CommitteeRoleDesc->getPlaceHolder()) ?>" value="<?php echo $committee_role_edit->CommitteeRoleDesc->EditValue ?>"<?php echo $committee_role_edit->CommitteeRoleDesc->editAttributes() ?>>
</span>
<?php echo $committee_role_edit->CommitteeRoleDesc->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$committee_role_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $committee_role_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $committee_role_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$committee_role_edit->IsModal) { ?>
<?php echo $committee_role_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$committee_role_edit->showPageFooter();
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
$committee_role_edit->terminate();
?>