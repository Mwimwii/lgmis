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
$committee_appointed_edit = new committee_appointed_edit();

// Run the page
$committee_appointed_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$committee_appointed_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcommittee_appointededit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fcommittee_appointededit = currentForm = new ew.Form("fcommittee_appointededit", "edit");

	// Validate form
	fcommittee_appointededit.validate = function() {
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
			<?php if ($committee_appointed_edit->CommitteCode->Required) { ?>
				elm = this.getElements("x" + infix + "_CommitteCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $committee_appointed_edit->CommitteCode->caption(), $committee_appointed_edit->CommitteCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($committee_appointed_edit->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $committee_appointed_edit->EmployeeID->caption(), $committee_appointed_edit->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($committee_appointed_edit->EmployeeID->errorMessage()) ?>");
			<?php if ($committee_appointed_edit->CommitteeRole->Required) { ?>
				elm = this.getElements("x" + infix + "_CommitteeRole");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $committee_appointed_edit->CommitteeRole->caption(), $committee_appointed_edit->CommitteeRole->RequiredErrorMessage)) ?>");
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
	fcommittee_appointededit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcommittee_appointededit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fcommittee_appointededit.lists["x_CommitteCode"] = <?php echo $committee_appointed_edit->CommitteCode->Lookup->toClientList($committee_appointed_edit) ?>;
	fcommittee_appointededit.lists["x_CommitteCode"].options = <?php echo JsonEncode($committee_appointed_edit->CommitteCode->lookupOptions()) ?>;
	fcommittee_appointededit.lists["x_CommitteeRole"] = <?php echo $committee_appointed_edit->CommitteeRole->Lookup->toClientList($committee_appointed_edit) ?>;
	fcommittee_appointededit.lists["x_CommitteeRole"].options = <?php echo JsonEncode($committee_appointed_edit->CommitteeRole->lookupOptions()) ?>;
	loadjs.done("fcommittee_appointededit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $committee_appointed_edit->showPageHeader(); ?>
<?php
$committee_appointed_edit->showMessage();
?>
<?php if (!$committee_appointed_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $committee_appointed_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fcommittee_appointededit" id="fcommittee_appointededit" class="<?php echo $committee_appointed_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="committee_appointed">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$committee_appointed_edit->IsModal ?>">
<?php if ($committee_appointed->getCurrentMasterTable() == "councillorship") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="councillorship">
<input type="hidden" name="fk_EmployeeID" value="<?php echo HtmlEncode($committee_appointed_edit->EmployeeID->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($committee_appointed_edit->CommitteCode->Visible) { // CommitteCode ?>
	<div id="r_CommitteCode" class="form-group row">
		<label id="elh_committee_appointed_CommitteCode" for="x_CommitteCode" class="<?php echo $committee_appointed_edit->LeftColumnClass ?>"><?php echo $committee_appointed_edit->CommitteCode->caption() ?><?php echo $committee_appointed_edit->CommitteCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $committee_appointed_edit->RightColumnClass ?>"><div <?php echo $committee_appointed_edit->CommitteCode->cellAttributes() ?>>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="committee_appointed" data-field="x_CommitteCode" data-value-separator="<?php echo $committee_appointed_edit->CommitteCode->displayValueSeparatorAttribute() ?>" id="x_CommitteCode" name="x_CommitteCode"<?php echo $committee_appointed_edit->CommitteCode->editAttributes() ?>>
			<?php echo $committee_appointed_edit->CommitteCode->selectOptionListHtml("x_CommitteCode") ?>
		</select>
</div>
<?php echo $committee_appointed_edit->CommitteCode->Lookup->getParamTag($committee_appointed_edit, "p_x_CommitteCode") ?>
<input type="hidden" data-table="committee_appointed" data-field="x_CommitteCode" name="o_CommitteCode" id="o_CommitteCode" value="<?php echo HtmlEncode($committee_appointed_edit->CommitteCode->OldValue != null ? $committee_appointed_edit->CommitteCode->OldValue : $committee_appointed_edit->CommitteCode->CurrentValue) ?>">
<?php echo $committee_appointed_edit->CommitteCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($committee_appointed_edit->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label id="elh_committee_appointed_EmployeeID" for="x_EmployeeID" class="<?php echo $committee_appointed_edit->LeftColumnClass ?>"><?php echo $committee_appointed_edit->EmployeeID->caption() ?><?php echo $committee_appointed_edit->EmployeeID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $committee_appointed_edit->RightColumnClass ?>"><div <?php echo $committee_appointed_edit->EmployeeID->cellAttributes() ?>>
<?php if ($committee_appointed_edit->EmployeeID->getSessionValue() != "") { ?>

<span id="el_committee_appointed_EmployeeID">
<span<?php echo $committee_appointed_edit->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($committee_appointed_edit->EmployeeID->EditValue)) ?>"></span>
</span>

<input type="hidden" id="x_EmployeeID" name="x_EmployeeID" value="<?php echo HtmlEncode($committee_appointed_edit->EmployeeID->CurrentValue) ?>">
<?php } else { ?>

<input type="text" data-table="committee_appointed" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($committee_appointed_edit->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $committee_appointed_edit->EmployeeID->EditValue ?>"<?php echo $committee_appointed_edit->EmployeeID->editAttributes() ?>>

<?php } ?>

<input type="hidden" data-table="committee_appointed" data-field="x_EmployeeID" name="o_EmployeeID" id="o_EmployeeID" value="<?php echo HtmlEncode($committee_appointed_edit->EmployeeID->OldValue != null ? $committee_appointed_edit->EmployeeID->OldValue : $committee_appointed_edit->EmployeeID->CurrentValue) ?>">
<?php echo $committee_appointed_edit->EmployeeID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($committee_appointed_edit->CommitteeRole->Visible) { // CommitteeRole ?>
	<div id="r_CommitteeRole" class="form-group row">
		<label id="elh_committee_appointed_CommitteeRole" for="x_CommitteeRole" class="<?php echo $committee_appointed_edit->LeftColumnClass ?>"><?php echo $committee_appointed_edit->CommitteeRole->caption() ?><?php echo $committee_appointed_edit->CommitteeRole->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $committee_appointed_edit->RightColumnClass ?>"><div <?php echo $committee_appointed_edit->CommitteeRole->cellAttributes() ?>>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="committee_appointed" data-field="x_CommitteeRole" data-value-separator="<?php echo $committee_appointed_edit->CommitteeRole->displayValueSeparatorAttribute() ?>" id="x_CommitteeRole" name="x_CommitteeRole"<?php echo $committee_appointed_edit->CommitteeRole->editAttributes() ?>>
			<?php echo $committee_appointed_edit->CommitteeRole->selectOptionListHtml("x_CommitteeRole") ?>
		</select>
</div>
<?php echo $committee_appointed_edit->CommitteeRole->Lookup->getParamTag($committee_appointed_edit, "p_x_CommitteeRole") ?>
<input type="hidden" data-table="committee_appointed" data-field="x_CommitteeRole" name="o_CommitteeRole" id="o_CommitteeRole" value="<?php echo HtmlEncode($committee_appointed_edit->CommitteeRole->OldValue != null ? $committee_appointed_edit->CommitteeRole->OldValue : $committee_appointed_edit->CommitteeRole->CurrentValue) ?>">
<?php echo $committee_appointed_edit->CommitteeRole->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$committee_appointed_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $committee_appointed_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $committee_appointed_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$committee_appointed_edit->IsModal) { ?>
<?php echo $committee_appointed_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$committee_appointed_edit->showPageFooter();
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
$committee_appointed_edit->terminate();
?>