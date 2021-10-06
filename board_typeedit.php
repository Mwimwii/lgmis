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
$board_type_edit = new board_type_edit();

// Run the page
$board_type_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$board_type_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fboard_typeedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fboard_typeedit = currentForm = new ew.Form("fboard_typeedit", "edit");

	// Validate form
	fboard_typeedit.validate = function() {
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
			<?php if ($board_type_edit->BoardType->Required) { ?>
				elm = this.getElements("x" + infix + "_BoardType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $board_type_edit->BoardType->caption(), $board_type_edit->BoardType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($board_type_edit->BoardTypeDesc->Required) { ?>
				elm = this.getElements("x" + infix + "_BoardTypeDesc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $board_type_edit->BoardTypeDesc->caption(), $board_type_edit->BoardTypeDesc->RequiredErrorMessage)) ?>");
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
	fboard_typeedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fboard_typeedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fboard_typeedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $board_type_edit->showPageHeader(); ?>
<?php
$board_type_edit->showMessage();
?>
<?php if (!$board_type_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $board_type_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fboard_typeedit" id="fboard_typeedit" class="<?php echo $board_type_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="board_type">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$board_type_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($board_type_edit->BoardType->Visible) { // BoardType ?>
	<div id="r_BoardType" class="form-group row">
		<label id="elh_board_type_BoardType" class="<?php echo $board_type_edit->LeftColumnClass ?>"><?php echo $board_type_edit->BoardType->caption() ?><?php echo $board_type_edit->BoardType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $board_type_edit->RightColumnClass ?>"><div <?php echo $board_type_edit->BoardType->cellAttributes() ?>>
<span id="el_board_type_BoardType">
<span<?php echo $board_type_edit->BoardType->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($board_type_edit->BoardType->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="board_type" data-field="x_BoardType" name="x_BoardType" id="x_BoardType" value="<?php echo HtmlEncode($board_type_edit->BoardType->CurrentValue) ?>">
<?php echo $board_type_edit->BoardType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($board_type_edit->BoardTypeDesc->Visible) { // BoardTypeDesc ?>
	<div id="r_BoardTypeDesc" class="form-group row">
		<label id="elh_board_type_BoardTypeDesc" for="x_BoardTypeDesc" class="<?php echo $board_type_edit->LeftColumnClass ?>"><?php echo $board_type_edit->BoardTypeDesc->caption() ?><?php echo $board_type_edit->BoardTypeDesc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $board_type_edit->RightColumnClass ?>"><div <?php echo $board_type_edit->BoardTypeDesc->cellAttributes() ?>>
<span id="el_board_type_BoardTypeDesc">
<input type="text" data-table="board_type" data-field="x_BoardTypeDesc" name="x_BoardTypeDesc" id="x_BoardTypeDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($board_type_edit->BoardTypeDesc->getPlaceHolder()) ?>" value="<?php echo $board_type_edit->BoardTypeDesc->EditValue ?>"<?php echo $board_type_edit->BoardTypeDesc->editAttributes() ?>>
</span>
<?php echo $board_type_edit->BoardTypeDesc->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$board_type_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $board_type_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $board_type_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$board_type_edit->IsModal) { ?>
<?php echo $board_type_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$board_type_edit->showPageFooter();
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
$board_type_edit->terminate();
?>