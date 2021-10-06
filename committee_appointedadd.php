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
$committee_appointed_add = new committee_appointed_add();

// Run the page
$committee_appointed_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$committee_appointed_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcommittee_appointedadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fcommittee_appointedadd = currentForm = new ew.Form("fcommittee_appointedadd", "add");

	// Validate form
	fcommittee_appointedadd.validate = function() {
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
			<?php if ($committee_appointed_add->CommitteCode->Required) { ?>
				elm = this.getElements("x" + infix + "_CommitteCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $committee_appointed_add->CommitteCode->caption(), $committee_appointed_add->CommitteCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($committee_appointed_add->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $committee_appointed_add->EmployeeID->caption(), $committee_appointed_add->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($committee_appointed_add->EmployeeID->errorMessage()) ?>");
			<?php if ($committee_appointed_add->CommitteeRole->Required) { ?>
				elm = this.getElements("x" + infix + "_CommitteeRole");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $committee_appointed_add->CommitteeRole->caption(), $committee_appointed_add->CommitteeRole->RequiredErrorMessage)) ?>");
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
	fcommittee_appointedadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcommittee_appointedadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fcommittee_appointedadd.lists["x_CommitteCode"] = <?php echo $committee_appointed_add->CommitteCode->Lookup->toClientList($committee_appointed_add) ?>;
	fcommittee_appointedadd.lists["x_CommitteCode"].options = <?php echo JsonEncode($committee_appointed_add->CommitteCode->lookupOptions()) ?>;
	fcommittee_appointedadd.lists["x_CommitteeRole"] = <?php echo $committee_appointed_add->CommitteeRole->Lookup->toClientList($committee_appointed_add) ?>;
	fcommittee_appointedadd.lists["x_CommitteeRole"].options = <?php echo JsonEncode($committee_appointed_add->CommitteeRole->lookupOptions()) ?>;
	loadjs.done("fcommittee_appointedadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $committee_appointed_add->showPageHeader(); ?>
<?php
$committee_appointed_add->showMessage();
?>
<form name="fcommittee_appointedadd" id="fcommittee_appointedadd" class="<?php echo $committee_appointed_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="committee_appointed">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$committee_appointed_add->IsModal ?>">
<?php if ($committee_appointed->getCurrentMasterTable() == "councillorship") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="councillorship">
<input type="hidden" name="fk_EmployeeID" value="<?php echo HtmlEncode($committee_appointed_add->EmployeeID->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($committee_appointed_add->CommitteCode->Visible) { // CommitteCode ?>
	<div id="r_CommitteCode" class="form-group row">
		<label id="elh_committee_appointed_CommitteCode" for="x_CommitteCode" class="<?php echo $committee_appointed_add->LeftColumnClass ?>"><?php echo $committee_appointed_add->CommitteCode->caption() ?><?php echo $committee_appointed_add->CommitteCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $committee_appointed_add->RightColumnClass ?>"><div <?php echo $committee_appointed_add->CommitteCode->cellAttributes() ?>>
<span id="el_committee_appointed_CommitteCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="committee_appointed" data-field="x_CommitteCode" data-value-separator="<?php echo $committee_appointed_add->CommitteCode->displayValueSeparatorAttribute() ?>" id="x_CommitteCode" name="x_CommitteCode"<?php echo $committee_appointed_add->CommitteCode->editAttributes() ?>>
			<?php echo $committee_appointed_add->CommitteCode->selectOptionListHtml("x_CommitteCode") ?>
		</select>
</div>
<?php echo $committee_appointed_add->CommitteCode->Lookup->getParamTag($committee_appointed_add, "p_x_CommitteCode") ?>
</span>
<?php echo $committee_appointed_add->CommitteCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($committee_appointed_add->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label id="elh_committee_appointed_EmployeeID" for="x_EmployeeID" class="<?php echo $committee_appointed_add->LeftColumnClass ?>"><?php echo $committee_appointed_add->EmployeeID->caption() ?><?php echo $committee_appointed_add->EmployeeID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $committee_appointed_add->RightColumnClass ?>"><div <?php echo $committee_appointed_add->EmployeeID->cellAttributes() ?>>
<?php if ($committee_appointed_add->EmployeeID->getSessionValue() != "") { ?>
<span id="el_committee_appointed_EmployeeID">
<span<?php echo $committee_appointed_add->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($committee_appointed_add->EmployeeID->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_EmployeeID" name="x_EmployeeID" value="<?php echo HtmlEncode($committee_appointed_add->EmployeeID->CurrentValue) ?>">
<?php } else { ?>
<span id="el_committee_appointed_EmployeeID">
<input type="text" data-table="committee_appointed" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($committee_appointed_add->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $committee_appointed_add->EmployeeID->EditValue ?>"<?php echo $committee_appointed_add->EmployeeID->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $committee_appointed_add->EmployeeID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($committee_appointed_add->CommitteeRole->Visible) { // CommitteeRole ?>
	<div id="r_CommitteeRole" class="form-group row">
		<label id="elh_committee_appointed_CommitteeRole" for="x_CommitteeRole" class="<?php echo $committee_appointed_add->LeftColumnClass ?>"><?php echo $committee_appointed_add->CommitteeRole->caption() ?><?php echo $committee_appointed_add->CommitteeRole->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $committee_appointed_add->RightColumnClass ?>"><div <?php echo $committee_appointed_add->CommitteeRole->cellAttributes() ?>>
<span id="el_committee_appointed_CommitteeRole">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="committee_appointed" data-field="x_CommitteeRole" data-value-separator="<?php echo $committee_appointed_add->CommitteeRole->displayValueSeparatorAttribute() ?>" id="x_CommitteeRole" name="x_CommitteeRole"<?php echo $committee_appointed_add->CommitteeRole->editAttributes() ?>>
			<?php echo $committee_appointed_add->CommitteeRole->selectOptionListHtml("x_CommitteeRole") ?>
		</select>
</div>
<?php echo $committee_appointed_add->CommitteeRole->Lookup->getParamTag($committee_appointed_add, "p_x_CommitteeRole") ?>
</span>
<?php echo $committee_appointed_add->CommitteeRole->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$committee_appointed_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $committee_appointed_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $committee_appointed_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$committee_appointed_add->showPageFooter();
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
$committee_appointed_add->terminate();
?>