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
$ticket_category_ref_edit = new ticket_category_ref_edit();

// Run the page
$ticket_category_ref_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ticket_category_ref_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fticket_category_refedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fticket_category_refedit = currentForm = new ew.Form("fticket_category_refedit", "edit");

	// Validate form
	fticket_category_refedit.validate = function() {
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
			<?php if ($ticket_category_ref_edit->TicketCategory->Required) { ?>
				elm = this.getElements("x" + infix + "_TicketCategory");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_category_ref_edit->TicketCategory->caption(), $ticket_category_ref_edit->TicketCategory->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ticket_category_ref_edit->TicketCategoryName->Required) { ?>
				elm = this.getElements("x" + infix + "_TicketCategoryName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_category_ref_edit->TicketCategoryName->caption(), $ticket_category_ref_edit->TicketCategoryName->RequiredErrorMessage)) ?>");
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
	fticket_category_refedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fticket_category_refedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fticket_category_refedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $ticket_category_ref_edit->showPageHeader(); ?>
<?php
$ticket_category_ref_edit->showMessage();
?>
<?php if (!$ticket_category_ref_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ticket_category_ref_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fticket_category_refedit" id="fticket_category_refedit" class="<?php echo $ticket_category_ref_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ticket_category_ref">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$ticket_category_ref_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($ticket_category_ref_edit->TicketCategory->Visible) { // TicketCategory ?>
	<div id="r_TicketCategory" class="form-group row">
		<label id="elh_ticket_category_ref_TicketCategory" class="<?php echo $ticket_category_ref_edit->LeftColumnClass ?>"><?php echo $ticket_category_ref_edit->TicketCategory->caption() ?><?php echo $ticket_category_ref_edit->TicketCategory->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_category_ref_edit->RightColumnClass ?>"><div <?php echo $ticket_category_ref_edit->TicketCategory->cellAttributes() ?>>
<span id="el_ticket_category_ref_TicketCategory">
<span<?php echo $ticket_category_ref_edit->TicketCategory->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ticket_category_ref_edit->TicketCategory->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="ticket_category_ref" data-field="x_TicketCategory" name="x_TicketCategory" id="x_TicketCategory" value="<?php echo HtmlEncode($ticket_category_ref_edit->TicketCategory->CurrentValue) ?>">
<?php echo $ticket_category_ref_edit->TicketCategory->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_category_ref_edit->TicketCategoryName->Visible) { // TicketCategoryName ?>
	<div id="r_TicketCategoryName" class="form-group row">
		<label id="elh_ticket_category_ref_TicketCategoryName" for="x_TicketCategoryName" class="<?php echo $ticket_category_ref_edit->LeftColumnClass ?>"><?php echo $ticket_category_ref_edit->TicketCategoryName->caption() ?><?php echo $ticket_category_ref_edit->TicketCategoryName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_category_ref_edit->RightColumnClass ?>"><div <?php echo $ticket_category_ref_edit->TicketCategoryName->cellAttributes() ?>>
<span id="el_ticket_category_ref_TicketCategoryName">
<input type="text" data-table="ticket_category_ref" data-field="x_TicketCategoryName" name="x_TicketCategoryName" id="x_TicketCategoryName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($ticket_category_ref_edit->TicketCategoryName->getPlaceHolder()) ?>" value="<?php echo $ticket_category_ref_edit->TicketCategoryName->EditValue ?>"<?php echo $ticket_category_ref_edit->TicketCategoryName->editAttributes() ?>>
</span>
<?php echo $ticket_category_ref_edit->TicketCategoryName->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$ticket_category_ref_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $ticket_category_ref_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $ticket_category_ref_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$ticket_category_ref_edit->IsModal) { ?>
<?php echo $ticket_category_ref_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$ticket_category_ref_edit->showPageFooter();
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
$ticket_category_ref_edit->terminate();
?>