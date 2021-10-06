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
$staffprofbodies_add = new staffprofbodies_add();

// Run the page
$staffprofbodies_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$staffprofbodies_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fstaffprofbodiesadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fstaffprofbodiesadd = currentForm = new ew.Form("fstaffprofbodiesadd", "add");

	// Validate form
	fstaffprofbodiesadd.validate = function() {
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
			<?php if ($staffprofbodies_add->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffprofbodies_add->EmployeeID->caption(), $staffprofbodies_add->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffprofbodies_add->EmployeeID->errorMessage()) ?>");
			<?php if ($staffprofbodies_add->ProfessionalBody->Required) { ?>
				elm = this.getElements("x" + infix + "_ProfessionalBody");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffprofbodies_add->ProfessionalBody->caption(), $staffprofbodies_add->ProfessionalBody->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffprofbodies_add->MembershipNo->Required) { ?>
				elm = this.getElements("x" + infix + "_MembershipNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffprofbodies_add->MembershipNo->caption(), $staffprofbodies_add->MembershipNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffprofbodies_add->DateJoined->Required) { ?>
				elm = this.getElements("x" + infix + "_DateJoined");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffprofbodies_add->DateJoined->caption(), $staffprofbodies_add->DateJoined->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateJoined");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffprofbodies_add->DateJoined->errorMessage()) ?>");
			<?php if ($staffprofbodies_add->DateRenewed->Required) { ?>
				elm = this.getElements("x" + infix + "_DateRenewed");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffprofbodies_add->DateRenewed->caption(), $staffprofbodies_add->DateRenewed->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateRenewed");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffprofbodies_add->DateRenewed->errorMessage()) ?>");
			<?php if ($staffprofbodies_add->ValidTo->Required) { ?>
				elm = this.getElements("x" + infix + "_ValidTo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffprofbodies_add->ValidTo->caption(), $staffprofbodies_add->ValidTo->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ValidTo");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffprofbodies_add->ValidTo->errorMessage()) ?>");
			<?php if ($staffprofbodies_add->MemberStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_MemberStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffprofbodies_add->MemberStatus->caption(), $staffprofbodies_add->MemberStatus->RequiredErrorMessage)) ?>");
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
	fstaffprofbodiesadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fstaffprofbodiesadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fstaffprofbodiesadd.lists["x_ProfessionalBody"] = <?php echo $staffprofbodies_add->ProfessionalBody->Lookup->toClientList($staffprofbodies_add) ?>;
	fstaffprofbodiesadd.lists["x_ProfessionalBody"].options = <?php echo JsonEncode($staffprofbodies_add->ProfessionalBody->lookupOptions()) ?>;
	fstaffprofbodiesadd.lists["x_MemberStatus"] = <?php echo $staffprofbodies_add->MemberStatus->Lookup->toClientList($staffprofbodies_add) ?>;
	fstaffprofbodiesadd.lists["x_MemberStatus"].options = <?php echo JsonEncode($staffprofbodies_add->MemberStatus->lookupOptions()) ?>;
	loadjs.done("fstaffprofbodiesadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $staffprofbodies_add->showPageHeader(); ?>
<?php
$staffprofbodies_add->showMessage();
?>
<form name="fstaffprofbodiesadd" id="fstaffprofbodiesadd" class="<?php echo $staffprofbodies_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="staffprofbodies">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$staffprofbodies_add->IsModal ?>">
<?php if ($staffprofbodies->getCurrentMasterTable() == "staff") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="staff">
<input type="hidden" name="fk_EmployeeID" value="<?php echo HtmlEncode($staffprofbodies_add->EmployeeID->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($staffprofbodies_add->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label id="elh_staffprofbodies_EmployeeID" for="x_EmployeeID" class="<?php echo $staffprofbodies_add->LeftColumnClass ?>"><?php echo $staffprofbodies_add->EmployeeID->caption() ?><?php echo $staffprofbodies_add->EmployeeID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffprofbodies_add->RightColumnClass ?>"><div <?php echo $staffprofbodies_add->EmployeeID->cellAttributes() ?>>
<?php if ($staffprofbodies_add->EmployeeID->getSessionValue() != "") { ?>
<span id="el_staffprofbodies_EmployeeID">
<span<?php echo $staffprofbodies_add->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffprofbodies_add->EmployeeID->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_EmployeeID" name="x_EmployeeID" value="<?php echo HtmlEncode($staffprofbodies_add->EmployeeID->CurrentValue) ?>">
<?php } else { ?>
<span id="el_staffprofbodies_EmployeeID">
<input type="text" data-table="staffprofbodies" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($staffprofbodies_add->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $staffprofbodies_add->EmployeeID->EditValue ?>"<?php echo $staffprofbodies_add->EmployeeID->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $staffprofbodies_add->EmployeeID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffprofbodies_add->ProfessionalBody->Visible) { // ProfessionalBody ?>
	<div id="r_ProfessionalBody" class="form-group row">
		<label id="elh_staffprofbodies_ProfessionalBody" for="x_ProfessionalBody" class="<?php echo $staffprofbodies_add->LeftColumnClass ?>"><?php echo $staffprofbodies_add->ProfessionalBody->caption() ?><?php echo $staffprofbodies_add->ProfessionalBody->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffprofbodies_add->RightColumnClass ?>"><div <?php echo $staffprofbodies_add->ProfessionalBody->cellAttributes() ?>>
<span id="el_staffprofbodies_ProfessionalBody">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_ProfessionalBody"><?php echo EmptyValue(strval($staffprofbodies_add->ProfessionalBody->ViewValue)) ? $Language->phrase("PleaseSelect") : $staffprofbodies_add->ProfessionalBody->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staffprofbodies_add->ProfessionalBody->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staffprofbodies_add->ProfessionalBody->ReadOnly || $staffprofbodies_add->ProfessionalBody->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_ProfessionalBody',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staffprofbodies_add->ProfessionalBody->Lookup->getParamTag($staffprofbodies_add, "p_x_ProfessionalBody") ?>
<input type="hidden" data-table="staffprofbodies" data-field="x_ProfessionalBody" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staffprofbodies_add->ProfessionalBody->displayValueSeparatorAttribute() ?>" name="x_ProfessionalBody" id="x_ProfessionalBody" value="<?php echo $staffprofbodies_add->ProfessionalBody->CurrentValue ?>"<?php echo $staffprofbodies_add->ProfessionalBody->editAttributes() ?>>
</span>
<?php echo $staffprofbodies_add->ProfessionalBody->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffprofbodies_add->MembershipNo->Visible) { // MembershipNo ?>
	<div id="r_MembershipNo" class="form-group row">
		<label id="elh_staffprofbodies_MembershipNo" for="x_MembershipNo" class="<?php echo $staffprofbodies_add->LeftColumnClass ?>"><?php echo $staffprofbodies_add->MembershipNo->caption() ?><?php echo $staffprofbodies_add->MembershipNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffprofbodies_add->RightColumnClass ?>"><div <?php echo $staffprofbodies_add->MembershipNo->cellAttributes() ?>>
<span id="el_staffprofbodies_MembershipNo">
<input type="text" data-table="staffprofbodies" data-field="x_MembershipNo" name="x_MembershipNo" id="x_MembershipNo" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($staffprofbodies_add->MembershipNo->getPlaceHolder()) ?>" value="<?php echo $staffprofbodies_add->MembershipNo->EditValue ?>"<?php echo $staffprofbodies_add->MembershipNo->editAttributes() ?>>
</span>
<?php echo $staffprofbodies_add->MembershipNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffprofbodies_add->DateJoined->Visible) { // DateJoined ?>
	<div id="r_DateJoined" class="form-group row">
		<label id="elh_staffprofbodies_DateJoined" for="x_DateJoined" class="<?php echo $staffprofbodies_add->LeftColumnClass ?>"><?php echo $staffprofbodies_add->DateJoined->caption() ?><?php echo $staffprofbodies_add->DateJoined->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffprofbodies_add->RightColumnClass ?>"><div <?php echo $staffprofbodies_add->DateJoined->cellAttributes() ?>>
<span id="el_staffprofbodies_DateJoined">
<input type="text" data-table="staffprofbodies" data-field="x_DateJoined" name="x_DateJoined" id="x_DateJoined" placeholder="<?php echo HtmlEncode($staffprofbodies_add->DateJoined->getPlaceHolder()) ?>" value="<?php echo $staffprofbodies_add->DateJoined->EditValue ?>"<?php echo $staffprofbodies_add->DateJoined->editAttributes() ?>>
<?php if (!$staffprofbodies_add->DateJoined->ReadOnly && !$staffprofbodies_add->DateJoined->Disabled && !isset($staffprofbodies_add->DateJoined->EditAttrs["readonly"]) && !isset($staffprofbodies_add->DateJoined->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffprofbodiesadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffprofbodiesadd", "x_DateJoined", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $staffprofbodies_add->DateJoined->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffprofbodies_add->DateRenewed->Visible) { // DateRenewed ?>
	<div id="r_DateRenewed" class="form-group row">
		<label id="elh_staffprofbodies_DateRenewed" for="x_DateRenewed" class="<?php echo $staffprofbodies_add->LeftColumnClass ?>"><?php echo $staffprofbodies_add->DateRenewed->caption() ?><?php echo $staffprofbodies_add->DateRenewed->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffprofbodies_add->RightColumnClass ?>"><div <?php echo $staffprofbodies_add->DateRenewed->cellAttributes() ?>>
<span id="el_staffprofbodies_DateRenewed">
<input type="text" data-table="staffprofbodies" data-field="x_DateRenewed" name="x_DateRenewed" id="x_DateRenewed" placeholder="<?php echo HtmlEncode($staffprofbodies_add->DateRenewed->getPlaceHolder()) ?>" value="<?php echo $staffprofbodies_add->DateRenewed->EditValue ?>"<?php echo $staffprofbodies_add->DateRenewed->editAttributes() ?>>
<?php if (!$staffprofbodies_add->DateRenewed->ReadOnly && !$staffprofbodies_add->DateRenewed->Disabled && !isset($staffprofbodies_add->DateRenewed->EditAttrs["readonly"]) && !isset($staffprofbodies_add->DateRenewed->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffprofbodiesadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffprofbodiesadd", "x_DateRenewed", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $staffprofbodies_add->DateRenewed->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffprofbodies_add->ValidTo->Visible) { // ValidTo ?>
	<div id="r_ValidTo" class="form-group row">
		<label id="elh_staffprofbodies_ValidTo" for="x_ValidTo" class="<?php echo $staffprofbodies_add->LeftColumnClass ?>"><?php echo $staffprofbodies_add->ValidTo->caption() ?><?php echo $staffprofbodies_add->ValidTo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffprofbodies_add->RightColumnClass ?>"><div <?php echo $staffprofbodies_add->ValidTo->cellAttributes() ?>>
<span id="el_staffprofbodies_ValidTo">
<input type="text" data-table="staffprofbodies" data-field="x_ValidTo" name="x_ValidTo" id="x_ValidTo" placeholder="<?php echo HtmlEncode($staffprofbodies_add->ValidTo->getPlaceHolder()) ?>" value="<?php echo $staffprofbodies_add->ValidTo->EditValue ?>"<?php echo $staffprofbodies_add->ValidTo->editAttributes() ?>>
<?php if (!$staffprofbodies_add->ValidTo->ReadOnly && !$staffprofbodies_add->ValidTo->Disabled && !isset($staffprofbodies_add->ValidTo->EditAttrs["readonly"]) && !isset($staffprofbodies_add->ValidTo->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffprofbodiesadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffprofbodiesadd", "x_ValidTo", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $staffprofbodies_add->ValidTo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffprofbodies_add->MemberStatus->Visible) { // MemberStatus ?>
	<div id="r_MemberStatus" class="form-group row">
		<label id="elh_staffprofbodies_MemberStatus" for="x_MemberStatus" class="<?php echo $staffprofbodies_add->LeftColumnClass ?>"><?php echo $staffprofbodies_add->MemberStatus->caption() ?><?php echo $staffprofbodies_add->MemberStatus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffprofbodies_add->RightColumnClass ?>"><div <?php echo $staffprofbodies_add->MemberStatus->cellAttributes() ?>>
<span id="el_staffprofbodies_MemberStatus">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffprofbodies" data-field="x_MemberStatus" data-value-separator="<?php echo $staffprofbodies_add->MemberStatus->displayValueSeparatorAttribute() ?>" id="x_MemberStatus" name="x_MemberStatus"<?php echo $staffprofbodies_add->MemberStatus->editAttributes() ?>>
			<?php echo $staffprofbodies_add->MemberStatus->selectOptionListHtml("x_MemberStatus") ?>
		</select>
</div>
<?php echo $staffprofbodies_add->MemberStatus->Lookup->getParamTag($staffprofbodies_add, "p_x_MemberStatus") ?>
</span>
<?php echo $staffprofbodies_add->MemberStatus->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$staffprofbodies_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $staffprofbodies_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $staffprofbodies_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$staffprofbodies_add->showPageFooter();
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
$staffprofbodies_add->terminate();
?>