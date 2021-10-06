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
$ticketmessage_add = new ticketmessage_add();

// Run the page
$ticketmessage_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ticketmessage_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fticketmessageadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fticketmessageadd = currentForm = new ew.Form("fticketmessageadd", "add");

	// Validate form
	fticketmessageadd.validate = function() {
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
			<?php if ($ticketmessage_add->TicketNumber->Required) { ?>
				elm = this.getElements("x" + infix + "_TicketNumber");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticketmessage_add->TicketNumber->caption(), $ticketmessage_add->TicketNumber->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_TicketNumber");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ticketmessage_add->TicketNumber->errorMessage()) ?>");
			<?php if ($ticketmessage_add->MessageBy->Required) { ?>
				elm = this.getElements("x" + infix + "_MessageBy");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticketmessage_add->MessageBy->caption(), $ticketmessage_add->MessageBy->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_MessageBy");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ticketmessage_add->MessageBy->errorMessage()) ?>");
			<?php if ($ticketmessage_add->Subject->Required) { ?>
				elm = this.getElements("x" + infix + "_Subject");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticketmessage_add->Subject->caption(), $ticketmessage_add->Subject->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ticketmessage_add->Message->Required) { ?>
				elm = this.getElements("x" + infix + "_Message");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticketmessage_add->Message->caption(), $ticketmessage_add->Message->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ticketmessage_add->MessageDate->Required) { ?>
				elm = this.getElements("x" + infix + "_MessageDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticketmessage_add->MessageDate->caption(), $ticketmessage_add->MessageDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_MessageDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ticketmessage_add->MessageDate->errorMessage()) ?>");
			<?php if ($ticketmessage_add->Attachment->Required) { ?>
				felm = this.getElements("x" + infix + "_Attachment");
				elm = this.getElements("fn_x" + infix + "_Attachment");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $ticketmessage_add->Attachment->caption(), $ticketmessage_add->Attachment->RequiredErrorMessage)) ?>");
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
	fticketmessageadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fticketmessageadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fticketmessageadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $ticketmessage_add->showPageHeader(); ?>
<?php
$ticketmessage_add->showMessage();
?>
<form name="fticketmessageadd" id="fticketmessageadd" class="<?php echo $ticketmessage_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ticketmessage">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$ticketmessage_add->IsModal ?>">
<?php if ($ticketmessage->getCurrentMasterTable() == "ticket") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="ticket">
<input type="hidden" name="fk_TicketNumber" value="<?php echo HtmlEncode($ticketmessage_add->TicketNumber->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($ticketmessage_add->TicketNumber->Visible) { // TicketNumber ?>
	<div id="r_TicketNumber" class="form-group row">
		<label id="elh_ticketmessage_TicketNumber" for="x_TicketNumber" class="<?php echo $ticketmessage_add->LeftColumnClass ?>"><?php echo $ticketmessage_add->TicketNumber->caption() ?><?php echo $ticketmessage_add->TicketNumber->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticketmessage_add->RightColumnClass ?>"><div <?php echo $ticketmessage_add->TicketNumber->cellAttributes() ?>>
<?php if ($ticketmessage_add->TicketNumber->getSessionValue() != "") { ?>
<span id="el_ticketmessage_TicketNumber">
<span<?php echo $ticketmessage_add->TicketNumber->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ticketmessage_add->TicketNumber->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_TicketNumber" name="x_TicketNumber" value="<?php echo HtmlEncode($ticketmessage_add->TicketNumber->CurrentValue) ?>">
<?php } else { ?>
<span id="el_ticketmessage_TicketNumber">
<input type="text" data-table="ticketmessage" data-field="x_TicketNumber" name="x_TicketNumber" id="x_TicketNumber" size="30" placeholder="<?php echo HtmlEncode($ticketmessage_add->TicketNumber->getPlaceHolder()) ?>" value="<?php echo $ticketmessage_add->TicketNumber->EditValue ?>"<?php echo $ticketmessage_add->TicketNumber->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $ticketmessage_add->TicketNumber->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticketmessage_add->MessageBy->Visible) { // MessageBy ?>
	<div id="r_MessageBy" class="form-group row">
		<label id="elh_ticketmessage_MessageBy" for="x_MessageBy" class="<?php echo $ticketmessage_add->LeftColumnClass ?>"><?php echo $ticketmessage_add->MessageBy->caption() ?><?php echo $ticketmessage_add->MessageBy->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticketmessage_add->RightColumnClass ?>"><div <?php echo $ticketmessage_add->MessageBy->cellAttributes() ?>>
<span id="el_ticketmessage_MessageBy">
<input type="text" data-table="ticketmessage" data-field="x_MessageBy" name="x_MessageBy" id="x_MessageBy" size="30" placeholder="<?php echo HtmlEncode($ticketmessage_add->MessageBy->getPlaceHolder()) ?>" value="<?php echo $ticketmessage_add->MessageBy->EditValue ?>"<?php echo $ticketmessage_add->MessageBy->editAttributes() ?>>
</span>
<?php echo $ticketmessage_add->MessageBy->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticketmessage_add->Subject->Visible) { // Subject ?>
	<div id="r_Subject" class="form-group row">
		<label id="elh_ticketmessage_Subject" for="x_Subject" class="<?php echo $ticketmessage_add->LeftColumnClass ?>"><?php echo $ticketmessage_add->Subject->caption() ?><?php echo $ticketmessage_add->Subject->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticketmessage_add->RightColumnClass ?>"><div <?php echo $ticketmessage_add->Subject->cellAttributes() ?>>
<span id="el_ticketmessage_Subject">
<input type="text" data-table="ticketmessage" data-field="x_Subject" name="x_Subject" id="x_Subject" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($ticketmessage_add->Subject->getPlaceHolder()) ?>" value="<?php echo $ticketmessage_add->Subject->EditValue ?>"<?php echo $ticketmessage_add->Subject->editAttributes() ?>>
</span>
<?php echo $ticketmessage_add->Subject->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticketmessage_add->Message->Visible) { // Message ?>
	<div id="r_Message" class="form-group row">
		<label id="elh_ticketmessage_Message" for="x_Message" class="<?php echo $ticketmessage_add->LeftColumnClass ?>"><?php echo $ticketmessage_add->Message->caption() ?><?php echo $ticketmessage_add->Message->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticketmessage_add->RightColumnClass ?>"><div <?php echo $ticketmessage_add->Message->cellAttributes() ?>>
<span id="el_ticketmessage_Message">
<input type="text" data-table="ticketmessage" data-field="x_Message" name="x_Message" id="x_Message" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($ticketmessage_add->Message->getPlaceHolder()) ?>" value="<?php echo $ticketmessage_add->Message->EditValue ?>"<?php echo $ticketmessage_add->Message->editAttributes() ?>>
</span>
<?php echo $ticketmessage_add->Message->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticketmessage_add->MessageDate->Visible) { // MessageDate ?>
	<div id="r_MessageDate" class="form-group row">
		<label id="elh_ticketmessage_MessageDate" for="x_MessageDate" class="<?php echo $ticketmessage_add->LeftColumnClass ?>"><?php echo $ticketmessage_add->MessageDate->caption() ?><?php echo $ticketmessage_add->MessageDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticketmessage_add->RightColumnClass ?>"><div <?php echo $ticketmessage_add->MessageDate->cellAttributes() ?>>
<span id="el_ticketmessage_MessageDate">
<input type="text" data-table="ticketmessage" data-field="x_MessageDate" name="x_MessageDate" id="x_MessageDate" placeholder="<?php echo HtmlEncode($ticketmessage_add->MessageDate->getPlaceHolder()) ?>" value="<?php echo $ticketmessage_add->MessageDate->EditValue ?>"<?php echo $ticketmessage_add->MessageDate->editAttributes() ?>>
<?php if (!$ticketmessage_add->MessageDate->ReadOnly && !$ticketmessage_add->MessageDate->Disabled && !isset($ticketmessage_add->MessageDate->EditAttrs["readonly"]) && !isset($ticketmessage_add->MessageDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fticketmessageadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fticketmessageadd", "x_MessageDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $ticketmessage_add->MessageDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticketmessage_add->Attachment->Visible) { // Attachment ?>
	<div id="r_Attachment" class="form-group row">
		<label id="elh_ticketmessage_Attachment" class="<?php echo $ticketmessage_add->LeftColumnClass ?>"><?php echo $ticketmessage_add->Attachment->caption() ?><?php echo $ticketmessage_add->Attachment->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticketmessage_add->RightColumnClass ?>"><div <?php echo $ticketmessage_add->Attachment->cellAttributes() ?>>
<span id="el_ticketmessage_Attachment">
<div id="fd_x_Attachment">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $ticketmessage_add->Attachment->title() ?>" data-table="ticketmessage" data-field="x_Attachment" name="x_Attachment" id="x_Attachment" lang="<?php echo CurrentLanguageID() ?>"<?php echo $ticketmessage_add->Attachment->editAttributes() ?><?php if ($ticketmessage_add->Attachment->ReadOnly || $ticketmessage_add->Attachment->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_Attachment"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_Attachment" id= "fn_x_Attachment" value="<?php echo $ticketmessage_add->Attachment->Upload->FileName ?>">
<input type="hidden" name="fa_x_Attachment" id= "fa_x_Attachment" value="0">
<input type="hidden" name="fs_x_Attachment" id= "fs_x_Attachment" value="0">
<input type="hidden" name="fx_x_Attachment" id= "fx_x_Attachment" value="<?php echo $ticketmessage_add->Attachment->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_Attachment" id= "fm_x_Attachment" value="<?php echo $ticketmessage_add->Attachment->UploadMaxFileSize ?>">
</div>
<table id="ft_x_Attachment" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $ticketmessage_add->Attachment->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$ticketmessage_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $ticketmessage_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $ticketmessage_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$ticketmessage_add->showPageFooter();
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
$ticketmessage_add->terminate();
?>