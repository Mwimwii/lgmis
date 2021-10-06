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
$local_authority_edit = new local_authority_edit();

// Run the page
$local_authority_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$local_authority_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var flocal_authorityedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	flocal_authorityedit = currentForm = new ew.Form("flocal_authorityedit", "edit");

	// Validate form
	flocal_authorityedit.validate = function() {
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
			<?php if ($local_authority_edit->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $local_authority_edit->LACode->caption(), $local_authority_edit->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($local_authority_edit->LACode->errorMessage()) ?>");
			<?php if ($local_authority_edit->LAName->Required) { ?>
				elm = this.getElements("x" + infix + "_LAName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $local_authority_edit->LAName->caption(), $local_authority_edit->LAName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($local_authority_edit->CouncilType->Required) { ?>
				elm = this.getElements("x" + infix + "_CouncilType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $local_authority_edit->CouncilType->caption(), $local_authority_edit->CouncilType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($local_authority_edit->ProvinceCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $local_authority_edit->ProvinceCode->caption(), $local_authority_edit->ProvinceCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($local_authority_edit->Mandate->Required) { ?>
				elm = this.getElements("x" + infix + "_Mandate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $local_authority_edit->Mandate->caption(), $local_authority_edit->Mandate->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($local_authority_edit->Strategy->Required) { ?>
				elm = this.getElements("x" + infix + "_Strategy");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $local_authority_edit->Strategy->caption(), $local_authority_edit->Strategy->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($local_authority_edit->Clients->Required) { ?>
				elm = this.getElements("x" + infix + "_Clients");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $local_authority_edit->Clients->caption(), $local_authority_edit->Clients->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($local_authority_edit->Beneficiaries->Required) { ?>
				elm = this.getElements("x" + infix + "_Beneficiaries");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $local_authority_edit->Beneficiaries->caption(), $local_authority_edit->Beneficiaries->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($local_authority_edit->ExecutiveAuthority->Required) { ?>
				elm = this.getElements("x" + infix + "_ExecutiveAuthority");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $local_authority_edit->ExecutiveAuthority->caption(), $local_authority_edit->ExecutiveAuthority->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($local_authority_edit->ControllingOfficer->Required) { ?>
				elm = this.getElements("x" + infix + "_ControllingOfficer");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $local_authority_edit->ControllingOfficer->caption(), $local_authority_edit->ControllingOfficer->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($local_authority_edit->Comment->Required) { ?>
				elm = this.getElements("x" + infix + "_Comment");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $local_authority_edit->Comment->caption(), $local_authority_edit->Comment->RequiredErrorMessage)) ?>");
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
	flocal_authorityedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	flocal_authorityedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	flocal_authorityedit.lists["x_CouncilType"] = <?php echo $local_authority_edit->CouncilType->Lookup->toClientList($local_authority_edit) ?>;
	flocal_authorityedit.lists["x_CouncilType"].options = <?php echo JsonEncode($local_authority_edit->CouncilType->lookupOptions()) ?>;
	flocal_authorityedit.lists["x_ProvinceCode"] = <?php echo $local_authority_edit->ProvinceCode->Lookup->toClientList($local_authority_edit) ?>;
	flocal_authorityedit.lists["x_ProvinceCode"].options = <?php echo JsonEncode($local_authority_edit->ProvinceCode->lookupOptions()) ?>;
	loadjs.done("flocal_authorityedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $local_authority_edit->showPageHeader(); ?>
<?php
$local_authority_edit->showMessage();
?>
<?php if (!$local_authority_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $local_authority_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="flocal_authorityedit" id="flocal_authorityedit" class="<?php echo $local_authority_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="local_authority">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$local_authority_edit->IsModal ?>">
<?php if ($local_authority->getCurrentMasterTable() == "province") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="province">
<input type="hidden" name="fk_ProvinceCode" value="<?php echo HtmlEncode($local_authority_edit->ProvinceCode->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($local_authority_edit->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label id="elh_local_authority_LACode" for="x_LACode" class="<?php echo $local_authority_edit->LeftColumnClass ?>"><?php echo $local_authority_edit->LACode->caption() ?><?php echo $local_authority_edit->LACode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $local_authority_edit->RightColumnClass ?>"><div <?php echo $local_authority_edit->LACode->cellAttributes() ?>>
<input type="text" data-table="local_authority" data-field="x_LACode" name="x_LACode" id="x_LACode" size="30" placeholder="<?php echo HtmlEncode($local_authority_edit->LACode->getPlaceHolder()) ?>" value="<?php echo $local_authority_edit->LACode->EditValue ?>"<?php echo $local_authority_edit->LACode->editAttributes() ?>>
<input type="hidden" data-table="local_authority" data-field="x_LACode" name="o_LACode" id="o_LACode" value="<?php echo HtmlEncode($local_authority_edit->LACode->OldValue != null ? $local_authority_edit->LACode->OldValue : $local_authority_edit->LACode->CurrentValue) ?>">
<?php echo $local_authority_edit->LACode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($local_authority_edit->LAName->Visible) { // LAName ?>
	<div id="r_LAName" class="form-group row">
		<label id="elh_local_authority_LAName" for="x_LAName" class="<?php echo $local_authority_edit->LeftColumnClass ?>"><?php echo $local_authority_edit->LAName->caption() ?><?php echo $local_authority_edit->LAName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $local_authority_edit->RightColumnClass ?>"><div <?php echo $local_authority_edit->LAName->cellAttributes() ?>>
<span id="el_local_authority_LAName">
<input type="text" data-table="local_authority" data-field="x_LAName" name="x_LAName" id="x_LAName" size="40" maxlength="40" placeholder="<?php echo HtmlEncode($local_authority_edit->LAName->getPlaceHolder()) ?>" value="<?php echo $local_authority_edit->LAName->EditValue ?>"<?php echo $local_authority_edit->LAName->editAttributes() ?>>
</span>
<?php echo $local_authority_edit->LAName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($local_authority_edit->CouncilType->Visible) { // CouncilType ?>
	<div id="r_CouncilType" class="form-group row">
		<label id="elh_local_authority_CouncilType" for="x_CouncilType" class="<?php echo $local_authority_edit->LeftColumnClass ?>"><?php echo $local_authority_edit->CouncilType->caption() ?><?php echo $local_authority_edit->CouncilType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $local_authority_edit->RightColumnClass ?>"><div <?php echo $local_authority_edit->CouncilType->cellAttributes() ?>>
<span id="el_local_authority_CouncilType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="local_authority" data-field="x_CouncilType" data-value-separator="<?php echo $local_authority_edit->CouncilType->displayValueSeparatorAttribute() ?>" id="x_CouncilType" name="x_CouncilType"<?php echo $local_authority_edit->CouncilType->editAttributes() ?>>
			<?php echo $local_authority_edit->CouncilType->selectOptionListHtml("x_CouncilType") ?>
		</select>
</div>
<?php echo $local_authority_edit->CouncilType->Lookup->getParamTag($local_authority_edit, "p_x_CouncilType") ?>
</span>
<?php echo $local_authority_edit->CouncilType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($local_authority_edit->ProvinceCode->Visible) { // ProvinceCode ?>
	<div id="r_ProvinceCode" class="form-group row">
		<label id="elh_local_authority_ProvinceCode" for="x_ProvinceCode" class="<?php echo $local_authority_edit->LeftColumnClass ?>"><?php echo $local_authority_edit->ProvinceCode->caption() ?><?php echo $local_authority_edit->ProvinceCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $local_authority_edit->RightColumnClass ?>"><div <?php echo $local_authority_edit->ProvinceCode->cellAttributes() ?>>
<?php if ($local_authority_edit->ProvinceCode->getSessionValue() != "") { ?>
<span id="el_local_authority_ProvinceCode">
<span<?php echo $local_authority_edit->ProvinceCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($local_authority_edit->ProvinceCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_ProvinceCode" name="x_ProvinceCode" value="<?php echo HtmlEncode($local_authority_edit->ProvinceCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_local_authority_ProvinceCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="local_authority" data-field="x_ProvinceCode" data-value-separator="<?php echo $local_authority_edit->ProvinceCode->displayValueSeparatorAttribute() ?>" id="x_ProvinceCode" name="x_ProvinceCode"<?php echo $local_authority_edit->ProvinceCode->editAttributes() ?>>
			<?php echo $local_authority_edit->ProvinceCode->selectOptionListHtml("x_ProvinceCode") ?>
		</select>
</div>
<?php echo $local_authority_edit->ProvinceCode->Lookup->getParamTag($local_authority_edit, "p_x_ProvinceCode") ?>
</span>
<?php } ?>
<?php echo $local_authority_edit->ProvinceCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($local_authority_edit->Mandate->Visible) { // Mandate ?>
	<div id="r_Mandate" class="form-group row">
		<label id="elh_local_authority_Mandate" for="x_Mandate" class="<?php echo $local_authority_edit->LeftColumnClass ?>"><?php echo $local_authority_edit->Mandate->caption() ?><?php echo $local_authority_edit->Mandate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $local_authority_edit->RightColumnClass ?>"><div <?php echo $local_authority_edit->Mandate->cellAttributes() ?>>
<span id="el_local_authority_Mandate">
<textarea data-table="local_authority" data-field="x_Mandate" name="x_Mandate" id="x_Mandate" cols="35" rows="4" placeholder="<?php echo HtmlEncode($local_authority_edit->Mandate->getPlaceHolder()) ?>"<?php echo $local_authority_edit->Mandate->editAttributes() ?>><?php echo $local_authority_edit->Mandate->EditValue ?></textarea>
</span>
<?php echo $local_authority_edit->Mandate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($local_authority_edit->Strategy->Visible) { // Strategy ?>
	<div id="r_Strategy" class="form-group row">
		<label id="elh_local_authority_Strategy" for="x_Strategy" class="<?php echo $local_authority_edit->LeftColumnClass ?>"><?php echo $local_authority_edit->Strategy->caption() ?><?php echo $local_authority_edit->Strategy->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $local_authority_edit->RightColumnClass ?>"><div <?php echo $local_authority_edit->Strategy->cellAttributes() ?>>
<span id="el_local_authority_Strategy">
<textarea data-table="local_authority" data-field="x_Strategy" name="x_Strategy" id="x_Strategy" cols="35" rows="4" placeholder="<?php echo HtmlEncode($local_authority_edit->Strategy->getPlaceHolder()) ?>"<?php echo $local_authority_edit->Strategy->editAttributes() ?>><?php echo $local_authority_edit->Strategy->EditValue ?></textarea>
</span>
<?php echo $local_authority_edit->Strategy->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($local_authority_edit->Clients->Visible) { // Clients ?>
	<div id="r_Clients" class="form-group row">
		<label id="elh_local_authority_Clients" for="x_Clients" class="<?php echo $local_authority_edit->LeftColumnClass ?>"><?php echo $local_authority_edit->Clients->caption() ?><?php echo $local_authority_edit->Clients->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $local_authority_edit->RightColumnClass ?>"><div <?php echo $local_authority_edit->Clients->cellAttributes() ?>>
<span id="el_local_authority_Clients">
<textarea data-table="local_authority" data-field="x_Clients" name="x_Clients" id="x_Clients" cols="35" rows="2" placeholder="<?php echo HtmlEncode($local_authority_edit->Clients->getPlaceHolder()) ?>"<?php echo $local_authority_edit->Clients->editAttributes() ?>><?php echo $local_authority_edit->Clients->EditValue ?></textarea>
</span>
<?php echo $local_authority_edit->Clients->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($local_authority_edit->Beneficiaries->Visible) { // Beneficiaries ?>
	<div id="r_Beneficiaries" class="form-group row">
		<label id="elh_local_authority_Beneficiaries" for="x_Beneficiaries" class="<?php echo $local_authority_edit->LeftColumnClass ?>"><?php echo $local_authority_edit->Beneficiaries->caption() ?><?php echo $local_authority_edit->Beneficiaries->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $local_authority_edit->RightColumnClass ?>"><div <?php echo $local_authority_edit->Beneficiaries->cellAttributes() ?>>
<span id="el_local_authority_Beneficiaries">
<textarea data-table="local_authority" data-field="x_Beneficiaries" name="x_Beneficiaries" id="x_Beneficiaries" cols="35" rows="2" placeholder="<?php echo HtmlEncode($local_authority_edit->Beneficiaries->getPlaceHolder()) ?>"<?php echo $local_authority_edit->Beneficiaries->editAttributes() ?>><?php echo $local_authority_edit->Beneficiaries->EditValue ?></textarea>
</span>
<?php echo $local_authority_edit->Beneficiaries->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($local_authority_edit->ExecutiveAuthority->Visible) { // ExecutiveAuthority ?>
	<div id="r_ExecutiveAuthority" class="form-group row">
		<label id="elh_local_authority_ExecutiveAuthority" for="x_ExecutiveAuthority" class="<?php echo $local_authority_edit->LeftColumnClass ?>"><?php echo $local_authority_edit->ExecutiveAuthority->caption() ?><?php echo $local_authority_edit->ExecutiveAuthority->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $local_authority_edit->RightColumnClass ?>"><div <?php echo $local_authority_edit->ExecutiveAuthority->cellAttributes() ?>>
<span id="el_local_authority_ExecutiveAuthority">
<input type="text" data-table="local_authority" data-field="x_ExecutiveAuthority" name="x_ExecutiveAuthority" id="x_ExecutiveAuthority" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($local_authority_edit->ExecutiveAuthority->getPlaceHolder()) ?>" value="<?php echo $local_authority_edit->ExecutiveAuthority->EditValue ?>"<?php echo $local_authority_edit->ExecutiveAuthority->editAttributes() ?>>
</span>
<?php echo $local_authority_edit->ExecutiveAuthority->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($local_authority_edit->ControllingOfficer->Visible) { // ControllingOfficer ?>
	<div id="r_ControllingOfficer" class="form-group row">
		<label id="elh_local_authority_ControllingOfficer" for="x_ControllingOfficer" class="<?php echo $local_authority_edit->LeftColumnClass ?>"><?php echo $local_authority_edit->ControllingOfficer->caption() ?><?php echo $local_authority_edit->ControllingOfficer->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $local_authority_edit->RightColumnClass ?>"><div <?php echo $local_authority_edit->ControllingOfficer->cellAttributes() ?>>
<span id="el_local_authority_ControllingOfficer">
<input type="text" data-table="local_authority" data-field="x_ControllingOfficer" name="x_ControllingOfficer" id="x_ControllingOfficer" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($local_authority_edit->ControllingOfficer->getPlaceHolder()) ?>" value="<?php echo $local_authority_edit->ControllingOfficer->EditValue ?>"<?php echo $local_authority_edit->ControllingOfficer->editAttributes() ?>>
</span>
<?php echo $local_authority_edit->ControllingOfficer->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($local_authority_edit->Comment->Visible) { // Comment ?>
	<div id="r_Comment" class="form-group row">
		<label id="elh_local_authority_Comment" for="x_Comment" class="<?php echo $local_authority_edit->LeftColumnClass ?>"><?php echo $local_authority_edit->Comment->caption() ?><?php echo $local_authority_edit->Comment->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $local_authority_edit->RightColumnClass ?>"><div <?php echo $local_authority_edit->Comment->cellAttributes() ?>>
<span id="el_local_authority_Comment">
<textarea data-table="local_authority" data-field="x_Comment" name="x_Comment" id="x_Comment" cols="50" rows="4" placeholder="<?php echo HtmlEncode($local_authority_edit->Comment->getPlaceHolder()) ?>"<?php echo $local_authority_edit->Comment->editAttributes() ?>><?php echo $local_authority_edit->Comment->EditValue ?></textarea>
</span>
<?php echo $local_authority_edit->Comment->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("department", explode(",", $local_authority->getCurrentDetailTable())) && $department->DetailEdit) {
?>
<?php if ($local_authority->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("department", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "departmentgrid.php" ?>
<?php } ?>
<?php
	if (in_array("council_meeting", explode(",", $local_authority->getCurrentDetailTable())) && $council_meeting->DetailEdit) {
?>
<?php if ($local_authority->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("council_meeting", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "council_meetinggrid.php" ?>
<?php } ?>
<?php
	if (in_array("asset", explode(",", $local_authority->getCurrentDetailTable())) && $asset->DetailEdit) {
?>
<?php if ($local_authority->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("asset", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "assetgrid.php" ?>
<?php } ?>
<?php
	if (in_array("ward", explode(",", $local_authority->getCurrentDetailTable())) && $ward->DetailEdit) {
?>
<?php if ($local_authority->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("ward", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "wardgrid.php" ?>
<?php } ?>
<?php
	if (in_array("budget_actual", explode(",", $local_authority->getCurrentDetailTable())) && $budget_actual->DetailEdit) {
?>
<?php if ($local_authority->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("budget_actual", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "budget_actualgrid.php" ?>
<?php } ?>
<?php
	if (in_array("councillorship", explode(",", $local_authority->getCurrentDetailTable())) && $councillorship->DetailEdit) {
?>
<?php if ($local_authority->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("councillorship", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "councillorshipgrid.php" ?>
<?php } ?>
<?php
	if (in_array("monthly_run", explode(",", $local_authority->getCurrentDetailTable())) && $monthly_run->DetailEdit) {
?>
<?php if ($local_authority->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("monthly_run", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "monthly_rungrid.php" ?>
<?php } ?>
<?php
	if (in_array("project", explode(",", $local_authority->getCurrentDetailTable())) && $project->DetailEdit) {
?>
<?php if ($local_authority->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("project", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "projectgrid.php" ?>
<?php } ?>
<?php
	if (in_array("la_bank_account", explode(",", $local_authority->getCurrentDetailTable())) && $la_bank_account->DetailEdit) {
?>
<?php if ($local_authority->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("la_bank_account", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "la_bank_accountgrid.php" ?>
<?php } ?>
<?php
	if (in_array("strategic_objective", explode(",", $local_authority->getCurrentDetailTable())) && $strategic_objective->DetailEdit) {
?>
<?php if ($local_authority->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("strategic_objective", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "strategic_objectivegrid.php" ?>
<?php } ?>
<?php if (!$local_authority_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $local_authority_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $local_authority_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$local_authority_edit->IsModal) { ?>
<?php echo $local_authority_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$local_authority_edit->showPageFooter();
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
$local_authority_edit->terminate();
?>