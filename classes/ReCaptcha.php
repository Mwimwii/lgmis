<?php
namespace PHPMaker2020\lgmis20;

/**
 * reCAPTCHA class
 */
class ReCaptcha implements CaptchaInterface
{

	// Input
	public $Response = "";

	// Private key
	public $PrivateKey = "6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe";
	public $Size = "normal";

	// Validate
	public function validate()
	{
		global $Page;
		if ($this->Response == @$_SESSION[SESSION_CAPTCHA_CODE]) {
			return TRUE;
		} else {
			$recaptcha = new \ReCaptcha\ReCaptcha($this->PrivateKey, new \ReCaptcha\RequestMethod\Post());
			$resp = $recaptcha->verify($this->Response, @$_SERVER["REMOTE_ADDR"]);
			if ($resp) {
				if ($resp->isSuccess()) {
					$_SESSION[SESSION_CAPTCHA_CODE] = $this->Response;
					return TRUE;
				} else {
					$errors = $resp->getErrorCodes();
					if (count($errors))
						$Page->setFailureMessage($errors[0]);
					return FALSE;
				}
			} else {
				return FALSE;
			}
		}
	}

	// HTML tag
	public function getHtml() {
		global $Language, $Page;
		$classAttr = ($Page->OffsetColumnClass) ? ' class="' . $Page->OffsetColumnClass . '"' : "";
		return <<<EOT
<div class="form-group row ew-captcha-{$this->Size}">
	<div{$classAttr}>
		<div class="g-recaptcha"></div>
	</div>
</div>
EOT;
	}

	// HTML tag for confirm page
	public function getConfirmHtml() {
		return '<input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response" value="' . HtmlEncode($this->Response) . '">';
	}

	// Client side validation script
	public function getScript() {
		return <<<EOT
if (grecaptcha && grecaptcha.getResponse() == "") {
			ew.alert(ew.language.phrase("ClickReCaptcha"));
			return false;
		}
EOT;
	}
}
?>