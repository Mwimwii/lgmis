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
$local_authority_add = new local_authority_add();

// Run the page
$local_authority_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$local_authority_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var flocal_authorityadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	flocal_authorityadd = currentForm = new ew.Form("flocal_authorityadd", "add");

	// Validate form
	flocal_authorityadd.validate = function() {
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
			<?php if ($local_authority_add->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $local_authority_add->LACode->caption(), $local_authority_add->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($local_authority_add->LACode->errorMessage()) ?>");
			<?php if ($local_authority_add->LAName->Required) { ?>
				elm = this.getElements("x" + infix + "_LAName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $local_authority_add->LAName->caption(), $local_authority_add->LAName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($local_authority_add->CouncilType->Required) { ?>
				elm = this.getElements("x" + infix + "_CouncilType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $local_authority_add->CouncilType->caption(), $local_authority_add->CouncilType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($local_authority_add->ProvinceCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $local_authority_add->ProvinceCode->caption(), $local_authority_add->ProvinceCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($local_authority_add->Mandate->Required) { ?>
				elm = this.getElements("x" + infix + "_Mandate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $local_authority_add->Mandate->caption(), $local_authority_add->Mandate->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($local_authority_add->Strategy->Required) { ?>
				elm = this.getElements("x" + infix + "_Strategy");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $local_authority_add->Strategy->caption(), $local_authority_add->Strategy->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($local_authority_add->Clients->Required) { ?>
				elm = this.getElements("x" + infix + "_Clients");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $local_authority_add->Clients->caption(), $local_authority_add->Clients->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($local_authority_add->Beneficiaries->Required) { ?>
				elm = this.getElements("x" + infix + "_Beneficiaries");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $local_authority_add->Beneficiaries->caption(), $local_authority_add->Beneficiaries->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($local_authority_add->ExecutiveAuthority->Required) { ?>
				elm = this.getElements("x" + infix + "_ExecutiveAuthority");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $local_authority_add->ExecutiveAuthority->caption(), $local_authority_add->ExecutiveAuthority->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($local_authority_add->ControllingOfficer->Required) { ?>
				elm = this.getElements("x" + infix + "_ControllingOfficer");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $local_authority_add->ControllingOfficer->caption(), $local_authority_add->ControllingOfficer->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($local_authority_add->Comment->Required) { ?>
				elm = this.getElements("x" + infix + "_Comment");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $local_authority_add->Comment->caption(), $local_authority_add->Comment->RequiredErrorMessage)) ?>");
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
	flocal_authorityadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	flocal_authorityadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	flocal_authorityadd.lists["x_CouncilType"] = <?php echo $local_authority_add->CouncilType->Lookup->toClientList($local_authority_add) ?>;
	flocal_authorityadd.lists["x_CouncilType"].options = <?php echo JsonEncode($local_authority_add->CouncilType->lookupOptions()) ?>;
	flocal_authorityadd.lists["x_ProvinceCode"] = <?php echo $local_authority_add->ProvinceCode->Lookup->toClientList($local_authority_add) ?>;
	flocal_authorityadd.lists["x_ProvinceCode"].options = <?php echo JsonEncode($local_authority_add->ProvinceCode->lookupOptions()) ?>;
	loadjs.done("flocal_authorityadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $local_authority_add->showPageHeader(); ?>
<?php
$local_authority_add->showMessage();
?>
<form name="flocal_authorityadd" id="flocal_authorityadd" class="<?php echo $local_authority_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="local_authority">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$local_authority_add->IsModal ?>">
<?php if ($local_authority->getCurrentMasterTable() == "province") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="province">
<input type="hidden" name="fk_ProvinceCode" value="<?php echo HtmlEncode($local_authority_add->ProvinceCode->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($local_authority_add->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label id="elh_local_authority_LACode" for="x_LACode" class="<?php echo $local_authority_add->LeftColumnClass ?>"><?php echo $local_authority_add->LACode->caption() ?><?php echo $local_authority_add->LACode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $local_authority_add->RightColumnClass ?>"><div <?php echo $local_authority_add->LACode->cellAttributes() ?>>
<span id="el_local_authority_LACode">
<input type="text" data-table="local_authority" data-field="x_LACode" name="x_LACode" id="x_LACode" size="30" placeholder="<?php echo HtmlEncode($local_authority_add->LACode->getPlaceHolder()) ?>" value="<?php echo $local_authority_add->LACode->EditValue ?>"<?php echo $local_authority_add->LACode->editAttributes() ?>>
</span>
<?php echo $local_authority_add->LACode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($local_authority_add->LAName->Visible) { // LAName ?>
	<div id="r_LAName" class="form-group row">
		<label id="elh_local_authority_LAName" for="x_LAName" class="<?php echo $local_authority_add->LeftColumnClass ?>"><?php echo $local_authority_add->LAName->caption() ?><?php echo $local_authority_add->LAName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $local_authority_add->RightColumnClass ?>"><div <?php echo $local_authority_add->LAName->cellAttributes() ?>>
<span id="el_local_authority_LAName">
<input type="text" data-table="local_authority" data-field="x_LAName" name="x_LAName" id="x_LAName" size="40" maxlength="40" placeholder="<?php echo HtmlEncode($local_authority_add->LAName->getPlaceHolder()) ?>" value="<?php echo $local_authority_add->LAName->EditValue ?>"<?php echo $local_authority_add->LAName->editAttributes() ?>>
</span>
<?php echo $local_authority_add->LAName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($local_authority_add->CouncilType->Visible) { // CouncilType ?>
	<div id="r_CouncilType" class="form-group row">
		<label id="elh_local_authority_CouncilType" for="x_CouncilType" class="<?php echo $local_authority_add->LeftColumnClass ?>"><?php echo $local_authority_add->CouncilType->caption() ?><?php echo $local_authority_add->CouncilType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $local_authority_add->RightColumnClass ?>"><div <?php echo $local_authority_add->CouncilType->cellAttributes() ?>>
<span id="el_local_authority_CouncilType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="local_authority" data-field="x_CouncilType" data-value-separator="<?php echo $local_authority_add->CouncilType->displayValueSeparatorAttribute() ?>" id="x_CouncilType" name="x_CouncilType"<?php echo $local_authority_add->CouncilType->editAttributes() ?>>
			<?php echo $local_authority_add->CouncilType->selectOptionListHtml("x_CouncilType") ?>
		</select>
</div>
<?php echo $local_authority_add->CouncilType->Lookup->getParamTag($local_authority_add, "p_x_CouncilType") ?>
</span>
<?php echo $local_authority_add->CouncilType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($local_authority_add->ProvinceCode->Visible) { // ProvinceCode ?>
	<div id="r_ProvinceCode" class="form-group row">
		<label id="elh_local_authority_ProvinceCode" for="x_ProvinceCode" class="<?php echo $local_authority_add->LeftColumnClass ?>"><?php echo $local_authority_add->ProvinceCode->caption() ?><?php echo $local_authority_add->ProvinceCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $local_authority_add->RightColumnClass ?>"><div <?php echo $local_authority_add->ProvinceCode->cellAttributes() ?>>
<?php if ($local_authority_add->ProvinceCode->getSessionValue() != "") { ?>
<span id="el_local_authority_ProvinceCode">
<span<?php echo $local_authority_add->ProvinceCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($local_authority_add->ProvinceCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_ProvinceCode" name="x_ProvinceCode" value="<?php echo HtmlEncode($local_authority_add->ProvinceCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_local_authority_ProvinceCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="local_authority" data-field="x_ProvinceCode" data-value-separator="<?php echo $local_authority_add->ProvinceCode->displayValueSeparatorAttribute() ?>" id="x_ProvinceCode" name="x_ProvinceCode"<?php echo $local_authority_add->ProvinceCode->editAttributes() ?>>
			<?php echo $local_authority_add->ProvinceCode->selectOptionListHtml("x_ProvinceCode") ?>
		</select>
</div>
<?php echo $local_authority_add->ProvinceCode->Lookup->getParamTag($local_authority_add, "p_x_ProvinceCode") ?>
</span>
<?php } ?>
<?php echo $local_authority_add->ProvinceCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($local_authority_add->Mandate->Visible) { // Mandate ?>
	<div id="r_Mandate" class="form-group row">
		<label id="elh_local_authority_Mandate" for="x_Mandate" class="<?php echo $local_authority_add->LeftColumnClass ?>"><?php echo $local_authority_add->Mandate->caption() ?><?php echo $local_authority_add->Mandate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $local_authority_add->RightColumnClass ?>"><div <?php echo $local_authority_add->Mandate->cellAttributes() ?>>
<span id="el_local_authority_Mandate">
<textarea data-table="local_authority" data-field="x_Mandate" name="x_Mandate" id="x_Mandate" cols="35" rows="4" placeholder="<?php echo HtmlEncode($local_authority_add->Mandate->getPlaceHolder()) ?>"<?php echo $local_authority_add->Mandate->editAttributes() ?>><?php echo $local_authority_add->Mandate->EditValue ?></textarea>
</span>
<?php echo $local_authority_add->Mandate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($local_authority_add->Strategy->Visible) { // Strategy ?>
	<div id="r_Strategy" class="form-group row">
		<label id="elh_local_authority_Strategy" for="x_Strategy" class="<?php echo $local_authority_add->LeftColumnClass ?>"><?php echo $local_authority_add->Strategy->caption() ?><?php echo $local_authority_add->Strategy->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $local_authority_add->RightColumnClass ?>"><div <?php echo $local_authority_add->Strategy->cellAttributes() ?>>
<span id="el_local_authority_Strategy">
<textarea data-table="local_authority" data-field="x_Strategy" name="x_Strategy" id="x_Strategy" cols="35" rows="4" placeholder="<?php echo HtmlEncode($local_authority_add->Strategy->getPlaceHolder()) ?>"<?php echo $local_authority_add->Strategy->editAttributes() ?>><?php echo $local_authority_add->Strategy->EditValue ?></textarea>
</span>
<?php echo $local_authority_add->Strategy->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($local_authority_add->Clients->Visible) { // Clients ?>
	<div id="r_Clients" class="form-group row">
		<label id="elh_local_authority_Clients" for="x_Clients" class="<?php echo $local_authority_add->LeftColumnClass ?>"><?php echo $local_authority_add->Clients->caption() ?><?php echo $local_authority_add->Clients->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $local_authority_add->RightColumnClass ?>"><div <?php echo $local_authority_add->Clients->cellAttributes() ?>>
<span id="el_local_authority_Clients">
<textarea data-table="local_authority" data-field="x_Clients" name="x_Clients" id="x_Clients" cols="35" rows="2" placeholder="<?php echo HtmlEncode($local_authority_add->Clients->getPlaceHolder()) ?>"<?php echo $local_authority_add->Clients->editAttributes() ?>><?php echo $local_authority_add->Clients->EditValue ?></textarea>
</span>
<?php echo $local_authority_add->Clients->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($local_authority_add->Beneficiaries->Visible) { // Beneficiaries ?>
	<div id="r_Beneficiaries" class="form-group row">
		<label id="elh_local_authority_Beneficiaries" for="x_Beneficiaries" class="<?php echo $local_authority_add->LeftColumnClass ?>"><?php echo $local_authority_add->Beneficiaries->caption() ?><?php echo $local_authority_add->Beneficiaries->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $local_authority_add->RightColumnClass ?>"><div <?php echo $local_authority_add->Beneficiaries->cellAttributes() ?>>
<span id="el_local_authority_Beneficiaries">
<textarea data-table="local_authority" data-field="x_Beneficiaries" name="x_Beneficiaries" id="x_Beneficiaries" cols="35" rows="2" placeholder="<?php echo HtmlEncode($local_authority_add->Beneficiaries->getPlaceHolder()) ?>"<?php echo $local_authority_add->Beneficiaries->editAttributes() ?>><?php echo $local_authority_add->Beneficiaries->EditValue ?></textarea>
</span>
<?php echo $local_authority_add->Beneficiaries->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($local_authority_add->ExecutiveAuthority->Visible) { // ExecutiveAuthority ?>
	<div id="r_ExecutiveAuthority" class="form-group row">
		<label id="elh_local_authority_ExecutiveAuthority" for="x_ExecutiveAuthority" class="<?php echo $local_authority_add->LeftColumnClass ?>"><?php echo $local_authority_add->ExecutiveAuthority->caption() ?><?php echo $local_authority_add->ExecutiveAuthority->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $local_authority_add->RightColumnClass ?>"><div <?php echo $local_authority_add->ExecutiveAuthority->cellAttributes() ?>>
<span id="el_local_authority_ExecutiveAuthority">
<input type="text" data-table="local_authority" data-field="x_ExecutiveAuthority" name="x_ExecutiveAuthority" id="x_ExecutiveAuthority" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($local_authority_add->ExecutiveAuthority->getPlaceHolder()) ?>" value="<?php echo $local_authority_add->ExecutiveAuthority->EditValue ?>"<?php echo $local_authority_add->ExecutiveAuthority->editAttributes() ?>>
</span>
<?php echo $local_authority_add->ExecutiveAuthority->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($local_authority_add->ControllingOfficer->Visible) { // ControllingOfficer ?>
	<div id="r_ControllingOfficer" class="form-group row">
		<label id="elh_local_authority_ControllingOfficer" for="x_ControllingOfficer" class="<?php echo $local_authority_add->LeftColumnClass ?>"><?php echo $local_authority_add->ControllingOfficer->caption() ?><?php echo $local_authority_add->ControllingOfficer->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $local_authority_add->RightColumnClass ?>"><div <?php echo $local_authority_add->ControllingOfficer->cellAttributes() ?>>
<span id="el_local_authority_ControllingOfficer">
<input type="text" data-table="local_authority" data-field="x_ControllingOfficer" name="x_ControllingOfficer" id="x_ControllingOfficer" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($local_authority_add->ControllingOfficer->getPlaceHolder()) ?>" value="<?php echo $local_authority_add->ControllingOfficer->EditValue ?>"<?php echo $local_authority_add->ControllingOfficer->editAttributes() ?>>
</span>
<?php echo $local_authority_add->ControllingOfficer->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($local_authority_add->Comment->Visible) { // Comment ?>
	<div id="r_Comment" class="form-group row">
		<label id="elh_local_authority_Comment" for="x_Comment" class="<?php echo $local_authority_add->LeftColumnClass ?>"><?php echo $local_authority_add->Comment->caption() ?><?php echo $local_authority_add->Comment->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $local_authority_add->RightColumnClass ?>"><div <?php echo $local_authority_add->Comment->cellAttributes() ?>>
<span id="el_local_authority_Comment">
<textarea data-table="local_authority" data-field="x_Comment" name="x_Comment" id="x_Comment" cols="50" rows="4" placeholder="<?php echo HtmlEncode($local_authority_add->Comment->getPlaceHolder()) ?>"<?php echo $local_authority_add->Comment->editAttributes() ?>><?php echo $local_authority_add->Comment->EditValue ?></textarea>
</span>
<?php echo $local_authority_add->Comment->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("department", explode(",", $local_authority->getCurrentDetailTable())) && $department->DetailAdd) {
?>
<?php if ($local_authority->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("department", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "departmentgrid.php" ?>
<?php } ?>
<?php
	if (in_array("council_meeting", explode(",", $local_authority->getCurrentDetailTable())) && $council_meeting->DetailAdd) {
?>
<?php if ($local_authority->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("council_meeting", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "council_meetinggrid.php" ?>
<?php } ?>
<?php
	if (in_array("asset", explode(",", $local_authority->getCurrentDetailTable())) && $asset->DetailAdd) {
?>
<?php if ($local_authority->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("asset", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "assetgrid.php" ?>
<?php } ?>
<?php
	if (in_array("ward", explode(",", $local_authority->getCurrentDetailTable())) && $ward->DetailAdd) {
?>
<?php if ($local_authority->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("ward", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "wardgrid.php" ?>
<?php } ?>
<?php
	if (in_array("budget_actual", explode(",", $local_authority->getCurrentDetailTable())) && $budget_actual->DetailAdd) {
?>
<?php if ($local_authority->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("budget_actual", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "budget_actualgrid.php" ?>
<?php } ?>
<?php
	if (in_array("councillorship", explode(",", $local_authority->getCurrentDetailTable())) && $councillorship->DetailAdd) {
?>
<?php if ($local_authority->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("councillorship", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "councillorshipgrid.php" ?>
<?php } ?>
<?php
	if (in_array("monthly_run", explode(",", $local_authority->getCurrentDetailTable())) && $monthly_run->DetailAdd) {
?>
<?php if ($local_authority->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("monthly_run", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "monthly_rungrid.php" ?>
<?php } ?>
<?php
	if (in_array("project", explode(",", $local_authority->getCurrentDetailTable())) && $project->DetailAdd) {
?>
<?php if ($local_authority->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("project", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "projectgrid.php" ?>
<?php } ?>
<?php
	if (in_array("la_bank_account", explode(",", $local_authority->getCurrentDetailTable())) && $la_bank_account->DetailAdd) {
?>
<?php if ($local_authority->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("la_bank_account", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "la_bank_accountgrid.php" ?>
<?php } ?>
<?php
	if (in_array("strategic_objective", explode(",", $local_authority->getCurrentDetailTable())) && $strategic_objective->DetailAdd) {
?>
<?php if ($local_authority->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("strategic_objective", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "strategic_objectivegrid.php" ?>
<?php } ?>
<?php if (!$local_authority_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $local_authority_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $local_authority_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$local_authority_add->showPageFooter();
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
$local_authority_add->terminate();
?>