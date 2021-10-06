<?php
namespace PHPMaker2020\lgmis20;

/**
 * Page class
 */
class councillorship_view extends councillorship
{

	// Page ID
	public $PageID = "view";

	// Project ID
	public $ProjectID = "{E5DE1DCC-60AD-4E3E-B70C-657FD6B5ADFD}";

	// Table name
	public $TableName = 'councillorship';

	// Page object name
	public $PageObjName = "councillorship_view";

	// Page URLs
	public $AddUrl;
	public $EditUrl;
	public $CopyUrl;
	public $DeleteUrl;
	public $ViewUrl;
	public $ListUrl;

	// Export URLs
	public $ExportPrintUrl;
	public $ExportHtmlUrl;
	public $ExportExcelUrl;
	public $ExportWordUrl;
	public $ExportXmlUrl;
	public $ExportCsvUrl;
	public $ExportPdfUrl;

	// Custom export
	public $ExportExcelCustom = FALSE;
	public $ExportWordCustom = FALSE;
	public $ExportPdfCustom = FALSE;
	public $ExportEmailCustom = FALSE;

	// Update URLs
	public $InlineAddUrl;
	public $InlineCopyUrl;
	public $InlineEditUrl;
	public $GridAddUrl;
	public $GridEditUrl;
	public $MultiDeleteUrl;
	public $MultiUpdateUrl;

	// Audit Trail
	public $AuditTrailOnAdd = TRUE;
	public $AuditTrailOnEdit = TRUE;
	public $AuditTrailOnDelete = TRUE;
	public $AuditTrailOnView = FALSE;
	public $AuditTrailOnViewData = FALSE;
	public $AuditTrailOnSearch = FALSE;

	// Page headings
	public $Heading = "";
	public $Subheading = "";
	public $PageHeader;
	public $PageFooter;

	// Token
	public $Token = "";
	public $TokenTimeout = 0;
	public $CheckToken;

	// Page heading
	public function pageHeading()
	{
		global $Language;
		if ($this->Heading != "")
			return $this->Heading;
		if (method_exists($this, "tableCaption"))
			return $this->tableCaption();
		return "";
	}

	// Page subheading
	public function pageSubheading()
	{
		global $Language;
		if ($this->Subheading != "")
			return $this->Subheading;
		if ($this->TableName)
			return $Language->phrase($this->PageID);
		return "";
	}

	// Page name
	public function pageName()
	{
		return CurrentPageName();
	}

	// Page URL
	public function pageUrl()
	{
		$url = CurrentPageName() . "?";
		if ($this->UseTokenInUrl)
			$url .= "t=" . $this->TableVar . "&"; // Add page token
		return $url;
	}

	// Messages
	private $_message = "";
	private $_failureMessage = "";
	private $_successMessage = "";
	private $_warningMessage = "";

	// Get message
	public function getMessage()
	{
		return isset($_SESSION[SESSION_MESSAGE]) ? $_SESSION[SESSION_MESSAGE] : $this->_message;
	}

	// Set message
	public function setMessage($v)
	{
		AddMessage($this->_message, $v);
		$_SESSION[SESSION_MESSAGE] = $this->_message;
	}

	// Get failure message
	public function getFailureMessage()
	{
		return isset($_SESSION[SESSION_FAILURE_MESSAGE]) ? $_SESSION[SESSION_FAILURE_MESSAGE] : $this->_failureMessage;
	}

	// Set failure message
	public function setFailureMessage($v)
	{
		AddMessage($this->_failureMessage, $v);
		$_SESSION[SESSION_FAILURE_MESSAGE] = $this->_failureMessage;
	}

	// Get success message
	public function getSuccessMessage()
	{
		return isset($_SESSION[SESSION_SUCCESS_MESSAGE]) ? $_SESSION[SESSION_SUCCESS_MESSAGE] : $this->_successMessage;
	}

	// Set success message
	public function setSuccessMessage($v)
	{
		AddMessage($this->_successMessage, $v);
		$_SESSION[SESSION_SUCCESS_MESSAGE] = $this->_successMessage;
	}

	// Get warning message
	public function getWarningMessage()
	{
		return isset($_SESSION[SESSION_WARNING_MESSAGE]) ? $_SESSION[SESSION_WARNING_MESSAGE] : $this->_warningMessage;
	}

	// Set warning message
	public function setWarningMessage($v)
	{
		AddMessage($this->_warningMessage, $v);
		$_SESSION[SESSION_WARNING_MESSAGE] = $this->_warningMessage;
	}

	// Clear message
	public function clearMessage()
	{
		$this->_message = "";
		$_SESSION[SESSION_MESSAGE] = "";
	}

	// Clear failure message
	public function clearFailureMessage()
	{
		$this->_failureMessage = "";
		$_SESSION[SESSION_FAILURE_MESSAGE] = "";
	}

	// Clear success message
	public function clearSuccessMessage()
	{
		$this->_successMessage = "";
		$_SESSION[SESSION_SUCCESS_MESSAGE] = "";
	}

	// Clear warning message
	public function clearWarningMessage()
	{
		$this->_warningMessage = "";
		$_SESSION[SESSION_WARNING_MESSAGE] = "";
	}

	// Clear messages
	public function clearMessages()
	{
		$this->clearMessage();
		$this->clearFailureMessage();
		$this->clearSuccessMessage();
		$this->clearWarningMessage();
	}

	// Show message
	public function showMessage()
	{
		$hidden = FALSE;
		$html = "";

		// Message
		$message = $this->getMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($message, "");
		if ($message != "") { // Message in Session, display
			if (!$hidden)
				$message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $message;
			$html .= '<div class="alert alert-info alert-dismissible ew-info"><i class="icon fas fa-info"></i>' . $message . '</div>';
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($warningMessage, "warning");
		if ($warningMessage != "") { // Message in Session, display
			if (!$hidden)
				$warningMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $warningMessage;
			$html .= '<div class="alert alert-warning alert-dismissible ew-warning"><i class="icon fas fa-exclamation"></i>' . $warningMessage . '</div>';
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($successMessage, "success");
		if ($successMessage != "") { // Message in Session, display
			if (!$hidden)
				$successMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $successMessage;
			$html .= '<div class="alert alert-success alert-dismissible ew-success"><i class="icon fas fa-check"></i>' . $successMessage . '</div>';
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$errorMessage = $this->getFailureMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($errorMessage, "failure");
		if ($errorMessage != "") { // Message in Session, display
			if (!$hidden)
				$errorMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $errorMessage;
			$html .= '<div class="alert alert-danger alert-dismissible ew-error"><i class="icon fas fa-ban"></i>' . $errorMessage . '</div>';
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo '<div class="ew-message-dialog' . (($hidden) ? ' d-none' : "") . '">' . $html . '</div>';
	}

	// Get message as array
	public function getMessages()
	{
		$ar = [];

		// Message
		$message = $this->getMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($message, "");

		if ($message != "") { // Message in Session, display
			$ar["message"] = $message;
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($warningMessage, "warning");

		if ($warningMessage != "") { // Message in Session, display
			$ar["warningMessage"] = $warningMessage;
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($successMessage, "success");

		if ($successMessage != "") { // Message in Session, display
			$ar["successMessage"] = $successMessage;
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$failureMessage = $this->getFailureMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($failureMessage, "failure");

		if ($failureMessage != "") { // Message in Session, display
			$ar["failureMessage"] = $failureMessage;
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		return $ar;
	}

	// Show Page Header
	public function showPageHeader()
	{
		$header = $this->PageHeader;
		$this->Page_DataRendering($header);
		if ($header != "") { // Header exists, display
			echo '<p id="ew-page-header">' . $header . '</p>';
		}
	}

	// Show Page Footer
	public function showPageFooter()
	{
		$footer = $this->PageFooter;
		$this->Page_DataRendered($footer);
		if ($footer != "") { // Footer exists, display
			echo '<p id="ew-page-footer">' . $footer . '</p>';
		}
	}

	// Validate page request
	protected function isPageRequest()
	{
		global $CurrentForm;
		if ($this->UseTokenInUrl) {
			if ($CurrentForm)
				return ($this->TableVar == $CurrentForm->getValue("t"));
			if (Get("t") !== NULL)
				return ($this->TableVar == Get("t"));
		}
		return TRUE;
	}

	// Valid Post
	protected function validPost()
	{
		if (!$this->CheckToken || !IsPost() || IsApi())
			return TRUE;
		if (Post(Config("TOKEN_NAME")) === NULL)
			return FALSE;
		$fn = Config("CHECK_TOKEN_FUNC");
		if (is_callable($fn))
			return $fn(Post(Config("TOKEN_NAME")), $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	public function createToken()
	{
		global $CurrentToken;
		$fn = Config("CREATE_TOKEN_FUNC"); // Always create token, required by API file/lookup request
		if ($this->Token == "" && is_callable($fn)) // Create token
			$this->Token = $fn();
		$CurrentToken = $this->Token; // Save to global variable
	}

	// Constructor
	public function __construct()
	{
		global $Language, $DashboardReport;
		global $UserTable;

		// Check token
		$this->CheckToken = Config("CHECK_TOKEN");

		// Initialize
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		if (!isset($Language))
			$Language = new Language();

		// Parent constuctor
		parent::__construct();

		// Table object (councillorship)
		if (!isset($GLOBALS["councillorship"]) || get_class($GLOBALS["councillorship"]) == PROJECT_NAMESPACE . "councillorship") {
			$GLOBALS["councillorship"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["councillorship"];
		}
		$keyUrl = "";
		if (Get("EmployeeID") !== NULL) {
			$this->RecKey["EmployeeID"] = Get("EmployeeID");
			$keyUrl .= "&amp;EmployeeID=" . urlencode($this->RecKey["EmployeeID"]);
		}
		if (Get("LACode") !== NULL) {
			$this->RecKey["LACode"] = Get("LACode");
			$keyUrl .= "&amp;LACode=" . urlencode($this->RecKey["LACode"]);
		}
		if (Get("PositionInCouncil") !== NULL) {
			$this->RecKey["PositionInCouncil"] = Get("PositionInCouncil");
			$keyUrl .= "&amp;PositionInCouncil=" . urlencode($this->RecKey["PositionInCouncil"]);
		}
		if (Get("CouncilTerm") !== NULL) {
			$this->RecKey["CouncilTerm"] = Get("CouncilTerm");
			$keyUrl .= "&amp;CouncilTerm=" . urlencode($this->RecKey["CouncilTerm"]);
		}
		$this->ExportPrintUrl = $this->pageUrl() . "export=print" . $keyUrl;
		$this->ExportHtmlUrl = $this->pageUrl() . "export=html" . $keyUrl;
		$this->ExportExcelUrl = $this->pageUrl() . "export=excel" . $keyUrl;
		$this->ExportWordUrl = $this->pageUrl() . "export=word" . $keyUrl;
		$this->ExportXmlUrl = $this->pageUrl() . "export=xml" . $keyUrl;
		$this->ExportCsvUrl = $this->pageUrl() . "export=csv" . $keyUrl;
		$this->ExportPdfUrl = $this->pageUrl() . "export=pdf" . $keyUrl;

		// Table object (councillor)
		if (!isset($GLOBALS['councillor']))
			$GLOBALS['councillor'] = new councillor();

		// Table object (local_authority)
		if (!isset($GLOBALS['local_authority']))
			$GLOBALS['local_authority'] = new local_authority();

		// Table object (musers)
		if (!isset($GLOBALS['musers']))
			$GLOBALS['musers'] = new musers();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'view');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'councillorship');

		// Start timer
		if (!isset($GLOBALS["DebugTimer"]))
			$GLOBALS["DebugTimer"] = new Timer();

		// Debug message
		LoadDebugMessage();

		// Open connection
		if (!isset($GLOBALS["Conn"]))
			$GLOBALS["Conn"] = $this->getConnection();

		// User table object (musers)
		$UserTable = $UserTable ?: new musers();

		// Export options
		$this->ExportOptions = new ListOptions("div");
		$this->ExportOptions->TagClassName = "ew-export-option";

		// Other options
		if (!$this->OtherOptions)
			$this->OtherOptions = new ListOptionsArray();
		$this->OtherOptions["action"] = new ListOptions("div");
		$this->OtherOptions["action"]->TagClassName = "ew-action-option";
		$this->OtherOptions["detail"] = new ListOptions("div");
		$this->OtherOptions["detail"]->TagClassName = "ew-detail-option";
	}

	// Terminate page
	public function terminate($url = "")
	{
		global $ExportFileName, $TempImages, $DashboardReport;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $councillorship;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($councillorship);
				$doc->Text = @$content;
				if ($this->isExport("email"))
					echo $this->exportEmail($doc->Text);
				else
					$doc->export();
				DeleteTempImages(); // Delete temp images
				exit();
			}
		}
		if (!IsApi())
			$this->Page_Redirecting($url);

		// Close connection
		CloseConnections();

		// Return for API
		if (IsApi()) {
			$res = $url === TRUE;
			if (!$res) // Show error
				WriteJson(array_merge(["success" => FALSE], $this->getMessages()));
			return;
		}

		// Go to URL if specified
		if ($url != "") {
			if (!Config("DEBUG") && ob_get_length())
				ob_end_clean();

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = ["url" => $url, "modal" => "1"];
				$pageName = GetPageName($url);
				if ($pageName != $this->getListUrl()) { // Not List page
					$row["caption"] = $this->getModalCaption($pageName);
					if ($pageName == "councillorshipview.php")
						$row["view"] = "1";
				} else { // List page should not be shown as modal => error
					$row["error"] = $this->getFailureMessage();
					$this->clearFailureMessage();
				}
				WriteJson($row);
			} else {
				SaveDebugMessage();
				AddHeader("Location", $url);
			}
		}
		exit();
	}

	// Get records from recordset
	protected function getRecordsFromRecordset($rs, $current = FALSE)
	{
		$rows = [];
		if (is_object($rs)) { // Recordset
			while ($rs && !$rs->EOF) {
				$this->loadRowValues($rs); // Set up DbValue/CurrentValue
				$row = $this->getRecordFromArray($rs->fields);
				if ($current)
					return $row;
				else
					$rows[] = $row;
				$rs->moveNext();
			}
		} elseif (is_array($rs)) {
			foreach ($rs as $ar) {
				$row = $this->getRecordFromArray($ar);
				if ($current)
					return $row;
				else
					$rows[] = $row;
			}
		}
		return $rows;
	}

	// Get record from array
	protected function getRecordFromArray($ar)
	{
		$row = [];
		if (is_array($ar)) {
			foreach ($ar as $fldname => $val) {
				if (array_key_exists($fldname, $this->fields) && ($this->fields[$fldname]->Visible || $this->fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
					$fld = &$this->fields[$fldname];
					if ($fld->HtmlTag == "FILE") { // Upload field
						if (EmptyValue($val)) {
							$row[$fldname] = NULL;
						} else {
							if ($fld->DataType == DATATYPE_BLOB) {
								$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
									Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
									Config("API_FIELD_NAME") . "=" . $fld->Param . "&" .
									Config("API_KEY_NAME") . "=" . rawurlencode($this->getRecordKeyValue($ar)))); //*** need to add this? API may not be in the same folder
								$row[$fldname] = ["type" => ContentType($val), "url" => $url, "name" => $fld->Param . ContentExtension($val)];
							} elseif (!$fld->UploadMultiple || !ContainsString($val, Config("MULTIPLE_UPLOAD_SEPARATOR"))) { // Single file
								$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
									Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
									"fn=" . Encrypt($fld->physicalUploadPath() . $val)));
								$row[$fldname] = ["type" => MimeContentType($val), "url" => $url, "name" => $val];
							} else { // Multiple files
								$files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
								$ar = [];
								foreach ($files as $file) {
									$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
										Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
										"fn=" . Encrypt($fld->physicalUploadPath() . $file)));
									if (!EmptyValue($file))
										$ar[] = ["type" => MimeContentType($file), "url" => $url, "name" => $file];
								}
								$row[$fldname] = $ar;
							}
						}
					} else {
						$row[$fldname] = $val;
					}
				}
			}
		}
		return $row;
	}

	// Get record key value from array
	protected function getRecordKeyValue($ar)
	{
		$key = "";
		if (is_array($ar)) {
			$key .= @$ar['EmployeeID'] . Config("COMPOSITE_KEY_SEPARATOR");
			$key .= @$ar['LACode'] . Config("COMPOSITE_KEY_SEPARATOR");
			$key .= @$ar['PositionInCouncil'] . Config("COMPOSITE_KEY_SEPARATOR");
			$key .= @$ar['CouncilTerm'];
		}
		return $key;
	}

	/**
	 * Hide fields for add/edit
	 *
	 * @return void
	 */
	protected function hideFieldsForAddEdit()
	{
	}

	// Lookup data
	public function lookup()
	{
		global $Language, $Security;
		if (!isset($Language))
			$Language = new Language(Config("LANGUAGE_FOLDER"), Post("language", ""));

		// Set up API request
		if (!ValidApiRequest())
			return FALSE;
		$this->setupApiSecurity();

		// Get lookup object
		$fieldName = Post("field");
		if (!array_key_exists($fieldName, $this->fields))
			return FALSE;
		$lookupField = $this->fields[$fieldName];
		$lookup = $lookupField->Lookup;
		if ($lookup === NULL)
			return FALSE;
		$tbl = $lookup->getTable();
		if (!$Security->allowLookup(Config("PROJECT_ID") . $tbl->TableName)) // Lookup permission
			return FALSE;

		// Get lookup parameters
		$lookupType = Post("ajax", "unknown");
		$pageSize = -1;
		$offset = -1;
		$searchValue = "";
		if (SameText($lookupType, "modal")) {
			$searchValue = Post("sv", "");
			$pageSize = Post("recperpage", 10);
			$offset = Post("start", 0);
		} elseif (SameText($lookupType, "autosuggest")) {
			$searchValue = Param("q", "");
			$pageSize = Param("n", -1);
			$pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
			if ($pageSize <= 0)
				$pageSize = Config("AUTO_SUGGEST_MAX_ENTRIES");
			$start = Param("start", -1);
			$start = is_numeric($start) ? (int)$start : -1;
			$page = Param("page", -1);
			$page = is_numeric($page) ? (int)$page : -1;
			$offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
		}
		$userSelect = Decrypt(Post("s", ""));
		$userFilter = Decrypt(Post("f", ""));
		$userOrderBy = Decrypt(Post("o", ""));
		$keys = Post("keys");
		$lookup->LookupType = $lookupType; // Lookup type
		if ($keys !== NULL) { // Selected records from modal
			if (is_array($keys))
				$keys = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $keys);
			$lookup->FilterFields = []; // Skip parent fields if any
			$lookup->FilterValues[] = $keys; // Lookup values
			$pageSize = -1; // Show all records
		} else { // Lookup values
			$lookup->FilterValues[] = Post("v0", Post("lookupValue", ""));
		}
		$cnt = is_array($lookup->FilterFields) ? count($lookup->FilterFields) : 0;
		for ($i = 1; $i <= $cnt; $i++)
			$lookup->FilterValues[] = Post("v" . $i, "");
		$lookup->SearchValue = $searchValue;
		$lookup->PageSize = $pageSize;
		$lookup->Offset = $offset;
		if ($userSelect != "")
			$lookup->UserSelect = $userSelect;
		if ($userFilter != "")
			$lookup->UserFilter = $userFilter;
		if ($userOrderBy != "")
			$lookup->UserOrderBy = $userOrderBy;
		$lookup->toJson($this); // Use settings from current page
	}

	// Set up API security
	public function setupApiSecurity()
	{
		global $Security;

		// Setup security for API request
		if ($Security->isLoggedIn()) $Security->TablePermission_Loading();
		$Security->loadCurrentUserLevel(Config("PROJECT_ID") . $this->TableName);
		if ($Security->isLoggedIn()) $Security->TablePermission_Loaded();
	}
	public $ExportOptions; // Export options
	public $OtherOptions; // Other options
	public $DisplayRecords = 1;
	public $DbMasterFilter;
	public $DbDetailFilter;
	public $StartRecord;
	public $StopRecord;
	public $TotalRecords = 0;
	public $RecordRange = 10;
	public $RecKey = [];
	public $IsModal = FALSE;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
			$SkipHeaderFooter;

		// Is modal
		$this->IsModal = (Param("modal") == "1");

		// User profile
		$UserProfile = new UserProfile();

		// Security
		if (ValidApiRequest()) { // API request
			$this->setupApiSecurity(); // Set up API Security
			if (!$Security->canView()) {
				SetStatus(401); // Unauthorized
				return;
			}
		} else {
			$Security = new AdvancedSecurity();
			if (IsPasswordExpired())
				$this->terminate(GetUrl("changepwd.php"));
			if (!$Security->isLoggedIn())
				$Security->autoLogin();
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loading();
			$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName);
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loaded();
			if (!$Security->canView()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("councillorshiplist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Get export parameters
		$custom = "";
		if (Param("export") !== NULL) {
			$this->Export = Param("export");
			$custom = Param("custom", "");
		} elseif (IsPost()) {
			if (Post("exporttype") !== NULL)
				$this->Export = Post("exporttype");
			$custom = Post("custom", "");
		} elseif (Get("cmd") == "json") {
			$this->Export = Get("cmd");
		} else {
			$this->setExportReturnUrl(CurrentUrl());
		}
		$ExportFileName = $this->TableVar; // Get export file, used in header
		if (Get("EmployeeID") !== NULL) {
			if ($ExportFileName != "")
				$ExportFileName .= "_";
			$ExportFileName .= Get("EmployeeID");
		}
		if (Get("LACode") !== NULL) {
			if ($ExportFileName != "")
				$ExportFileName .= "_";
			$ExportFileName .= Get("LACode");
		}
		if (Get("PositionInCouncil") !== NULL) {
			if ($ExportFileName != "")
				$ExportFileName .= "_";
			$ExportFileName .= Get("PositionInCouncil");
		}
		if (Get("CouncilTerm") !== NULL) {
			if ($ExportFileName != "")
				$ExportFileName .= "_";
			$ExportFileName .= Get("CouncilTerm");
		}

		// Get custom export parameters
		if ($this->isExport() && $custom != "") {
			$this->CustomExport = $this->Export;
			$this->Export = "print";
		}
		$CustomExportType = $this->CustomExport;
		$ExportType = $this->Export; // Get export parameter, used in header

		// Update Export URLs
		if (Config("USE_PHPEXCEL"))
			$this->ExportExcelCustom = FALSE;
		if ($this->ExportExcelCustom)
			$this->ExportExcelUrl .= "&amp;custom=1";
		if (Config("USE_PHPWORD"))
			$this->ExportWordCustom = FALSE;
		if ($this->ExportWordCustom)
			$this->ExportWordUrl .= "&amp;custom=1";
		if ($this->ExportPdfCustom)
			$this->ExportPdfUrl .= "&amp;custom=1";
		$this->CurrentAction = Param("action"); // Set up current action

		// Setup export options
		$this->setupExportOptions();
		$this->EmployeeID->setVisibility();
		$this->ProvinceCode->setVisibility();
		$this->LACode->setVisibility();
		$this->PoliticalParty->setVisibility();
		$this->Occupation->setVisibility();
		$this->PositionInCouncil->setVisibility();
		$this->Committee->setVisibility();
		$this->CommitteeRole->setVisibility();
		$this->CouncilTerm->setVisibility();
		$this->DateOfExit->setVisibility();
		$this->Allowance->setVisibility();
		$this->CouncillorTypeType->setVisibility();
		$this->CouncillorshipStatus->setVisibility();
		$this->ExitReason->setVisibility();
		$this->RetirementType->setVisibility();
		$this->CouncillorPhoto->setVisibility();
		$this->hideFieldsForAddEdit();

		// Do not use lookup cache
		$this->setUseLookupCache(FALSE);

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->validPost()) {
			Write($Language->phrase("InvalidPostRequest"));
			$this->terminate();
		}

		// Create Token
		$this->createToken();

		// Set up lookup cache
		$this->setupLookupOptions($this->EmployeeID);
		$this->setupLookupOptions($this->ProvinceCode);
		$this->setupLookupOptions($this->LACode);
		$this->setupLookupOptions($this->PoliticalParty);
		$this->setupLookupOptions($this->Occupation);
		$this->setupLookupOptions($this->PositionInCouncil);
		$this->setupLookupOptions($this->Committee);
		$this->setupLookupOptions($this->CommitteeRole);
		$this->setupLookupOptions($this->CouncilTerm);
		$this->setupLookupOptions($this->CouncillorTypeType);
		$this->setupLookupOptions($this->CouncillorshipStatus);
		$this->setupLookupOptions($this->ExitReason);
		$this->setupLookupOptions($this->RetirementType);

		// Check permission
		if (!$Security->canView()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("councillorshiplist.php");
			return;
		}

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;

		// Load current record
		$loadCurrentRecord = FALSE;
		$returnUrl = "";
		$matchRecord = FALSE;

		// Set up master/detail parameters
		$this->setupMasterParms();
		if ($this->isPageRequest()) { // Validate request
			if (Get("EmployeeID") !== NULL) {
				$this->EmployeeID->setQueryStringValue(Get("EmployeeID"));
				$this->RecKey["EmployeeID"] = $this->EmployeeID->QueryStringValue;
			} elseif (IsApi() && Key(0) !== NULL) {
				$this->EmployeeID->setQueryStringValue(Key(0));
				$this->RecKey["EmployeeID"] = $this->EmployeeID->QueryStringValue;
			} elseif (Post("EmployeeID") !== NULL) {
				$this->EmployeeID->setFormValue(Post("EmployeeID"));
				$this->RecKey["EmployeeID"] = $this->EmployeeID->FormValue;
			} elseif (IsApi() && Route(2) !== NULL) {
				$this->EmployeeID->setFormValue(Route(2));
				$this->RecKey["EmployeeID"] = $this->EmployeeID->FormValue;
			} else {
				$loadCurrentRecord = TRUE;
			}
			if (Get("LACode") !== NULL) {
				$this->LACode->setQueryStringValue(Get("LACode"));
				$this->RecKey["LACode"] = $this->LACode->QueryStringValue;
			} elseif (IsApi() && Key(1) !== NULL) {
				$this->LACode->setQueryStringValue(Key(1));
				$this->RecKey["LACode"] = $this->LACode->QueryStringValue;
			} elseif (Post("LACode") !== NULL) {
				$this->LACode->setFormValue(Post("LACode"));
				$this->RecKey["LACode"] = $this->LACode->FormValue;
			} elseif (IsApi() && Route(3) !== NULL) {
				$this->LACode->setFormValue(Route(3));
				$this->RecKey["LACode"] = $this->LACode->FormValue;
			} else {
				$loadCurrentRecord = TRUE;
			}
			if (Get("PositionInCouncil") !== NULL) {
				$this->PositionInCouncil->setQueryStringValue(Get("PositionInCouncil"));
				$this->RecKey["PositionInCouncil"] = $this->PositionInCouncil->QueryStringValue;
			} elseif (IsApi() && Key(2) !== NULL) {
				$this->PositionInCouncil->setQueryStringValue(Key(2));
				$this->RecKey["PositionInCouncil"] = $this->PositionInCouncil->QueryStringValue;
			} elseif (Post("PositionInCouncil") !== NULL) {
				$this->PositionInCouncil->setFormValue(Post("PositionInCouncil"));
				$this->RecKey["PositionInCouncil"] = $this->PositionInCouncil->FormValue;
			} elseif (IsApi() && Route(4) !== NULL) {
				$this->PositionInCouncil->setFormValue(Route(4));
				$this->RecKey["PositionInCouncil"] = $this->PositionInCouncil->FormValue;
			} else {
				$loadCurrentRecord = TRUE;
			}
			if (Get("CouncilTerm") !== NULL) {
				$this->CouncilTerm->setQueryStringValue(Get("CouncilTerm"));
				$this->RecKey["CouncilTerm"] = $this->CouncilTerm->QueryStringValue;
			} elseif (IsApi() && Key(3) !== NULL) {
				$this->CouncilTerm->setQueryStringValue(Key(3));
				$this->RecKey["CouncilTerm"] = $this->CouncilTerm->QueryStringValue;
			} elseif (Post("CouncilTerm") !== NULL) {
				$this->CouncilTerm->setFormValue(Post("CouncilTerm"));
				$this->RecKey["CouncilTerm"] = $this->CouncilTerm->FormValue;
			} elseif (IsApi() && Route(5) !== NULL) {
				$this->CouncilTerm->setFormValue(Route(5));
				$this->RecKey["CouncilTerm"] = $this->CouncilTerm->FormValue;
			} else {
				$loadCurrentRecord = TRUE;
			}

			// Get action
			$this->CurrentAction = "show"; // Display
			switch ($this->CurrentAction) {
				case "show": // Get a record to display
					$this->StartRecord = 1; // Initialize start position
					if ($this->Recordset = $this->loadRecordset()) // Load records
						$this->TotalRecords = $this->Recordset->RecordCount(); // Get record count
					if ($this->TotalRecords <= 0) { // No record found
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
						$this->terminate("councillorshiplist.php"); // Return to list page
					} elseif ($loadCurrentRecord) { // Load current record position
						$this->setupStartRecord(); // Set up start record position

						// Point to current record
						if ($this->StartRecord <= $this->TotalRecords) {
							$matchRecord = TRUE;
							$this->Recordset->move($this->StartRecord - 1);
						}
					} else { // Match key values
						while (!$this->Recordset->EOF) {
							if (SameString($this->EmployeeID->CurrentValue, $this->Recordset->fields('EmployeeID')) && SameString($this->LACode->CurrentValue, $this->Recordset->fields('LACode')) && SameString($this->PositionInCouncil->CurrentValue, $this->Recordset->fields('PositionInCouncil')) && SameString($this->CouncilTerm->CurrentValue, $this->Recordset->fields('CouncilTerm'))) {
								$this->setStartRecordNumber($this->StartRecord); // Save record position
								$matchRecord = TRUE;
								break;
							} else {
								$this->StartRecord++;
								$this->Recordset->moveNext();
							}
						}
					}
					if (!$matchRecord) {
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
						$returnUrl = "councillorshiplist.php"; // No matching record, return to list
					} else {
						$this->loadRowValues($this->Recordset); // Load row values
					}
			}

			// Export data only
			if (!$this->CustomExport && in_array($this->Export, array_keys(Config("EXPORT_CLASSES")))) {
				$this->exportData();
				$this->terminate();
			}
		} else {
			$returnUrl = "councillorshiplist.php"; // Not page request, return to list
		}
		if ($returnUrl != "") {
			$this->terminate($returnUrl);
			return;
		}

		// Set up Breadcrumb
		if (!$this->isExport())
			$this->setupBreadcrumb();

		// Render row
		$this->RowType = ROWTYPE_VIEW;
		$this->resetAttributes();
		$this->renderRow();

		// Set up detail parameters
		$this->setupDetailParms();

		// Normal return
		if (IsApi()) {
			$rows = $this->getRecordsFromRecordset($this->Recordset, TRUE); // Get current record only
			$this->Recordset->close();
			WriteJson(["success" => TRUE, $this->TableVar => $rows]);
			$this->terminate(TRUE);
		}

		// Set up pager
		$this->Pager = new PrevNextPager($this->StartRecord, $this->DisplayRecords, $this->TotalRecords, "", $this->RecordRange, $this->AutoHidePager);
	}

	// Set up other options
	protected function setupOtherOptions()
	{
		global $Language, $Security;
		$options = &$this->OtherOptions;
		$option = $options["action"];

		// Add
		$item = &$option->add("add");
		$addcaption = HtmlTitle($Language->phrase("ViewPageAddLink"));
		if ($this->IsModal) // Modal
			$item->Body = "<a class=\"ew-action ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,url:'" . HtmlEncode($this->AddUrl) . "'});\">" . $Language->phrase("ViewPageAddLink") . "</a>";
		else
			$item->Body = "<a class=\"ew-action ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . HtmlEncode($this->AddUrl) . "\">" . $Language->phrase("ViewPageAddLink") . "</a>";
		$item->Visible = ($this->AddUrl != "" && $Security->canAdd());

		// Edit
		$item = &$option->add("edit");
		$editcaption = HtmlTitle($Language->phrase("ViewPageEditLink"));
		if ($this->IsModal) // Modal
			$item->Body = "<a class=\"ew-action ew-edit\" title=\"" . $editcaption . "\" data-caption=\"" . $editcaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,url:'" . HtmlEncode($this->EditUrl) . "'});\">" . $Language->phrase("ViewPageEditLink") . "</a>";
		else
			$item->Body = "<a class=\"ew-action ew-edit\" title=\"" . $editcaption . "\" data-caption=\"" . $editcaption . "\" href=\"" . HtmlEncode($this->EditUrl) . "\">" . $Language->phrase("ViewPageEditLink") . "</a>";
		$item->Visible = ($this->EditUrl != "" && $Security->canEdit());

		// Delete
		$item = &$option->add("delete");
		if ($this->IsModal) // Handle as inline delete
			$item->Body = "<a onclick=\"return ew.confirmDelete(this);\" class=\"ew-action ew-delete\" title=\"" . HtmlTitle($Language->phrase("ViewPageDeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("ViewPageDeleteLink")) . "\" href=\"" . HtmlEncode(UrlAddQuery($this->DeleteUrl, "action=1")) . "\">" . $Language->phrase("ViewPageDeleteLink") . "</a>";
		else
			$item->Body = "<a class=\"ew-action ew-delete\" title=\"" . HtmlTitle($Language->phrase("ViewPageDeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("ViewPageDeleteLink")) . "\" href=\"" . HtmlEncode($this->DeleteUrl) . "\">" . $Language->phrase("ViewPageDeleteLink") . "</a>";
		$item->Visible = ($this->DeleteUrl != "" && $Security->canDelete());
		$option = $options["detail"];
		$detailTableLink = "";
		$detailViewTblVar = "";
		$detailCopyTblVar = "";
		$detailEditTblVar = "";

		// "detail_councillor_allowance"
		$item = &$option->add("detail_councillor_allowance");
		$body = $Language->phrase("ViewPageDetailLink") . $Language->TablePhrase("councillor_allowance", "TblCaption");
		$body = "<a class=\"btn btn-default ew-row-link ew-detail\" data-action=\"list\" href=\"" . HtmlEncode("councillor_allowancelist.php?" . Config("TABLE_SHOW_MASTER") . "=councillorship&fk_EmployeeID=" . urlencode(strval($this->EmployeeID->CurrentValue)) . "") . "\">" . $body . "</a>";
		$links = "";
		if (!isset($GLOBALS["councillor_allowance_grid"]))
			$GLOBALS["councillor_allowance_grid"] = new councillor_allowance_grid();
		if ($GLOBALS["councillor_allowance_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'councillorship')) {
			$links .= "<li><a class=\"ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailViewLink")) . "\" href=\"" . HtmlEncode($this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=councillor_allowance")) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailViewLink")) . "</a></li>";
			if ($detailViewTblVar != "")
				$detailViewTblVar .= ",";
			$detailViewTblVar .= "councillor_allowance";
		}
		if ($GLOBALS["councillor_allowance_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'councillorship')) {
			$links .= "<li><a class=\"ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailEditLink")) . "\" href=\"" . HtmlEncode($this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=councillor_allowance")) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailEditLink")) . "</a></li>";
			if ($detailEditTblVar != "")
				$detailEditTblVar .= ",";
			$detailEditTblVar .= "councillor_allowance";
		}
		if ($links != "") {
			$body .= "<button class=\"dropdown-toggle btn btn-default ew-detail\" data-toggle=\"dropdown\"></button>";
			$body .= "<ul class=\"dropdown-menu\">". $links . "</ul>";
		}
		$body = "<div class=\"btn-group btn-group-sm ew-btn-group\">" . $body . "</div>";
		$item->Body = $body;
		$item->Visible = $Security->allowList(CurrentProjectID() . 'councillor_allowance');
		if ($item->Visible) {
			if ($detailTableLink != "")
				$detailTableLink .= ",";
			$detailTableLink .= "councillor_allowance";
		}
		if ($this->ShowMultipleDetails)
			$item->Visible = FALSE;

		// "detail_committee_appointed"
		$item = &$option->add("detail_committee_appointed");
		$body = $Language->phrase("ViewPageDetailLink") . $Language->TablePhrase("committee_appointed", "TblCaption");
		$body = "<a class=\"btn btn-default ew-row-link ew-detail\" data-action=\"list\" href=\"" . HtmlEncode("committee_appointedlist.php?" . Config("TABLE_SHOW_MASTER") . "=councillorship&fk_EmployeeID=" . urlencode(strval($this->EmployeeID->CurrentValue)) . "") . "\">" . $body . "</a>";
		$links = "";
		if (!isset($GLOBALS["committee_appointed_grid"]))
			$GLOBALS["committee_appointed_grid"] = new committee_appointed_grid();
		if ($GLOBALS["committee_appointed_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'councillorship')) {
			$links .= "<li><a class=\"ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailViewLink")) . "\" href=\"" . HtmlEncode($this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=committee_appointed")) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailViewLink")) . "</a></li>";
			if ($detailViewTblVar != "")
				$detailViewTblVar .= ",";
			$detailViewTblVar .= "committee_appointed";
		}
		if ($GLOBALS["committee_appointed_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'councillorship')) {
			$links .= "<li><a class=\"ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailEditLink")) . "\" href=\"" . HtmlEncode($this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=committee_appointed")) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailEditLink")) . "</a></li>";
			if ($detailEditTblVar != "")
				$detailEditTblVar .= ",";
			$detailEditTblVar .= "committee_appointed";
		}
		if ($links != "") {
			$body .= "<button class=\"dropdown-toggle btn btn-default ew-detail\" data-toggle=\"dropdown\"></button>";
			$body .= "<ul class=\"dropdown-menu\">". $links . "</ul>";
		}
		$body = "<div class=\"btn-group btn-group-sm ew-btn-group\">" . $body . "</div>";
		$item->Body = $body;
		$item->Visible = $Security->allowList(CurrentProjectID() . 'committee_appointed');
		if ($item->Visible) {
			if ($detailTableLink != "")
				$detailTableLink .= ",";
			$detailTableLink .= "committee_appointed";
		}
		if ($this->ShowMultipleDetails)
			$item->Visible = FALSE;

		// Multiple details
		if ($this->ShowMultipleDetails) {
			$body = "<div class=\"btn-group btn-group-sm ew-btn-group\">";
			$links = "";
			if ($detailViewTblVar != "") {
				$links .= "<li><a class=\"ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailViewLink")) . "\" href=\"" . HtmlEncode($this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=" . $detailViewTblVar)) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailViewLink")) . "</a></li>";
			}
			if ($detailEditTblVar != "") {
				$links .= "<li><a class=\"ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailEditLink")) . "\" href=\"" . HtmlEncode($this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=" . $detailEditTblVar)) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailEditLink")) . "</a></li>";
			}
			if ($detailCopyTblVar != "") {
				$links .= "<li><a class=\"ew-row-link ew-detail-copy\" data-action=\"add\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailCopyLink")) . "\" href=\"" . HtmlEncode($this->getCopyUrl(Config("TABLE_SHOW_DETAIL") . "=" . $detailCopyTblVar)) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailCopyLink")) . "</a></li>";
			}
			if ($links != "") {
				$body .= "<button class=\"dropdown-toggle btn btn-default ew-master-detail\" title=\"" . HtmlTitle($Language->phrase("MultipleMasterDetails")) . "\" data-toggle=\"dropdown\">" . $Language->phrase("MultipleMasterDetails") . "</button>";
				$body .= "<ul class=\"dropdown-menu ew-menu\">". $links . "</ul>";
			}
			$body .= "</div>";

			// Multiple details
			$item = &$option->add("details");
			$item->Body = $body;
		}

		// Set up detail default
		$option = $options["detail"];
		$options["detail"]->DropDownButtonPhrase = $Language->phrase("ButtonDetails");
		$ar = explode(",", $detailTableLink);
		$cnt = count($ar);
		$option->UseDropDownButton = ($cnt > 1);
		$option->UseButtonGroup = TRUE;
		$item = &$option->add($option->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Set up action default
		$option = $options["action"];
		$option->DropDownButtonPhrase = $Language->phrase("ButtonActions");
		$option->UseDropDownButton = TRUE;
		$option->UseButtonGroup = TRUE;
		$item = &$option->add($option->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
	}

	// Load recordset
	public function loadRecordset($offset = -1, $rowcnt = -1)
	{

		// Load List page SQL
		$sql = $this->getListSql();
		$conn = $this->getConnection();

		// Load recordset
		$dbtype = GetConnectionType($this->Dbid);
		if ($this->UseSelectLimit) {
			$conn->raiseErrorFn = Config("ERROR_FUNC");
			if ($dbtype == "MSSQL") {
				$rs = $conn->selectLimit($sql, $rowcnt, $offset, ["_hasOrderBy" => trim($this->getOrderBy()) || trim($this->getSessionOrderBy())]);
			} else {
				$rs = $conn->selectLimit($sql, $rowcnt, $offset);
			}
			$conn->raiseErrorFn = "";
		} else {
			$rs = LoadRecordset($sql, $conn);
		}

		// Call Recordset Selected event
		$this->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	public function loadRow()
	{
		global $Security, $Language;
		$filter = $this->getRecordFilter();

		// Call Row Selecting event
		$this->Row_Selecting($filter);

		// Load SQL based on filter
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		$res = FALSE;
		$rs = LoadRecordset($sql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->loadRowValues($rs); // Load row values
			$rs->close();
		}
		return $res;
	}

	// Load row values from recordset
	public function loadRowValues($rs = NULL)
	{
		if ($rs && !$rs->EOF)
			$row = $rs->fields;
		else
			$row = $this->newRow();

		// Call Row Selected event
		$this->Row_Selected($row);
		if (!$rs || $rs->EOF)
			return;
		if ($this->AuditTrailOnView)
			$this->writeAuditTrailOnView($row);
		$this->EmployeeID->setDbValue($row['EmployeeID']);
		$this->ProvinceCode->setDbValue($row['ProvinceCode']);
		$this->LACode->setDbValue($row['LACode']);
		$this->PoliticalParty->setDbValue($row['PoliticalParty']);
		$this->Occupation->setDbValue($row['Occupation']);
		$this->PositionInCouncil->setDbValue($row['PositionInCouncil']);
		$this->Committee->setDbValue($row['Committee']);
		$this->CommitteeRole->setDbValue($row['CommitteeRole']);
		$this->CouncilTerm->setDbValue($row['CouncilTerm']);
		$this->DateOfExit->setDbValue($row['DateOfExit']);
		$this->Allowance->setDbValue($row['Allowance']);
		$this->CouncillorTypeType->setDbValue($row['CouncillorTypeType']);
		$this->CouncillorshipStatus->setDbValue($row['CouncillorshipStatus']);
		$this->ExitReason->setDbValue($row['ExitReason']);
		$this->RetirementType->setDbValue($row['RetirementType']);
		$this->CouncillorPhoto->Upload->DbValue = $row['CouncillorPhoto'];
		if (is_array($this->CouncillorPhoto->Upload->DbValue) || is_object($this->CouncillorPhoto->Upload->DbValue)) // Byte array
			$this->CouncillorPhoto->Upload->DbValue = BytesToString($this->CouncillorPhoto->Upload->DbValue);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['EmployeeID'] = NULL;
		$row['ProvinceCode'] = NULL;
		$row['LACode'] = NULL;
		$row['PoliticalParty'] = NULL;
		$row['Occupation'] = NULL;
		$row['PositionInCouncil'] = NULL;
		$row['Committee'] = NULL;
		$row['CommitteeRole'] = NULL;
		$row['CouncilTerm'] = NULL;
		$row['DateOfExit'] = NULL;
		$row['Allowance'] = NULL;
		$row['CouncillorTypeType'] = NULL;
		$row['CouncillorshipStatus'] = NULL;
		$row['ExitReason'] = NULL;
		$row['RetirementType'] = NULL;
		$row['CouncillorPhoto'] = NULL;
		return $row;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		$this->AddUrl = $this->getAddUrl();
		$this->EditUrl = $this->getEditUrl();
		$this->CopyUrl = $this->getCopyUrl();
		$this->DeleteUrl = $this->getDeleteUrl();
		$this->ListUrl = $this->getListUrl();
		$this->setupOtherOptions();

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// EmployeeID
		// ProvinceCode
		// LACode
		// PoliticalParty
		// Occupation
		// PositionInCouncil
		// Committee
		// CommitteeRole
		// CouncilTerm
		// DateOfExit
		// Allowance
		// CouncillorTypeType
		// CouncillorshipStatus
		// ExitReason
		// RetirementType
		// CouncillorPhoto

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// EmployeeID
			$this->EmployeeID->ViewValue = $this->EmployeeID->CurrentValue;
			$curVal = strval($this->EmployeeID->CurrentValue);
			if ($curVal != "") {
				$this->EmployeeID->ViewValue = $this->EmployeeID->lookupCacheOption($curVal);
				if ($this->EmployeeID->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`EmployeeID`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->EmployeeID->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$arwrk[3] = $rswrk->fields('df3');
						$this->EmployeeID->ViewValue = $this->EmployeeID->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->EmployeeID->ViewValue = $this->EmployeeID->CurrentValue;
					}
				}
			} else {
				$this->EmployeeID->ViewValue = NULL;
			}
			$this->EmployeeID->ViewCustomAttributes = "";

			// ProvinceCode
			$this->ProvinceCode->ViewValue = $this->ProvinceCode->CurrentValue;
			$curVal = strval($this->ProvinceCode->CurrentValue);
			if ($curVal != "") {
				$this->ProvinceCode->ViewValue = $this->ProvinceCode->lookupCacheOption($curVal);
				if ($this->ProvinceCode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`ProvinceCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ProvinceCode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->ProvinceCode->ViewValue = $this->ProvinceCode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ProvinceCode->ViewValue = $this->ProvinceCode->CurrentValue;
					}
				}
			} else {
				$this->ProvinceCode->ViewValue = NULL;
			}
			$this->ProvinceCode->ViewCustomAttributes = "";

			// LACode
			$curVal = strval($this->LACode->CurrentValue);
			if ($curVal != "") {
				$this->LACode->ViewValue = $this->LACode->lookupCacheOption($curVal);
				if ($this->LACode->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`LACode`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->LACode->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->LACode->ViewValue = $this->LACode->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->LACode->ViewValue = $this->LACode->CurrentValue;
					}
				}
			} else {
				$this->LACode->ViewValue = NULL;
			}
			$this->LACode->ViewCustomAttributes = "";

			// PoliticalParty
			$curVal = strval($this->PoliticalParty->CurrentValue);
			if ($curVal != "") {
				$this->PoliticalParty->ViewValue = $this->PoliticalParty->lookupCacheOption($curVal);
				if ($this->PoliticalParty->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`PoliticalParty`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->PoliticalParty->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->PoliticalParty->ViewValue = $this->PoliticalParty->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->PoliticalParty->ViewValue = $this->PoliticalParty->CurrentValue;
					}
				}
			} else {
				$this->PoliticalParty->ViewValue = NULL;
			}
			$this->PoliticalParty->ViewCustomAttributes = "";

			// Occupation
			$curVal = strval($this->Occupation->CurrentValue);
			if ($curVal != "") {
				$this->Occupation->ViewValue = $this->Occupation->lookupCacheOption($curVal);
				if ($this->Occupation->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`OccupationCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->Occupation->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->Occupation->ViewValue = $this->Occupation->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->Occupation->ViewValue = $this->Occupation->CurrentValue;
					}
				}
			} else {
				$this->Occupation->ViewValue = NULL;
			}
			$this->Occupation->ViewCustomAttributes = "";

			// PositionInCouncil
			$curVal = strval($this->PositionInCouncil->CurrentValue);
			if ($curVal != "") {
				$this->PositionInCouncil->ViewValue = $this->PositionInCouncil->lookupCacheOption($curVal);
				if ($this->PositionInCouncil->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`PositionCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->PositionInCouncil->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->PositionInCouncil->ViewValue = $this->PositionInCouncil->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->PositionInCouncil->ViewValue = $this->PositionInCouncil->CurrentValue;
					}
				}
			} else {
				$this->PositionInCouncil->ViewValue = NULL;
			}
			$this->PositionInCouncil->ViewCustomAttributes = "";

			// Committee
			$curVal = strval($this->Committee->CurrentValue);
			if ($curVal != "") {
				$this->Committee->ViewValue = $this->Committee->lookupCacheOption($curVal);
				if ($this->Committee->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`CommitteCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->Committee->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->Committee->ViewValue = $this->Committee->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->Committee->ViewValue = $this->Committee->CurrentValue;
					}
				}
			} else {
				$this->Committee->ViewValue = NULL;
			}
			$this->Committee->ViewCustomAttributes = "";

			// CommitteeRole
			$curVal = strval($this->CommitteeRole->CurrentValue);
			if ($curVal != "") {
				$this->CommitteeRole->ViewValue = $this->CommitteeRole->lookupCacheOption($curVal);
				if ($this->CommitteeRole->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`CommitteeRole`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->CommitteeRole->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->CommitteeRole->ViewValue = $this->CommitteeRole->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->CommitteeRole->ViewValue = $this->CommitteeRole->CurrentValue;
					}
				}
			} else {
				$this->CommitteeRole->ViewValue = NULL;
			}
			$this->CommitteeRole->ViewCustomAttributes = "";

			// CouncilTerm
			$curVal = strval($this->CouncilTerm->CurrentValue);
			if ($curVal != "") {
				$this->CouncilTerm->ViewValue = $this->CouncilTerm->lookupCacheOption($curVal);
				if ($this->CouncilTerm->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`TermStartYear`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->CouncilTerm->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = FormatNumber($rswrk->fields('df2'), Config("DEFAULT_DECIMAL_PRECISION"));
						$this->CouncilTerm->ViewValue = $this->CouncilTerm->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->CouncilTerm->ViewValue = $this->CouncilTerm->CurrentValue;
					}
				}
			} else {
				$this->CouncilTerm->ViewValue = NULL;
			}
			$this->CouncilTerm->ViewCustomAttributes = "";

			// DateOfExit
			$this->DateOfExit->ViewValue = $this->DateOfExit->CurrentValue;
			$this->DateOfExit->ViewValue = FormatDateTime($this->DateOfExit->ViewValue, 0);
			$this->DateOfExit->ViewCustomAttributes = "";

			// Allowance
			$this->Allowance->ViewValue = $this->Allowance->CurrentValue;
			$this->Allowance->CellCssStyle .= "text-align: right;";
			$this->Allowance->ViewCustomAttributes = "";

			// CouncillorTypeType
			$curVal = strval($this->CouncillorTypeType->CurrentValue);
			if ($curVal != "") {
				$this->CouncillorTypeType->ViewValue = $this->CouncillorTypeType->lookupCacheOption($curVal);
				if ($this->CouncillorTypeType->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`CouncillorType`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->CouncillorTypeType->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->CouncillorTypeType->ViewValue = $this->CouncillorTypeType->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->CouncillorTypeType->ViewValue = $this->CouncillorTypeType->CurrentValue;
					}
				}
			} else {
				$this->CouncillorTypeType->ViewValue = NULL;
			}
			$this->CouncillorTypeType->ViewCustomAttributes = "";

			// ExitReason
			$curVal = strval($this->ExitReason->CurrentValue);
			if ($curVal != "") {
				$this->ExitReason->ViewValue = $this->ExitReason->lookupCacheOption($curVal);
				if ($this->ExitReason->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`CouncillorsipStatus`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ExitReason->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->ExitReason->ViewValue = $this->ExitReason->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ExitReason->ViewValue = $this->ExitReason->CurrentValue;
					}
				}
			} else {
				$this->ExitReason->ViewValue = NULL;
			}
			$this->ExitReason->ViewCustomAttributes = "";

			// CouncillorPhoto
			if (!EmptyValue($this->CouncillorPhoto->Upload->DbValue)) {
				$this->CouncillorPhoto->ViewValue = $this->EmployeeID->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->LACode->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->PositionInCouncil->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->CouncilTerm->CurrentValue;
				$this->CouncillorPhoto->IsBlobImage = IsImageFile(ContentExtension($this->CouncillorPhoto->Upload->DbValue));
			} else {
				$this->CouncillorPhoto->ViewValue = "";
			}
			$this->CouncillorPhoto->ViewCustomAttributes = "";

			// EmployeeID
			$this->EmployeeID->LinkCustomAttributes = "";
			$this->EmployeeID->HrefValue = "";
			$this->EmployeeID->TooltipValue = "";

			// ProvinceCode
			$this->ProvinceCode->LinkCustomAttributes = "";
			$this->ProvinceCode->HrefValue = "";
			$this->ProvinceCode->TooltipValue = "";

			// LACode
			$this->LACode->LinkCustomAttributes = "";
			$this->LACode->HrefValue = "";
			$this->LACode->TooltipValue = "";

			// PoliticalParty
			$this->PoliticalParty->LinkCustomAttributes = "";
			$this->PoliticalParty->HrefValue = "";
			$this->PoliticalParty->TooltipValue = "";

			// Occupation
			$this->Occupation->LinkCustomAttributes = "";
			$this->Occupation->HrefValue = "";
			$this->Occupation->TooltipValue = "";

			// PositionInCouncil
			$this->PositionInCouncil->LinkCustomAttributes = "";
			$this->PositionInCouncil->HrefValue = "";
			$this->PositionInCouncil->TooltipValue = "";

			// Committee
			$this->Committee->LinkCustomAttributes = "";
			$this->Committee->HrefValue = "";
			$this->Committee->TooltipValue = "";

			// CommitteeRole
			$this->CommitteeRole->LinkCustomAttributes = "";
			$this->CommitteeRole->HrefValue = "";
			$this->CommitteeRole->TooltipValue = "";

			// CouncilTerm
			$this->CouncilTerm->LinkCustomAttributes = "";
			$this->CouncilTerm->HrefValue = "";
			$this->CouncilTerm->TooltipValue = "";

			// DateOfExit
			$this->DateOfExit->LinkCustomAttributes = "";
			$this->DateOfExit->HrefValue = "";
			$this->DateOfExit->TooltipValue = "";

			// Allowance
			$this->Allowance->LinkCustomAttributes = "";
			$this->Allowance->HrefValue = "";
			$this->Allowance->TooltipValue = "";

			// CouncillorTypeType
			$this->CouncillorTypeType->LinkCustomAttributes = "";
			$this->CouncillorTypeType->HrefValue = "";
			$this->CouncillorTypeType->TooltipValue = "";

			// ExitReason
			$this->ExitReason->LinkCustomAttributes = "";
			$this->ExitReason->HrefValue = "";
			$this->ExitReason->TooltipValue = "";

			// CouncillorPhoto
			$this->CouncillorPhoto->LinkCustomAttributes = "";
			if (!empty($this->CouncillorPhoto->Upload->DbValue)) {
				$this->CouncillorPhoto->HrefValue = GetFileUploadUrl($this->CouncillorPhoto, $this->EmployeeID->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->LACode->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->PositionInCouncil->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->CouncilTerm->CurrentValue);
				$this->CouncillorPhoto->LinkAttrs["target"] = "";
				if ($this->CouncillorPhoto->IsBlobImage && empty($this->CouncillorPhoto->LinkAttrs["target"]))
					$this->CouncillorPhoto->LinkAttrs["target"] = "_blank";
				if ($this->isExport())
					$this->CouncillorPhoto->HrefValue = FullUrl($this->CouncillorPhoto->HrefValue, "href");
			} else {
				$this->CouncillorPhoto->HrefValue = "";
			}
			$this->CouncillorPhoto->ExportHrefValue = GetFileUploadUrl($this->CouncillorPhoto, $this->EmployeeID->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->LACode->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->PositionInCouncil->CurrentValue . Config("COMPOSITE_KEY_SEPARATOR") . $this->CouncilTerm->CurrentValue);
			$this->CouncillorPhoto->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($this->RowType != ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Get export HTML tag
	protected function getExportTag($type, $custom = FALSE)
	{
		global $Language;
		if (SameText($type, "excel")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" onclick=\"return ew.export(document.fcouncillorshipview, '" . $this->ExportExcelUrl . "', 'excel', true);\">" . $Language->phrase("ExportToExcel") . "</a>";
			else
				return "<a href=\"" . $this->ExportExcelUrl . "\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\">" . $Language->phrase("ExportToExcel") . "</a>";
		} elseif (SameText($type, "word")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" onclick=\"return ew.export(document.fcouncillorshipview, '" . $this->ExportWordUrl . "', 'word', true);\">" . $Language->phrase("ExportToWord") . "</a>";
			else
				return "<a href=\"" . $this->ExportWordUrl . "\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\">" . $Language->phrase("ExportToWord") . "</a>";
		} elseif (SameText($type, "pdf")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" onclick=\"return ew.export(document.fcouncillorshipview, '" . $this->ExportPdfUrl . "', 'pdf', true);\">" . $Language->phrase("ExportToPDF") . "</a>";
			else
				return "<a href=\"" . $this->ExportPdfUrl . "\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\">" . $Language->phrase("ExportToPDF") . "</a>";
		} elseif (SameText($type, "html")) {
			return "<a href=\"" . $this->ExportHtmlUrl . "\" class=\"ew-export-link ew-html\" title=\"" . HtmlEncode($Language->phrase("ExportToHtmlText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToHtmlText")) . "\">" . $Language->phrase("ExportToHtml") . "</a>";
		} elseif (SameText($type, "xml")) {
			return "<a href=\"" . $this->ExportXmlUrl . "\" class=\"ew-export-link ew-xml\" title=\"" . HtmlEncode($Language->phrase("ExportToXmlText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToXmlText")) . "\">" . $Language->phrase("ExportToXml") . "</a>";
		} elseif (SameText($type, "csv")) {
			return "<a href=\"" . $this->ExportCsvUrl . "\" class=\"ew-export-link ew-csv\" title=\"" . HtmlEncode($Language->phrase("ExportToCsvText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToCsvText")) . "\">" . $Language->phrase("ExportToCsv") . "</a>";
		} elseif (SameText($type, "email")) {
			$url = $custom ? ",url:'" . $this->pageUrl() . "export=email&amp;custom=1'" : "";
			return '<button id="emf_councillorship" class="ew-export-link ew-email" title="' . $Language->phrase("ExportToEmailText") . '" data-caption="' . $Language->phrase("ExportToEmailText") . '" onclick="ew.emailDialogShow({lnk:\'emf_councillorship\', hdr:ew.language.phrase(\'ExportToEmailText\'), f:document.fcouncillorshipview, key:' . ArrayToJsonAttribute($this->RecKey) . ', sel:false' . $url . '});">' . $Language->phrase("ExportToEmail") . '</button>';
		} elseif (SameText($type, "print")) {
			return "<a href=\"" . $this->ExportPrintUrl . "\" class=\"ew-export-link ew-print\" title=\"" . HtmlEncode($Language->phrase("PrinterFriendlyText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("PrinterFriendlyText")) . "\">" . $Language->phrase("PrinterFriendly") . "</a>";
		}
	}

	// Set up export options
	protected function setupExportOptions()
	{
		global $Language;

		// Printer friendly
		$item = &$this->ExportOptions->add("print");
		$item->Body = $this->getExportTag("print");
		$item->Visible = TRUE;

		// Export to Excel
		$item = &$this->ExportOptions->add("excel");
		$item->Body = $this->getExportTag("excel");
		$item->Visible = TRUE;

		// Export to Word
		$item = &$this->ExportOptions->add("word");
		$item->Body = $this->getExportTag("word");
		$item->Visible = TRUE;

		// Export to Html
		$item = &$this->ExportOptions->add("html");
		$item->Body = $this->getExportTag("html");
		$item->Visible = TRUE;

		// Export to Xml
		$item = &$this->ExportOptions->add("xml");
		$item->Body = $this->getExportTag("xml");
		$item->Visible = TRUE;

		// Export to Csv
		$item = &$this->ExportOptions->add("csv");
		$item->Body = $this->getExportTag("csv");
		$item->Visible = TRUE;

		// Export to Pdf
		$item = &$this->ExportOptions->add("pdf");
		$item->Body = $this->getExportTag("pdf");
		$item->Visible = TRUE;

		// Export to Email
		$item = &$this->ExportOptions->add("email");
		$item->Body = $this->getExportTag("email");
		$item->Visible = FALSE;

		// Drop down button for export
		$this->ExportOptions->UseButtonGroup = TRUE;
		$this->ExportOptions->UseDropDownButton = FALSE;
		if ($this->ExportOptions->UseButtonGroup && IsMobile())
			$this->ExportOptions->UseDropDownButton = TRUE;
		$this->ExportOptions->DropDownButtonPhrase = $Language->phrase("ButtonExport");

		// Add group option item
		$item = &$this->ExportOptions->add($this->ExportOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Hide options for export
		if ($this->isExport())
			$this->ExportOptions->hideAllOptions();
	}

	/**
	 * Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
	 *
	 * @param boolean $return Return the data rather than output it
	 * @return mixed
	 */
	public function exportData($return = FALSE)
	{
		global $Language;
		$utf8 = SameText(Config("PROJECT_CHARSET"), "utf-8");
		$selectLimit = FALSE;

		// Load recordset
		if ($selectLimit) {
			$this->TotalRecords = $this->listRecordCount();
		} else {
			if (!$this->Recordset)
				$this->Recordset = $this->loadRecordset();
			$rs = &$this->Recordset;
			if ($rs)
				$this->TotalRecords = $rs->RecordCount();
		}
		$this->StartRecord = 1;
		$this->setupStartRecord(); // Set up start record position

		// Set the last record to display
		if ($this->DisplayRecords <= 0) {
			$this->StopRecord = $this->TotalRecords;
		} else {
			$this->StopRecord = $this->StartRecord + $this->DisplayRecords - 1;
		}
		$this->ExportDoc = GetExportDocument($this, "v");
		$doc = &$this->ExportDoc;
		if (!$doc)
			$this->setFailureMessage($Language->phrase("ExportClassNotFound")); // Export class not found
		if (!$rs || !$doc) {
			RemoveHeader("Content-Type"); // Remove header
			RemoveHeader("Content-Disposition");
			$this->showMessage();
			return;
		}
		if ($selectLimit) {
			$this->StartRecord = 1;
			$this->StopRecord = $this->DisplayRecords <= 0 ? $this->TotalRecords : $this->DisplayRecords;
		}

		// Call Page Exporting server event
		$this->ExportDoc->ExportCustom = !$this->Page_Exporting();
		$header = $this->PageHeader;
		$this->Page_DataRendering($header);
		$doc->Text .= $header;
		$this->exportDocument($doc, $rs, $this->StartRecord, $this->StopRecord, "view");

		// Export detail records (councillor_allowance)
		if (Config("EXPORT_DETAIL_RECORDS") && in_array("councillor_allowance", explode(",", $this->getCurrentDetailTable()))) {
			global $councillor_allowance;
			if (!isset($councillor_allowance))
				$councillor_allowance = new councillor_allowance();
			$rsdetail = $councillor_allowance->loadRs($councillor_allowance->getDetailFilter()); // Load detail records
			if ($rsdetail && !$rsdetail->EOF) {
				$exportStyle = $doc->Style;
				$doc->setStyle("h"); // Change to horizontal
				if (!$this->isExport("csv") || Config("EXPORT_DETAIL_RECORDS_FOR_CSV")) {
					$doc->exportEmptyRow();
					$detailcnt = $rsdetail->RecordCount();
					$oldtbl = $doc->Table;
					$doc->Table = $councillor_allowance;
					$councillor_allowance->exportDocument($doc, $rsdetail, 1, $detailcnt);
					$doc->Table = $oldtbl;
				}
				$doc->setStyle($exportStyle); // Restore
				$rsdetail->close();
			}
		}

		// Export detail records (committee_appointed)
		if (Config("EXPORT_DETAIL_RECORDS") && in_array("committee_appointed", explode(",", $this->getCurrentDetailTable()))) {
			global $committee_appointed;
			if (!isset($committee_appointed))
				$committee_appointed = new committee_appointed();
			$rsdetail = $committee_appointed->loadRs($committee_appointed->getDetailFilter()); // Load detail records
			if ($rsdetail && !$rsdetail->EOF) {
				$exportStyle = $doc->Style;
				$doc->setStyle("h"); // Change to horizontal
				if (!$this->isExport("csv") || Config("EXPORT_DETAIL_RECORDS_FOR_CSV")) {
					$doc->exportEmptyRow();
					$detailcnt = $rsdetail->RecordCount();
					$oldtbl = $doc->Table;
					$doc->Table = $committee_appointed;
					$committee_appointed->exportDocument($doc, $rsdetail, 1, $detailcnt);
					$doc->Table = $oldtbl;
				}
				$doc->setStyle($exportStyle); // Restore
				$rsdetail->close();
			}
		}
		$footer = $this->PageFooter;
		$this->Page_DataRendered($footer);
		$doc->Text .= $footer;

		// Close recordset
		$rs->close();

		// Call Page Exported server event
		$this->Page_Exported();

		// Export header and footer
		$doc->exportHeaderAndFooter();

		// Clean output buffer (without destroying output buffer)
		$buffer = ob_get_contents(); // Save the output buffer
		if (!Config("DEBUG") && $buffer)
			ob_clean();

		// Write debug message if enabled
		if (Config("DEBUG") && !$this->isExport("pdf"))
			echo GetDebugMessage();

		// Output data
		if ($this->isExport("email")) {

			// Export-to-email disabled
		} else {
			$doc->export();
			if ($return) {
				RemoveHeader("Content-Type"); // Remove header
				RemoveHeader("Content-Disposition");
				$content = ob_get_contents();
				if ($content)
					ob_clean();
				if ($buffer)
					echo $buffer; // Resume the output buffer
				return $content;
			}
		}
	}

	// Set up master/detail based on QueryString
	protected function setupMasterParms()
	{
		$validMaster = FALSE;

		// Get the keys for master table
		if (($master = Get(Config("TABLE_SHOW_MASTER"), Get(Config("TABLE_MASTER")))) !== NULL) {
			$masterTblVar = $master;
			if ($masterTblVar == "") {
				$validMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($masterTblVar == "councillor") {
				$validMaster = TRUE;
				if (($parm = Get("fk_EmployeeID", Get("EmployeeID"))) !== NULL) {
					$GLOBALS["councillor"]->EmployeeID->setQueryStringValue($parm);
					$this->EmployeeID->setQueryStringValue($GLOBALS["councillor"]->EmployeeID->QueryStringValue);
					$this->EmployeeID->setSessionValue($this->EmployeeID->QueryStringValue);
					if (!is_numeric($GLOBALS["councillor"]->EmployeeID->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
			if ($masterTblVar == "local_authority") {
				$validMaster = TRUE;
				if (($parm = Get("fk_LACode", Get("LACode"))) !== NULL) {
					$GLOBALS["local_authority"]->LACode->setQueryStringValue($parm);
					$this->LACode->setQueryStringValue($GLOBALS["local_authority"]->LACode->QueryStringValue);
					$this->LACode->setSessionValue($this->LACode->QueryStringValue);
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Get("fk_ProvinceCode", Get("ProvinceCode"))) !== NULL) {
					$GLOBALS["local_authority"]->ProvinceCode->setQueryStringValue($parm);
					$this->ProvinceCode->setQueryStringValue($GLOBALS["local_authority"]->ProvinceCode->QueryStringValue);
					$this->ProvinceCode->setSessionValue($this->ProvinceCode->QueryStringValue);
					if (!is_numeric($GLOBALS["local_authority"]->ProvinceCode->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
		} elseif (($master = Post(Config("TABLE_SHOW_MASTER"), Post(Config("TABLE_MASTER")))) !== NULL) {
			$masterTblVar = $master;
			if ($masterTblVar == "") {
				$validMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($masterTblVar == "councillor") {
				$validMaster = TRUE;
				if (($parm = Post("fk_EmployeeID", Post("EmployeeID"))) !== NULL) {
					$GLOBALS["councillor"]->EmployeeID->setFormValue($parm);
					$this->EmployeeID->setFormValue($GLOBALS["councillor"]->EmployeeID->FormValue);
					$this->EmployeeID->setSessionValue($this->EmployeeID->FormValue);
					if (!is_numeric($GLOBALS["councillor"]->EmployeeID->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
			if ($masterTblVar == "local_authority") {
				$validMaster = TRUE;
				if (($parm = Post("fk_LACode", Post("LACode"))) !== NULL) {
					$GLOBALS["local_authority"]->LACode->setFormValue($parm);
					$this->LACode->setFormValue($GLOBALS["local_authority"]->LACode->FormValue);
					$this->LACode->setSessionValue($this->LACode->FormValue);
				} else {
					$validMaster = FALSE;
				}
				if (($parm = Post("fk_ProvinceCode", Post("ProvinceCode"))) !== NULL) {
					$GLOBALS["local_authority"]->ProvinceCode->setFormValue($parm);
					$this->ProvinceCode->setFormValue($GLOBALS["local_authority"]->ProvinceCode->FormValue);
					$this->ProvinceCode->setSessionValue($this->ProvinceCode->FormValue);
					if (!is_numeric($GLOBALS["local_authority"]->ProvinceCode->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
		}
		if ($validMaster) {

			// Save current master table
			$this->setCurrentMasterTable($masterTblVar);
			$this->setSessionWhere($this->getDetailFilter());

			// Reset start record counter (new master key)
			if (!$this->isAddOrEdit()) {
				$this->StartRecord = 1;
				$this->setStartRecordNumber($this->StartRecord);
			}

			// Clear previous master key from Session
			if ($masterTblVar != "councillor") {
				if ($this->EmployeeID->CurrentValue == "")
					$this->EmployeeID->setSessionValue("");
			}
			if ($masterTblVar != "local_authority") {
				if ($this->LACode->CurrentValue == "")
					$this->LACode->setSessionValue("");
				if ($this->ProvinceCode->CurrentValue == "")
					$this->ProvinceCode->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $this->getMasterFilter(); // Get master filter
		$this->DbDetailFilter = $this->getDetailFilter(); // Get detail filter
	}

	// Set up detail parms based on QueryString
	protected function setupDetailParms()
	{

		// Get the keys for master table
		$detailTblVar = Get(Config("TABLE_SHOW_DETAIL"));
		if ($detailTblVar !== NULL) {
			$this->setCurrentDetailTable($detailTblVar);
		} else {
			$detailTblVar = $this->getCurrentDetailTable();
		}
		if ($detailTblVar != "") {
			$detailTblVar = explode(",", $detailTblVar);
			if (in_array("councillor_allowance", $detailTblVar)) {
				if (!isset($GLOBALS["councillor_allowance_grid"]))
					$GLOBALS["councillor_allowance_grid"] = new councillor_allowance_grid();
				if ($GLOBALS["councillor_allowance_grid"]->DetailView) {
					$GLOBALS["councillor_allowance_grid"]->CurrentMode = "view";

					// Save current master table to detail table
					$GLOBALS["councillor_allowance_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["councillor_allowance_grid"]->setStartRecordNumber(1);
					$GLOBALS["councillor_allowance_grid"]->EmployeeID->IsDetailKey = TRUE;
					$GLOBALS["councillor_allowance_grid"]->EmployeeID->CurrentValue = $this->EmployeeID->CurrentValue;
					$GLOBALS["councillor_allowance_grid"]->EmployeeID->setSessionValue($GLOBALS["councillor_allowance_grid"]->EmployeeID->CurrentValue);
				}
			}
			if (in_array("committee_appointed", $detailTblVar)) {
				if (!isset($GLOBALS["committee_appointed_grid"]))
					$GLOBALS["committee_appointed_grid"] = new committee_appointed_grid();
				if ($GLOBALS["committee_appointed_grid"]->DetailView) {
					$GLOBALS["committee_appointed_grid"]->CurrentMode = "view";

					// Save current master table to detail table
					$GLOBALS["committee_appointed_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["committee_appointed_grid"]->setStartRecordNumber(1);
					$GLOBALS["committee_appointed_grid"]->EmployeeID->IsDetailKey = TRUE;
					$GLOBALS["committee_appointed_grid"]->EmployeeID->CurrentValue = $this->EmployeeID->CurrentValue;
					$GLOBALS["committee_appointed_grid"]->EmployeeID->setSessionValue($GLOBALS["committee_appointed_grid"]->EmployeeID->CurrentValue);
				}
			}
		}
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("councillorshiplist.php"), "", $this->TableVar, TRUE);
		$pageId = "view";
		$Breadcrumb->add("view", $pageId, $url);
	}

	// Setup lookup options
	public function setupLookupOptions($fld)
	{
		if ($fld->Lookup !== NULL && $fld->Lookup->Options === NULL) {

			// Get default connection and filter
			$conn = $this->getConnection();
			$lookupFilter = "";

			// No need to check any more
			$fld->Lookup->Options = [];

			// Set up lookup SQL and connection
			switch ($fld->FieldVar) {
				case "x_EmployeeID":
					break;
				case "x_ProvinceCode":
					break;
				case "x_LACode":
					break;
				case "x_PoliticalParty":
					break;
				case "x_Occupation":
					break;
				case "x_PositionInCouncil":
					break;
				case "x_Committee":
					break;
				case "x_CommitteeRole":
					break;
				case "x_CouncilTerm":
					break;
				case "x_CouncillorTypeType":
					break;
				case "x_CouncillorshipStatus":
					break;
				case "x_ExitReason":
					break;
				case "x_RetirementType":
					break;
				default:
					$lookupFilter = "";
					break;
			}

			// Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
			$sql = $fld->Lookup->getSql(FALSE, "", $lookupFilter, $this);

			// Set up lookup cache
			if ($fld->UseLookupCache && $sql != "" && count($fld->Lookup->Options) == 0) {
				$totalCnt = $this->getRecordCount($sql, $conn);
				if ($totalCnt > $fld->LookupCacheCount) // Total count > cache count, do not cache
					return;
				$rs = $conn->execute($sql);
				$ar = [];
				while ($rs && !$rs->EOF) {
					$row = &$rs->fields;

					// Format the field values
					switch ($fld->FieldVar) {
						case "x_EmployeeID":
							break;
						case "x_ProvinceCode":
							break;
						case "x_LACode":
							break;
						case "x_PoliticalParty":
							break;
						case "x_Occupation":
							break;
						case "x_PositionInCouncil":
							break;
						case "x_Committee":
							break;
						case "x_CommitteeRole":
							break;
						case "x_CouncilTerm":
							$row[2] = FormatNumber($row[2], Config("DEFAULT_DECIMAL_PRECISION"));
							$row['df2'] = $row[2];
							break;
						case "x_CouncillorTypeType":
							break;
						case "x_CouncillorshipStatus":
							break;
						case "x_ExitReason":
							break;
						case "x_RetirementType":
							break;
					}
					$ar[strval($row[0])] = $row;
					$rs->moveNext();
				}
				if ($rs)
					$rs->close();
				$fld->Lookup->Options = $ar;
			}
		}
	}

	// Set up starting record parameters
	public function setupStartRecord()
	{
		if ($this->DisplayRecords == 0)
			return;
		if ($this->isPageRequest()) { // Validate request
			$startRec = Get(Config("TABLE_START_REC"));
			$pageNo = Get(Config("TABLE_PAGE_NO"));
			if ($pageNo !== NULL) { // Check for "pageno" parameter first
				if (is_numeric($pageNo)) {
					$this->StartRecord = ($pageNo - 1) * $this->DisplayRecords + 1;
					if ($this->StartRecord <= 0) {
						$this->StartRecord = 1;
					} elseif ($this->StartRecord >= (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1) {
						$this->StartRecord = (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1;
					}
					$this->setStartRecordNumber($this->StartRecord);
				}
			} elseif ($startRec !== NULL) { // Check for "start" parameter
				$this->StartRecord = $startRec;
				$this->setStartRecordNumber($this->StartRecord);
			}
		}
		$this->StartRecord = $this->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRecord) || $this->StartRecord == "") { // Avoid invalid start record counter
			$this->StartRecord = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRecord);
		} elseif ($this->StartRecord > $this->TotalRecords) { // Avoid starting record > total records
			$this->StartRecord = (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1; // Point to last page first record
			$this->setStartRecordNumber($this->StartRecord);
		} elseif (($this->StartRecord - 1) % $this->DisplayRecords != 0) {
			$this->StartRecord = (int)(($this->StartRecord - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1; // Point to page boundary
			$this->setStartRecordNumber($this->StartRecord);
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Page Exporting event
	// $this->ExportDoc = export document object
	function Page_Exporting() {

		//$this->ExportDoc->Text = "my header"; // Export header
		//return FALSE; // Return FALSE to skip default export and use Row_Export event

		return TRUE; // Return TRUE to use default export and skip Row_Export event
	}

	// Row Export event
	// $this->ExportDoc = export document object
	function Row_Export($rs) {

		//$this->ExportDoc->Text .= "my content"; // Build HTML with field value: $rs["MyField"] or $this->MyField->ViewValue
	}

	// Page Exported event
	// $this->ExportDoc = export document object
	function Page_Exported() {

		//$this->ExportDoc->Text .= "my footer"; // Export footer
		//echo $this->ExportDoc->Text;

	}
} // End class
?>