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
$staffprofbodies_edit = new staffprofbodies_edit();

// Run the page
$staffprofbodies_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$staffprofbodies_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fstaffprofbodiesedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fstaffprofbodiesedit = currentForm = new ew.Form("fstaffprofbodiesedit", "edit");

	// Validate form
	fstaffprofbodiesedit.validate = function() {
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
			<?php if ($staffprofbodies_edit->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffprofbodies_edit->EmployeeID->caption(), $staffprofbodies_edit->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffprofbodies_edit->EmployeeID->errorMessage()) ?>");
			<?php if ($staffprofbodies_edit->ProfessionalBody->Required) { ?>
				elm = this.getElements("x" + infix + "_ProfessionalBody");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffprofbodies_edit->ProfessionalBody->caption(), $staffprofbodies_edit->ProfessionalBody->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffprofbodies_edit->MembershipNo->Required) { ?>
				elm = this.getElements("x" + infix + "_MembershipNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffprofbodies_edit->MembershipNo->caption(), $staffprofbodies_edit->MembershipNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffprofbodies_edit->DateJoined->Required) { ?>
				elm = this.getElements("x" + infix + "_DateJoined");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffprofbodies_edit->DateJoined->caption(), $staffprofbodies_edit->DateJoined->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateJoined");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffprofbodies_edit->DateJoined->errorMessage()) ?>");
			<?php if ($staffprofbodies_edit->DateRenewed->Required) { ?>
				elm = this.getElements("x" + infix + "_DateRenewed");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffprofbodies_edit->DateRenewed->caption(), $staffprofbodies_edit->DateRenewed->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateRenewed");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffprofbodies_edit->DateRenewed->errorMessage()) ?>");
			<?php if ($staffprofbodies_edit->ValidTo->Required) { ?>
				elm = this.getElements("x" + infix + "_ValidTo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffprofbodies_edit->ValidTo->caption(), $staffprofbodies_edit->ValidTo->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ValidTo");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffprofbodies_edit->ValidTo->errorMessage()) ?>");
			<?php if ($staffprofbodies_edit->MemberStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_MemberStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffprofbodies_edit->MemberStatus->caption(), $staffprofbodies_edit->MemberStatus->RequiredErrorMessage)) ?>");
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
	fstaffprofbodiesedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fstaffprofbodiesedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fstaffprofbodiesedit.lists["x_ProfessionalBody"] = <?php echo $staffprofbodies_edit->ProfessionalBody->Lookup->toClientList($staffprofbodies_edit) ?>;
	fstaffprofbodiesedit.lists["x_ProfessionalBody"].options = <?php echo JsonEncode($staffprofbodies_edit->ProfessionalBody->lookupOptions()) ?>;
	fstaffprofbodiesedit.lists["x_MemberStatus"] = <?php echo $staffprofbodies_edit->MemberStatus->Lookup->toClientList($staffprofbodies_edit) ?>;
	fstaffprofbodiesedit.lists["x_MemberStatus"].options = <?php echo JsonEncode($staffprofbodies_edit->MemberStatus->lookupOptions()) ?>;
	loadjs.done("fstaffprofbodiesedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $staffprofbodies_edit->showPageHeader(); ?>
<?php
$staffprofbodies_edit->showMessage();
?>
<?php if (!$staffprofbodies_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $staffprofbodies_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fstaffprofbodiesedit" id="fstaffprofbodiesedit" class="<?php echo $staffprofbodies_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="staffprofbodies">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$staffprofbodies_edit->IsModal ?>">
<?php if ($staffprofbodies->getCurrentMasterTable() == "staff") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="staff">
<input type="hidden" name="fk_EmployeeID" value="<?php echo HtmlEncode($staffprofbodies_edit->EmployeeID->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($staffprofbodies_edit->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label id="elh_staffprofbodies_EmployeeID" for="x_EmployeeID" class="<?php echo $staffprofbodies_edit->LeftColumnClass ?>"><?php echo $staffprofbodies_edit->EmployeeID->caption() ?><?php echo $staffprofbodies_edit->EmployeeID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffprofbodies_edit->RightColumnClass ?>"><div <?php echo $staffprofbodies_edit->EmployeeID->cellAttributes() ?>>
<?php if ($staffprofbodies_edit->EmployeeID->getSessionValue() != "") { ?>

<span id="el_staffprofbodies_EmployeeID">
<span<?php echo $staffprofbodies_edit->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffprofbodies_edit->EmployeeID->EditValue)) ?>"></span>
</span>

<input type="hidden" id="x_EmployeeID" name="x_EmployeeID" value="<?php echo HtmlEncode($staffprofbodies_edit->EmployeeID->CurrentValue) ?>">
<?php } else { ?>

<input type="text" data-table="staffprofbodies" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($staffprofbodies_edit->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $staffprofbodies_edit->EmployeeID->EditValue ?>"<?php echo $staffprofbodies_edit->EmployeeID->editAttributes() ?>>

<?php } ?>

<input type="hidden" data-table="staffprofbodies" data-field="x_EmployeeID" name="o_EmployeeID" id="o_EmployeeID" value="<?php echo HtmlEncode($staffprofbodies_edit->EmployeeID->OldValue != null ? $staffprofbodies_edit->EmployeeID->OldValue : $staffprofbodies_edit->EmployeeID->CurrentValue) ?>">
<?php echo $staffprofbodies_edit->EmployeeID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffprofbodies_edit->ProfessionalBody->Visible) { // ProfessionalBody ?>
	<div id="r_ProfessionalBody" class="form-group row">
		<label id="elh_staffprofbodies_ProfessionalBody" for="x_ProfessionalBody" class="<?php echo $staffprofbodies_edit->LeftColumnClass ?>"><?php echo $staffprofbodies_edit->ProfessionalBody->caption() ?><?php echo $staffprofbodies_edit->ProfessionalBody->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffprofbodies_edit->RightColumnClass ?>"><div <?php echo $staffprofbodies_edit->ProfessionalBody->cellAttributes() ?>>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_ProfessionalBody"><?php echo EmptyValue(strval($staffprofbodies_edit->ProfessionalBody->ViewValue)) ? $Language->phrase("PleaseSelect") : $staffprofbodies_edit->ProfessionalBody->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staffprofbodies_edit->ProfessionalBody->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staffprofbodies_edit->ProfessionalBody->ReadOnly || $staffprofbodies_edit->ProfessionalBody->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_ProfessionalBody',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staffprofbodies_edit->ProfessionalBody->Lookup->getParamTag($staffprofbodies_edit, "p_x_ProfessionalBody") ?>
<input type="hidden" data-table="staffprofbodies" data-field="x_ProfessionalBody" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staffprofbodies_edit->ProfessionalBody->displayValueSeparatorAttribute() ?>" name="x_ProfessionalBody" id="x_ProfessionalBody" value="<?php echo $staffprofbodies_edit->ProfessionalBody->CurrentValue ?>"<?php echo $staffprofbodies_edit->ProfessionalBody->editAttributes() ?>>
<input type="hidden" data-table="staffprofbodies" data-field="x_ProfessionalBody" name="o_ProfessionalBody" id="o_ProfessionalBody" value="<?php echo HtmlEncode($staffprofbodies_edit->ProfessionalBody->OldValue != null ? $staffprofbodies_edit->ProfessionalBody->OldValue : $staffprofbodies_edit->ProfessionalBody->CurrentValue) ?>">
<?php echo $staffprofbodies_edit->ProfessionalBody->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffprofbodies_edit->MembershipNo->Visible) { // MembershipNo ?>
	<div id="r_MembershipNo" class="form-group row">
		<label id="elh_staffprofbodies_MembershipNo" for="x_MembershipNo" class="<?php echo $staffprofbodies_edit->LeftColumnClass ?>"><?php echo $staffprofbodies_edit->MembershipNo->caption() ?><?php echo $staffprofbodies_edit->MembershipNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffprofbodies_edit->RightColumnClass ?>"><div <?php echo $staffprofbodies_edit->MembershipNo->cellAttributes() ?>>
<span id="el_staffprofbodies_MembershipNo">
<input type="text" data-table="staffprofbodies" data-field="x_MembershipNo" name="x_MembershipNo" id="x_MembershipNo" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($staffprofbodies_edit->MembershipNo->getPlaceHolder()) ?>" value="<?php echo $staffprofbodies_edit->MembershipNo->EditValue ?>"<?php echo $staffprofbodies_edit->MembershipNo->editAttributes() ?>>
</span>
<?php echo $staffprofbodies_edit->MembershipNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffprofbodies_edit->DateJoined->Visible) { // DateJoined ?>
	<div id="r_DateJoined" class="form-group row">
		<label id="elh_staffprofbodies_DateJoined" for="x_DateJoined" class="<?php echo $staffprofbodies_edit->LeftColumnClass ?>"><?php echo $staffprofbodies_edit->DateJoined->caption() ?><?php echo $staffprofbodies_edit->DateJoined->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffprofbodies_edit->RightColumnClass ?>"><div <?php echo $staffprofbodies_edit->DateJoined->cellAttributes() ?>>
<span id="el_staffprofbodies_DateJoined">
<input type="text" data-table="staffprofbodies" data-field="x_DateJoined" name="x_DateJoined" id="x_DateJoined" placeholder="<?php echo HtmlEncode($staffprofbodies_edit->DateJoined->getPlaceHolder()) ?>" value="<?php echo $staffprofbodies_edit->DateJoined->EditValue ?>"<?php echo $staffprofbodies_edit->DateJoined->editAttributes() ?>>
<?php if (!$staffprofbodies_edit->DateJoined->ReadOnly && !$staffprofbodies_edit->DateJoined->Disabled && !isset($staffprofbodies_edit->DateJoined->EditAttrs["readonly"]) && !isset($staffprofbodies_edit->DateJoined->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffprofbodiesedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffprofbodiesedit", "x_DateJoined", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $staffprofbodies_edit->DateJoined->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffprofbodies_edit->DateRenewed->Visible) { // DateRenewed ?>
	<div id="r_DateRenewed" class="form-group row">
		<label id="elh_staffprofbodies_DateRenewed" for="x_DateRenewed" class="<?php echo $staffprofbodies_edit->LeftColumnClass ?>"><?php echo $staffprofbodies_edit->DateRenewed->caption() ?><?php echo $staffprofbodies_edit->DateRenewed->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffprofbodies_edit->RightColumnClass ?>"><div <?php echo $staffprofbodies_edit->DateRenewed->cellAttributes() ?>>
<span id="el_staffprofbodies_DateRenewed">
<input type="text" data-table="staffprofbodies" data-field="x_DateRenewed" name="x_DateRenewed" id="x_DateRenewed" placeholder="<?php echo HtmlEncode($staffprofbodies_edit->DateRenewed->getPlaceHolder()) ?>" value="<?php echo $staffprofbodies_edit->DateRenewed->EditValue ?>"<?php echo $staffprofbodies_edit->DateRenewed->editAttributes() ?>>
<?php if (!$staffprofbodies_edit->DateRenewed->ReadOnly && !$staffprofbodies_edit->DateRenewed->Disabled && !isset($staffprofbodies_edit->DateRenewed->EditAttrs["readonly"]) && !isset($staffprofbodies_edit->DateRenewed->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffprofbodiesedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffprofbodiesedit", "x_DateRenewed", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $staffprofbodies_edit->DateRenewed->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffprofbodies_edit->ValidTo->Visible) { // ValidTo ?>
	<div id="r_ValidTo" class="form-group row">
		<label id="elh_staffprofbodies_ValidTo" for="x_ValidTo" class="<?php echo $staffprofbodies_edit->LeftColumnClass ?>"><?php echo $staffprofbodies_edit->ValidTo->caption() ?><?php echo $staffprofbodies_edit->ValidTo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffprofbodies_edit->RightColumnClass ?>"><div <?php echo $staffprofbodies_edit->ValidTo->cellAttributes() ?>>
<span id="el_staffprofbodies_ValidTo">
<input type="text" data-table="staffprofbodies" data-field="x_ValidTo" name="x_ValidTo" id="x_ValidTo" placeholder="<?php echo HtmlEncode($staffprofbodies_edit->ValidTo->getPlaceHolder()) ?>" value="<?php echo $staffprofbodies_edit->ValidTo->EditValue ?>"<?php echo $staffprofbodies_edit->ValidTo->editAttributes() ?>>
<?php if (!$staffprofbodies_edit->ValidTo->ReadOnly && !$staffprofbodies_edit->ValidTo->Disabled && !isset($staffprofbodies_edit->ValidTo->EditAttrs["readonly"]) && !isset($staffprofbodies_edit->ValidTo->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffprofbodiesedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffprofbodiesedit", "x_ValidTo", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $staffprofbodies_edit->ValidTo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffprofbodies_edit->MemberStatus->Visible) { // MemberStatus ?>
	<div id="r_MemberStatus" class="form-group row">
		<label id="elh_staffprofbodies_MemberStatus" for="x_MemberStatus" class="<?php echo $staffprofbodies_edit->LeftColumnClass ?>"><?php echo $staffprofbodies_edit->MemberStatus->caption() ?><?php echo $staffprofbodies_edit->MemberStatus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffprofbodies_edit->RightColumnClass ?>"><div <?php echo $staffprofbodies_edit->MemberStatus->cellAttributes() ?>>
<span id="el_staffprofbodies_MemberStatus">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffprofbodies" data-field="x_MemberStatus" data-value-separator="<?php echo $staffprofbodies_edit->MemberStatus->displayValueSeparatorAttribute() ?>" id="x_MemberStatus" name="x_MemberStatus"<?php echo $staffprofbodies_edit->MemberStatus->editAttributes() ?>>
			<?php echo $staffprofbodies_edit->MemberStatus->selectOptionListHtml("x_MemberStatus") ?>
		</select>
</div>
<?php echo $staffprofbodies_edit->MemberStatus->Lookup->getParamTag($staffprofbodies_edit, "p_x_MemberStatus") ?>
</span>
<?php echo $staffprofbodies_edit->MemberStatus->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$staffprofbodies_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $staffprofbodies_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $staffprofbodies_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$staffprofbodies_edit->IsModal) { ?>
<?php echo $staffprofbodies_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$staffprofbodies_edit->showPageFooter();
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
$staffprofbodies_edit->terminate();
?>