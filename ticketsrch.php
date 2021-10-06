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
$ticket_search = new ticket_search();

// Run the page
$ticket_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ticket_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fticketsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($ticket_search->IsModal) { ?>
	fticketsearch = currentAdvancedSearchForm = new ew.Form("fticketsearch", "search");
	<?php } else { ?>
	fticketsearch = currentForm = new ew.Form("fticketsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fticketsearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_TicketReportDate");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($ticket_search->TicketReportDate->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_IncidentDate");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($ticket_search->IncidentDate->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_IncidentTime");
		if (elm && !ew.checkTime(elm.value))
			return this.onError(elm, "<?php echo JsEncode($ticket_search->IncidentTime->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_TicketCategory");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($ticket_search->TicketCategory->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_TicketNumber");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($ticket_search->TicketNumber->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_TicketLevel");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($ticket_search->TicketLevel->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_Days");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($ticket_search->Days->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_DataLastUpdated");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($ticket_search->DataLastUpdated->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fticketsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fticketsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fticketsearch.lists["x_TicketCategory"] = <?php echo $ticket_search->TicketCategory->Lookup->toClientList($ticket_search) ?>;
	fticketsearch.lists["x_TicketCategory"].options = <?php echo JsonEncode($ticket_search->TicketCategory->lookupOptions()) ?>;
	fticketsearch.autoSuggests["x_TicketCategory"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fticketsearch.lists["x_TicketType"] = <?php echo $ticket_search->TicketType->Lookup->toClientList($ticket_search) ?>;
	fticketsearch.lists["x_TicketType"].options = <?php echo JsonEncode($ticket_search->TicketType->lookupOptions()) ?>;
	fticketsearch.lists["x_ReportedBy"] = <?php echo $ticket_search->ReportedBy->Lookup->toClientList($ticket_search) ?>;
	fticketsearch.lists["x_ReportedBy"].options = <?php echo JsonEncode($ticket_search->ReportedBy->lookupOptions()) ?>;
	fticketsearch.lists["x_TicketStatus"] = <?php echo $ticket_search->TicketStatus->Lookup->toClientList($ticket_search) ?>;
	fticketsearch.lists["x_TicketStatus"].options = <?php echo JsonEncode($ticket_search->TicketStatus->lookupOptions()) ?>;
	fticketsearch.lists["x_ProvinceCode"] = <?php echo $ticket_search->ProvinceCode->Lookup->toClientList($ticket_search) ?>;
	fticketsearch.lists["x_ProvinceCode"].options = <?php echo JsonEncode($ticket_search->ProvinceCode->lookupOptions()) ?>;
	fticketsearch.lists["x_LACode"] = <?php echo $ticket_search->LACode->Lookup->toClientList($ticket_search) ?>;
	fticketsearch.lists["x_LACode"].options = <?php echo JsonEncode($ticket_search->LACode->lookupOptions()) ?>;
	fticketsearch.lists["x_DepartmentCode"] = <?php echo $ticket_search->DepartmentCode->Lookup->toClientList($ticket_search) ?>;
	fticketsearch.lists["x_DepartmentCode"].options = <?php echo JsonEncode($ticket_search->DepartmentCode->lookupOptions()) ?>;
	fticketsearch.lists["x_AllocatedTo"] = <?php echo $ticket_search->AllocatedTo->Lookup->toClientList($ticket_search) ?>;
	fticketsearch.lists["x_AllocatedTo"].options = <?php echo JsonEncode($ticket_search->AllocatedTo->lookupOptions()) ?>;
	fticketsearch.lists["x_EscalatedTo"] = <?php echo $ticket_search->EscalatedTo->Lookup->toClientList($ticket_search) ?>;
	fticketsearch.lists["x_EscalatedTo"].options = <?php echo JsonEncode($ticket_search->EscalatedTo->lookupOptions()) ?>;
	fticketsearch.lists["x_SeverityLevel"] = <?php echo $ticket_search->SeverityLevel->Lookup->toClientList($ticket_search) ?>;
	fticketsearch.lists["x_SeverityLevel"].options = <?php echo JsonEncode($ticket_search->SeverityLevel->lookupOptions()) ?>;
	loadjs.done("fticketsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $ticket_search->showPageHeader(); ?>
<?php
$ticket_search->showMessage();
?>
<form name="fticketsearch" id="fticketsearch" class="<?php echo $ticket_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ticket">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$ticket_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($ticket_search->Subject->Visible) { // Subject ?>
	<div id="r_Subject" class="form-group row">
		<label for="x_Subject" class="<?php echo $ticket_search->LeftColumnClass ?>"><span id="elh_ticket_Subject"><?php echo $ticket_search->Subject->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Subject" id="z_Subject" value="LIKE">
</span>
		</label>
		<div class="<?php echo $ticket_search->RightColumnClass ?>"><div <?php echo $ticket_search->Subject->cellAttributes() ?>>
			<span id="el_ticket_Subject" class="ew-search-field">
<input type="text" data-table="ticket" data-field="x_Subject" name="x_Subject" id="x_Subject" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($ticket_search->Subject->getPlaceHolder()) ?>" value="<?php echo $ticket_search->Subject->EditValue ?>"<?php echo $ticket_search->Subject->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($ticket_search->TicketReportDate->Visible) { // TicketReportDate ?>
	<div id="r_TicketReportDate" class="form-group row">
		<label for="x_TicketReportDate" class="<?php echo $ticket_search->LeftColumnClass ?>"><span id="elh_ticket_TicketReportDate"><?php echo $ticket_search->TicketReportDate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_TicketReportDate" id="z_TicketReportDate" value="=">
</span>
		</label>
		<div class="<?php echo $ticket_search->RightColumnClass ?>"><div <?php echo $ticket_search->TicketReportDate->cellAttributes() ?>>
			<span id="el_ticket_TicketReportDate" class="ew-search-field">
<input type="text" data-table="ticket" data-field="x_TicketReportDate" name="x_TicketReportDate" id="x_TicketReportDate" placeholder="<?php echo HtmlEncode($ticket_search->TicketReportDate->getPlaceHolder()) ?>" value="<?php echo $ticket_search->TicketReportDate->EditValue ?>"<?php echo $ticket_search->TicketReportDate->editAttributes() ?>>
<?php if (!$ticket_search->TicketReportDate->ReadOnly && !$ticket_search->TicketReportDate->Disabled && !isset($ticket_search->TicketReportDate->EditAttrs["readonly"]) && !isset($ticket_search->TicketReportDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fticketsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fticketsearch", "x_TicketReportDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($ticket_search->IncidentDate->Visible) { // IncidentDate ?>
	<div id="r_IncidentDate" class="form-group row">
		<label for="x_IncidentDate" class="<?php echo $ticket_search->LeftColumnClass ?>"><span id="elh_ticket_IncidentDate"><?php echo $ticket_search->IncidentDate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_IncidentDate" id="z_IncidentDate" value="=">
</span>
		</label>
		<div class="<?php echo $ticket_search->RightColumnClass ?>"><div <?php echo $ticket_search->IncidentDate->cellAttributes() ?>>
			<span id="el_ticket_IncidentDate" class="ew-search-field">
<input type="text" data-table="ticket" data-field="x_IncidentDate" name="x_IncidentDate" id="x_IncidentDate" placeholder="<?php echo HtmlEncode($ticket_search->IncidentDate->getPlaceHolder()) ?>" value="<?php echo $ticket_search->IncidentDate->EditValue ?>"<?php echo $ticket_search->IncidentDate->editAttributes() ?>>
<?php if (!$ticket_search->IncidentDate->ReadOnly && !$ticket_search->IncidentDate->Disabled && !isset($ticket_search->IncidentDate->EditAttrs["readonly"]) && !isset($ticket_search->IncidentDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fticketsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fticketsearch", "x_IncidentDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($ticket_search->IncidentTime->Visible) { // IncidentTime ?>
	<div id="r_IncidentTime" class="form-group row">
		<label for="x_IncidentTime" class="<?php echo $ticket_search->LeftColumnClass ?>"><span id="elh_ticket_IncidentTime"><?php echo $ticket_search->IncidentTime->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_IncidentTime" id="z_IncidentTime" value="=">
</span>
		</label>
		<div class="<?php echo $ticket_search->RightColumnClass ?>"><div <?php echo $ticket_search->IncidentTime->cellAttributes() ?>>
			<span id="el_ticket_IncidentTime" class="ew-search-field">
<input type="text" data-table="ticket" data-field="x_IncidentTime" name="x_IncidentTime" id="x_IncidentTime" placeholder="<?php echo HtmlEncode($ticket_search->IncidentTime->getPlaceHolder()) ?>" value="<?php echo $ticket_search->IncidentTime->EditValue ?>"<?php echo $ticket_search->IncidentTime->editAttributes() ?>>
<?php if (!$ticket_search->IncidentTime->ReadOnly && !$ticket_search->IncidentTime->Disabled && !isset($ticket_search->IncidentTime->EditAttrs["readonly"]) && !isset($ticket_search->IncidentTime->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fticketsearch", "timepicker"], function() {
	ew.createTimePicker("fticketsearch", "x_IncidentTime", {"timeFormat":"H:i:s","step":15});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($ticket_search->TicketDescription->Visible) { // TicketDescription ?>
	<div id="r_TicketDescription" class="form-group row">
		<label for="x_TicketDescription" class="<?php echo $ticket_search->LeftColumnClass ?>"><span id="elh_ticket_TicketDescription"><?php echo $ticket_search->TicketDescription->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_TicketDescription" id="z_TicketDescription" value="LIKE">
</span>
		</label>
		<div class="<?php echo $ticket_search->RightColumnClass ?>"><div <?php echo $ticket_search->TicketDescription->cellAttributes() ?>>
			<span id="el_ticket_TicketDescription" class="ew-search-field">
<input type="text" data-table="ticket" data-field="x_TicketDescription" name="x_TicketDescription" id="x_TicketDescription" size="35" placeholder="<?php echo HtmlEncode($ticket_search->TicketDescription->getPlaceHolder()) ?>" value="<?php echo $ticket_search->TicketDescription->EditValue ?>"<?php echo $ticket_search->TicketDescription->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($ticket_search->TicketCategory->Visible) { // TicketCategory ?>
	<div id="r_TicketCategory" class="form-group row">
		<label class="<?php echo $ticket_search->LeftColumnClass ?>"><span id="elh_ticket_TicketCategory"><?php echo $ticket_search->TicketCategory->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_TicketCategory" id="z_TicketCategory" value="=">
</span>
		</label>
		<div class="<?php echo $ticket_search->RightColumnClass ?>"><div <?php echo $ticket_search->TicketCategory->cellAttributes() ?>>
			<span id="el_ticket_TicketCategory" class="ew-search-field">
<?php
$onchange = $ticket_search->TicketCategory->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$ticket_search->TicketCategory->EditAttrs["onchange"] = "";
?>
<span id="as_x_TicketCategory">
	<input type="text" class="form-control" name="sv_x_TicketCategory" id="sv_x_TicketCategory" value="<?php echo RemoveHtml($ticket_search->TicketCategory->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($ticket_search->TicketCategory->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($ticket_search->TicketCategory->getPlaceHolder()) ?>"<?php echo $ticket_search->TicketCategory->editAttributes() ?>>
</span>
<input type="hidden" data-table="ticket" data-field="x_TicketCategory" data-value-separator="<?php echo $ticket_search->TicketCategory->displayValueSeparatorAttribute() ?>" name="x_TicketCategory" id="x_TicketCategory" value="<?php echo HtmlEncode($ticket_search->TicketCategory->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fticketsearch"], function() {
	fticketsearch.createAutoSuggest({"id":"x_TicketCategory","forceSelect":false});
});
</script>
<?php echo $ticket_search->TicketCategory->Lookup->getParamTag($ticket_search, "p_x_TicketCategory") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($ticket_search->TicketType->Visible) { // TicketType ?>
	<div id="r_TicketType" class="form-group row">
		<label for="x_TicketType" class="<?php echo $ticket_search->LeftColumnClass ?>"><span id="elh_ticket_TicketType"><?php echo $ticket_search->TicketType->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_TicketType" id="z_TicketType" value="=">
</span>
		</label>
		<div class="<?php echo $ticket_search->RightColumnClass ?>"><div <?php echo $ticket_search->TicketType->cellAttributes() ?>>
			<span id="el_ticket_TicketType" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ticket" data-field="x_TicketType" data-value-separator="<?php echo $ticket_search->TicketType->displayValueSeparatorAttribute() ?>" id="x_TicketType" name="x_TicketType"<?php echo $ticket_search->TicketType->editAttributes() ?>>
			<?php echo $ticket_search->TicketType->selectOptionListHtml("x_TicketType") ?>
		</select>
</div>
<?php echo $ticket_search->TicketType->Lookup->getParamTag($ticket_search, "p_x_TicketType") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($ticket_search->ReportedBy->Visible) { // ReportedBy ?>
	<div id="r_ReportedBy" class="form-group row">
		<label for="x_ReportedBy" class="<?php echo $ticket_search->LeftColumnClass ?>"><span id="elh_ticket_ReportedBy"><?php echo $ticket_search->ReportedBy->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ReportedBy" id="z_ReportedBy" value="=">
</span>
		</label>
		<div class="<?php echo $ticket_search->RightColumnClass ?>"><div <?php echo $ticket_search->ReportedBy->cellAttributes() ?>>
			<span id="el_ticket_ReportedBy" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_ReportedBy"><?php echo EmptyValue(strval($ticket_search->ReportedBy->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $ticket_search->ReportedBy->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($ticket_search->ReportedBy->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($ticket_search->ReportedBy->ReadOnly || $ticket_search->ReportedBy->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_ReportedBy',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $ticket_search->ReportedBy->Lookup->getParamTag($ticket_search, "p_x_ReportedBy") ?>
<input type="hidden" data-table="ticket" data-field="x_ReportedBy" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $ticket_search->ReportedBy->displayValueSeparatorAttribute() ?>" name="x_ReportedBy" id="x_ReportedBy" value="<?php echo $ticket_search->ReportedBy->AdvancedSearch->SearchValue ?>"<?php echo $ticket_search->ReportedBy->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($ticket_search->TicketStatus->Visible) { // TicketStatus ?>
	<div id="r_TicketStatus" class="form-group row">
		<label for="x_TicketStatus" class="<?php echo $ticket_search->LeftColumnClass ?>"><span id="elh_ticket_TicketStatus"><?php echo $ticket_search->TicketStatus->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_TicketStatus" id="z_TicketStatus" value="=">
</span>
		</label>
		<div class="<?php echo $ticket_search->RightColumnClass ?>"><div <?php echo $ticket_search->TicketStatus->cellAttributes() ?>>
			<span id="el_ticket_TicketStatus" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ticket" data-field="x_TicketStatus" data-value-separator="<?php echo $ticket_search->TicketStatus->displayValueSeparatorAttribute() ?>" id="x_TicketStatus" name="x_TicketStatus"<?php echo $ticket_search->TicketStatus->editAttributes() ?>>
			<?php echo $ticket_search->TicketStatus->selectOptionListHtml("x_TicketStatus") ?>
		</select>
</div>
<?php echo $ticket_search->TicketStatus->Lookup->getParamTag($ticket_search, "p_x_TicketStatus") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($ticket_search->TicketNumber->Visible) { // TicketNumber ?>
	<div id="r_TicketNumber" class="form-group row">
		<label for="x_TicketNumber" class="<?php echo $ticket_search->LeftColumnClass ?>"><span id="elh_ticket_TicketNumber"><?php echo $ticket_search->TicketNumber->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_TicketNumber" id="z_TicketNumber" value="=">
</span>
		</label>
		<div class="<?php echo $ticket_search->RightColumnClass ?>"><div <?php echo $ticket_search->TicketNumber->cellAttributes() ?>>
			<span id="el_ticket_TicketNumber" class="ew-search-field">
<input type="text" data-table="ticket" data-field="x_TicketNumber" name="x_TicketNumber" id="x_TicketNumber" placeholder="<?php echo HtmlEncode($ticket_search->TicketNumber->getPlaceHolder()) ?>" value="<?php echo $ticket_search->TicketNumber->EditValue ?>"<?php echo $ticket_search->TicketNumber->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($ticket_search->ReporterEmail->Visible) { // ReporterEmail ?>
	<div id="r_ReporterEmail" class="form-group row">
		<label for="x_ReporterEmail" class="<?php echo $ticket_search->LeftColumnClass ?>"><span id="elh_ticket_ReporterEmail"><?php echo $ticket_search->ReporterEmail->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ReporterEmail" id="z_ReporterEmail" value="LIKE">
</span>
		</label>
		<div class="<?php echo $ticket_search->RightColumnClass ?>"><div <?php echo $ticket_search->ReporterEmail->cellAttributes() ?>>
			<span id="el_ticket_ReporterEmail" class="ew-search-field">
<input type="text" data-table="ticket" data-field="x_ReporterEmail" name="x_ReporterEmail" id="x_ReporterEmail" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($ticket_search->ReporterEmail->getPlaceHolder()) ?>" value="<?php echo $ticket_search->ReporterEmail->EditValue ?>"<?php echo $ticket_search->ReporterEmail->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($ticket_search->ReporterMobile->Visible) { // ReporterMobile ?>
	<div id="r_ReporterMobile" class="form-group row">
		<label for="x_ReporterMobile" class="<?php echo $ticket_search->LeftColumnClass ?>"><span id="elh_ticket_ReporterMobile"><?php echo $ticket_search->ReporterMobile->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ReporterMobile" id="z_ReporterMobile" value="LIKE">
</span>
		</label>
		<div class="<?php echo $ticket_search->RightColumnClass ?>"><div <?php echo $ticket_search->ReporterMobile->cellAttributes() ?>>
			<span id="el_ticket_ReporterMobile" class="ew-search-field">
<input type="text" data-table="ticket" data-field="x_ReporterMobile" name="x_ReporterMobile" id="x_ReporterMobile" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($ticket_search->ReporterMobile->getPlaceHolder()) ?>" value="<?php echo $ticket_search->ReporterMobile->EditValue ?>"<?php echo $ticket_search->ReporterMobile->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($ticket_search->ProvinceCode->Visible) { // ProvinceCode ?>
	<div id="r_ProvinceCode" class="form-group row">
		<label for="x_ProvinceCode" class="<?php echo $ticket_search->LeftColumnClass ?>"><span id="elh_ticket_ProvinceCode"><?php echo $ticket_search->ProvinceCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ProvinceCode" id="z_ProvinceCode" value="=">
</span>
		</label>
		<div class="<?php echo $ticket_search->RightColumnClass ?>"><div <?php echo $ticket_search->ProvinceCode->cellAttributes() ?>>
			<span id="el_ticket_ProvinceCode" class="ew-search-field">
<?php $ticket_search->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ticket" data-field="x_ProvinceCode" data-value-separator="<?php echo $ticket_search->ProvinceCode->displayValueSeparatorAttribute() ?>" id="x_ProvinceCode" name="x_ProvinceCode"<?php echo $ticket_search->ProvinceCode->editAttributes() ?>>
			<?php echo $ticket_search->ProvinceCode->selectOptionListHtml("x_ProvinceCode") ?>
		</select>
</div>
<?php echo $ticket_search->ProvinceCode->Lookup->getParamTag($ticket_search, "p_x_ProvinceCode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($ticket_search->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label for="x_LACode" class="<?php echo $ticket_search->LeftColumnClass ?>"><span id="elh_ticket_LACode"><?php echo $ticket_search->LACode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_LACode" id="z_LACode" value="LIKE">
</span>
		</label>
		<div class="<?php echo $ticket_search->RightColumnClass ?>"><div <?php echo $ticket_search->LACode->cellAttributes() ?>>
			<span id="el_ticket_LACode" class="ew-search-field">
<?php $ticket_search->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_LACode"><?php echo EmptyValue(strval($ticket_search->LACode->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $ticket_search->LACode->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($ticket_search->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($ticket_search->LACode->ReadOnly || $ticket_search->LACode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_LACode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $ticket_search->LACode->Lookup->getParamTag($ticket_search, "p_x_LACode") ?>
<input type="hidden" data-table="ticket" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $ticket_search->LACode->displayValueSeparatorAttribute() ?>" name="x_LACode" id="x_LACode" value="<?php echo $ticket_search->LACode->AdvancedSearch->SearchValue ?>"<?php echo $ticket_search->LACode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($ticket_search->DepartmentCode->Visible) { // DepartmentCode ?>
	<div id="r_DepartmentCode" class="form-group row">
		<label for="x_DepartmentCode" class="<?php echo $ticket_search->LeftColumnClass ?>"><span id="elh_ticket_DepartmentCode"><?php echo $ticket_search->DepartmentCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_DepartmentCode" id="z_DepartmentCode" value="=">
</span>
		</label>
		<div class="<?php echo $ticket_search->RightColumnClass ?>"><div <?php echo $ticket_search->DepartmentCode->cellAttributes() ?>>
			<span id="el_ticket_DepartmentCode" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_DepartmentCode"><?php echo EmptyValue(strval($ticket_search->DepartmentCode->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $ticket_search->DepartmentCode->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($ticket_search->DepartmentCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($ticket_search->DepartmentCode->ReadOnly || $ticket_search->DepartmentCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_DepartmentCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $ticket_search->DepartmentCode->Lookup->getParamTag($ticket_search, "p_x_DepartmentCode") ?>
<input type="hidden" data-table="ticket" data-field="x_DepartmentCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $ticket_search->DepartmentCode->displayValueSeparatorAttribute() ?>" name="x_DepartmentCode" id="x_DepartmentCode" value="<?php echo $ticket_search->DepartmentCode->AdvancedSearch->SearchValue ?>"<?php echo $ticket_search->DepartmentCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($ticket_search->DeptSection->Visible) { // DeptSection ?>
	<div id="r_DeptSection" class="form-group row">
		<label for="x_DeptSection" class="<?php echo $ticket_search->LeftColumnClass ?>"><span id="elh_ticket_DeptSection"><?php echo $ticket_search->DeptSection->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_DeptSection" id="z_DeptSection" value="=">
</span>
		</label>
		<div class="<?php echo $ticket_search->RightColumnClass ?>"><div <?php echo $ticket_search->DeptSection->cellAttributes() ?>>
			<span id="el_ticket_DeptSection" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ticket" data-field="x_DeptSection" data-value-separator="<?php echo $ticket_search->DeptSection->displayValueSeparatorAttribute() ?>" id="x_DeptSection" name="x_DeptSection"<?php echo $ticket_search->DeptSection->editAttributes() ?>>
			<?php echo $ticket_search->DeptSection->selectOptionListHtml("x_DeptSection") ?>
		</select>
</div>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($ticket_search->TicketLevel->Visible) { // TicketLevel ?>
	<div id="r_TicketLevel" class="form-group row">
		<label for="x_TicketLevel" class="<?php echo $ticket_search->LeftColumnClass ?>"><span id="elh_ticket_TicketLevel"><?php echo $ticket_search->TicketLevel->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_TicketLevel" id="z_TicketLevel" value="=">
</span>
		</label>
		<div class="<?php echo $ticket_search->RightColumnClass ?>"><div <?php echo $ticket_search->TicketLevel->cellAttributes() ?>>
			<span id="el_ticket_TicketLevel" class="ew-search-field">
<input type="text" data-table="ticket" data-field="x_TicketLevel" name="x_TicketLevel" id="x_TicketLevel" size="30" placeholder="<?php echo HtmlEncode($ticket_search->TicketLevel->getPlaceHolder()) ?>" value="<?php echo $ticket_search->TicketLevel->EditValue ?>"<?php echo $ticket_search->TicketLevel->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($ticket_search->AllocatedTo->Visible) { // AllocatedTo ?>
	<div id="r_AllocatedTo" class="form-group row">
		<label for="x_AllocatedTo" class="<?php echo $ticket_search->LeftColumnClass ?>"><span id="elh_ticket_AllocatedTo"><?php echo $ticket_search->AllocatedTo->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_AllocatedTo" id="z_AllocatedTo" value="=">
</span>
		</label>
		<div class="<?php echo $ticket_search->RightColumnClass ?>"><div <?php echo $ticket_search->AllocatedTo->cellAttributes() ?>>
			<span id="el_ticket_AllocatedTo" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_AllocatedTo"><?php echo EmptyValue(strval($ticket_search->AllocatedTo->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $ticket_search->AllocatedTo->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($ticket_search->AllocatedTo->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($ticket_search->AllocatedTo->ReadOnly || $ticket_search->AllocatedTo->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_AllocatedTo',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $ticket_search->AllocatedTo->Lookup->getParamTag($ticket_search, "p_x_AllocatedTo") ?>
<input type="hidden" data-table="ticket" data-field="x_AllocatedTo" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $ticket_search->AllocatedTo->displayValueSeparatorAttribute() ?>" name="x_AllocatedTo" id="x_AllocatedTo" value="<?php echo $ticket_search->AllocatedTo->AdvancedSearch->SearchValue ?>"<?php echo $ticket_search->AllocatedTo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($ticket_search->EscalatedTo->Visible) { // EscalatedTo ?>
	<div id="r_EscalatedTo" class="form-group row">
		<label for="x_EscalatedTo" class="<?php echo $ticket_search->LeftColumnClass ?>"><span id="elh_ticket_EscalatedTo"><?php echo $ticket_search->EscalatedTo->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_EscalatedTo" id="z_EscalatedTo" value="=">
</span>
		</label>
		<div class="<?php echo $ticket_search->RightColumnClass ?>"><div <?php echo $ticket_search->EscalatedTo->cellAttributes() ?>>
			<span id="el_ticket_EscalatedTo" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_EscalatedTo"><?php echo EmptyValue(strval($ticket_search->EscalatedTo->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $ticket_search->EscalatedTo->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($ticket_search->EscalatedTo->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($ticket_search->EscalatedTo->ReadOnly || $ticket_search->EscalatedTo->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_EscalatedTo',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $ticket_search->EscalatedTo->Lookup->getParamTag($ticket_search, "p_x_EscalatedTo") ?>
<input type="hidden" data-table="ticket" data-field="x_EscalatedTo" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $ticket_search->EscalatedTo->displayValueSeparatorAttribute() ?>" name="x_EscalatedTo" id="x_EscalatedTo" value="<?php echo $ticket_search->EscalatedTo->AdvancedSearch->SearchValue ?>"<?php echo $ticket_search->EscalatedTo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($ticket_search->TicketSolution->Visible) { // TicketSolution ?>
	<div id="r_TicketSolution" class="form-group row">
		<label for="x_TicketSolution" class="<?php echo $ticket_search->LeftColumnClass ?>"><span id="elh_ticket_TicketSolution"><?php echo $ticket_search->TicketSolution->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_TicketSolution" id="z_TicketSolution" value="LIKE">
</span>
		</label>
		<div class="<?php echo $ticket_search->RightColumnClass ?>"><div <?php echo $ticket_search->TicketSolution->cellAttributes() ?>>
			<span id="el_ticket_TicketSolution" class="ew-search-field">
<input type="text" data-table="ticket" data-field="x_TicketSolution" name="x_TicketSolution" id="x_TicketSolution" size="35" maxlength="255" placeholder="<?php echo HtmlEncode($ticket_search->TicketSolution->getPlaceHolder()) ?>" value="<?php echo $ticket_search->TicketSolution->EditValue ?>"<?php echo $ticket_search->TicketSolution->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($ticket_search->SeverityLevel->Visible) { // SeverityLevel ?>
	<div id="r_SeverityLevel" class="form-group row">
		<label for="x_SeverityLevel" class="<?php echo $ticket_search->LeftColumnClass ?>"><span id="elh_ticket_SeverityLevel"><?php echo $ticket_search->SeverityLevel->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_SeverityLevel" id="z_SeverityLevel" value="=">
</span>
		</label>
		<div class="<?php echo $ticket_search->RightColumnClass ?>"><div <?php echo $ticket_search->SeverityLevel->cellAttributes() ?>>
			<span id="el_ticket_SeverityLevel" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ticket" data-field="x_SeverityLevel" data-value-separator="<?php echo $ticket_search->SeverityLevel->displayValueSeparatorAttribute() ?>" id="x_SeverityLevel" name="x_SeverityLevel"<?php echo $ticket_search->SeverityLevel->editAttributes() ?>>
			<?php echo $ticket_search->SeverityLevel->selectOptionListHtml("x_SeverityLevel") ?>
		</select>
</div>
<?php echo $ticket_search->SeverityLevel->Lookup->getParamTag($ticket_search, "p_x_SeverityLevel") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($ticket_search->Days->Visible) { // Days ?>
	<div id="r_Days" class="form-group row">
		<label for="x_Days" class="<?php echo $ticket_search->LeftColumnClass ?>"><span id="elh_ticket_Days"><?php echo $ticket_search->Days->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Days" id="z_Days" value="=">
</span>
		</label>
		<div class="<?php echo $ticket_search->RightColumnClass ?>"><div <?php echo $ticket_search->Days->cellAttributes() ?>>
			<span id="el_ticket_Days" class="ew-search-field">
<input type="text" data-table="ticket" data-field="x_Days" name="x_Days" id="x_Days" size="30" placeholder="<?php echo HtmlEncode($ticket_search->Days->getPlaceHolder()) ?>" value="<?php echo $ticket_search->Days->EditValue ?>"<?php echo $ticket_search->Days->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($ticket_search->DataLastUpdated->Visible) { // DataLastUpdated ?>
	<div id="r_DataLastUpdated" class="form-group row">
		<label for="x_DataLastUpdated" class="<?php echo $ticket_search->LeftColumnClass ?>"><span id="elh_ticket_DataLastUpdated"><?php echo $ticket_search->DataLastUpdated->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_DataLastUpdated" id="z_DataLastUpdated" value="=">
</span>
		</label>
		<div class="<?php echo $ticket_search->RightColumnClass ?>"><div <?php echo $ticket_search->DataLastUpdated->cellAttributes() ?>>
			<span id="el_ticket_DataLastUpdated" class="ew-search-field">
<input type="text" data-table="ticket" data-field="x_DataLastUpdated" name="x_DataLastUpdated" id="x_DataLastUpdated" placeholder="<?php echo HtmlEncode($ticket_search->DataLastUpdated->getPlaceHolder()) ?>" value="<?php echo $ticket_search->DataLastUpdated->EditValue ?>"<?php echo $ticket_search->DataLastUpdated->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$ticket_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $ticket_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$ticket_search->showPageFooter();
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
$ticket_search->terminate();
?>