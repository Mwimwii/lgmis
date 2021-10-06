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
$ticket_type_edit = new ticket_type_edit();

// Run the page
$ticket_type_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ticket_type_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fticket_typeedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fticket_typeedit = currentForm = new ew.Form("fticket_typeedit", "edit");

	// Validate form
	fticket_typeedit.validate = function() {
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
			<?php if ($ticket_type_edit->TicketType->Required) { ?>
				elm = this.getElements("x" + infix + "_TicketType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_type_edit->TicketType->caption(), $ticket_type_edit->TicketType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ticket_type_edit->TicketTypeDesc->Required) { ?>
				elm = this.getElements("x" + infix + "_TicketTypeDesc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_type_edit->TicketTypeDesc->caption(), $ticket_type_edit->TicketTypeDesc->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ticket_type_edit->TicketCategory->Required) { ?>
				elm = this.getElements("x" + infix + "_TicketCategory");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_type_edit->TicketCategory->caption(), $ticket_type_edit->TicketCategory->RequiredErrorMessage)) ?>");
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
	fticket_typeedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fticket_typeedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fticket_typeedit.lists["x_TicketCategory"] = <?php echo $ticket_type_edit->TicketCategory->Lookup->toClientList($ticket_type_edit) ?>;
	fticket_typeedit.lists["x_TicketCategory"].options = <?php echo JsonEncode($ticket_type_edit->TicketCategory->lookupOptions()) ?>;
	loadjs.done("fticket_typeedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $ticket_type_edit->showPageHeader(); ?>
<?php
$ticket_type_edit->showMessage();
?>
<?php if (!$ticket_type_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ticket_type_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fticket_typeedit" id="fticket_typeedit" class="<?php echo $ticket_type_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ticket_type">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$ticket_type_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($ticket_type_edit->TicketType->Visible) { // TicketType ?>
	<div id="r_TicketType" class="form-group row">
		<label id="elh_ticket_type_TicketType" class="<?php echo $ticket_type_edit->LeftColumnClass ?>"><?php echo $ticket_type_edit->TicketType->caption() ?><?php echo $ticket_type_edit->TicketType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_type_edit->RightColumnClass ?>"><div <?php echo $ticket_type_edit->TicketType->cellAttributes() ?>>
<span id="el_ticket_type_TicketType">
<span<?php echo $ticket_type_edit->TicketType->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ticket_type_edit->TicketType->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="ticket_type" data-field="x_TicketType" name="x_TicketType" id="x_TicketType" value="<?php echo HtmlEncode($ticket_type_edit->TicketType->CurrentValue) ?>">
<?php echo $ticket_type_edit->TicketType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_type_edit->TicketTypeDesc->Visible) { // TicketTypeDesc ?>
	<div id="r_TicketTypeDesc" class="form-group row">
		<label id="elh_ticket_type_TicketTypeDesc" for="x_TicketTypeDesc" class="<?php echo $ticket_type_edit->LeftColumnClass ?>"><?php echo $ticket_type_edit->TicketTypeDesc->caption() ?><?php echo $ticket_type_edit->TicketTypeDesc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_type_edit->RightColumnClass ?>"><div <?php echo $ticket_type_edit->TicketTypeDesc->cellAttributes() ?>>
<span id="el_ticket_type_TicketTypeDesc">
<input type="text" data-table="ticket_type" data-field="x_TicketTypeDesc" name="x_TicketTypeDesc" id="x_TicketTypeDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($ticket_type_edit->TicketTypeDesc->getPlaceHolder()) ?>" value="<?php echo $ticket_type_edit->TicketTypeDesc->EditValue ?>"<?php echo $ticket_type_edit->TicketTypeDesc->editAttributes() ?>>
</span>
<?php echo $ticket_type_edit->TicketTypeDesc->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_type_edit->TicketCategory->Visible) { // TicketCategory ?>
	<div id="r_TicketCategory" class="form-group row">
		<label id="elh_ticket_type_TicketCategory" for="x_TicketCategory" class="<?php echo $ticket_type_edit->LeftColumnClass ?>"><?php echo $ticket_type_edit->TicketCategory->caption() ?><?php echo $ticket_type_edit->TicketCategory->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_type_edit->RightColumnClass ?>"><div <?php echo $ticket_type_edit->TicketCategory->cellAttributes() ?>>
<span id="el_ticket_type_TicketCategory">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ticket_type" data-field="x_TicketCategory" data-value-separator="<?php echo $ticket_type_edit->TicketCategory->displayValueSeparatorAttribute() ?>" id="x_TicketCategory" name="x_TicketCategory"<?php echo $ticket_type_edit->TicketCategory->editAttributes() ?>>
			<?php echo $ticket_type_edit->TicketCategory->selectOptionListHtml("x_TicketCategory") ?>
		</select>
</div>
<?php echo $ticket_type_edit->TicketCategory->Lookup->getParamTag($ticket_type_edit, "p_x_TicketCategory") ?>
</span>
<?php echo $ticket_type_edit->TicketCategory->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$ticket_type_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $ticket_type_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $ticket_type_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$ticket_type_edit->IsModal) { ?>
<?php echo $ticket_type_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$ticket_type_edit->showPageFooter();
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
$ticket_type_edit->terminate();
?>