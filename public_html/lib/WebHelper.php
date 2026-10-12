<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/lib/email/PHPMailer.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/lib/email/SMTP.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/lib/email/Exception.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class MailHelper
{
    private $mail;
    private $Host     = 'smtp.gmail.com';
    private $Username = 'paulpurigen@gmail.com';
    private $Password = '9ur163n!!';
    
    private $senderName = "Purigen Lead from Web";
    private $senderEmail = "noreply@purigen.com";

    public function __construct()
    {
        $this->mail = new PHPMailer(true);
        $this->mail->ContentType = "text/html";
        $this->mail->CharSet = "utf-8";
       
        $this->mail->SMTPDebug = 1;
        $this->mail->SMTPAuth = true;
        $this->mail->SMTPSecure = "tls";
        $this->mail->Port = 587;
        $this->mail->Host = $this->Host;
        $this->mail->Username = $this->Username;
        $this->mail->Password = $this->Password;
    }
    
    public function sendmail($toname, $toemail, $subject, $message, $html = true)
    {
        if($toemail == null || $toemail == "") return;
        
        $this->mail->IsHTML($html);
        $this->mail->AddAddress($toemail, $toname);
        $this->mail->SetFrom($this->senderEmail, $this->senderName);
        $this->mail->Subject = $subject;
        $this->mail->Body = $message;
        
        $this->mail->send();
    }
    
    public function sendmailToManger($subject, $message, $html = true)
    {
        $this->mail->IsHTML($html);
        $this->mail->AddAddress("paul@purigenbio.com", "Paul");
        //$this->mail->AddAddress("chris@purigenbio.com", "Chris");
		//$this->mail->AddAddress("jay.gerlach@purigenbio.com", "Jay");
        //$this->mail->AddAddress("cshbi90@gmail.com", "Han");
        $this->mail->SetFrom($this->senderEmail, $this->senderName);
        $this->mail->Subject = $subject;
        $this->mail->Body = $message;
        
        $this->mail->send();
    }
}

class WebHelper
{
    private $LoginMinute = 60; //if you want login time change that you can change this value. 60 means 1 hr.
    private $UploadPath;
    
    private $grecptcha_site_key = "6LdG-P0UAAAAAEsDdXq_RkQ72fWACGNkgiEFj98A";
    private $grecaptcha_secret_key = "6LdG-P0UAAAAAIrtmupBC_nIM4scNqoyi8sWcNqQ";

    //ToDo : change real domain and indexpage
    public $Domain;

    public function __construct()
    {
        $this->setUploadPath($_SERVER['DOCUMENT_ROOT'] . '/files');
        $this->setDomain(getenv('DOMAIN'));
    }

    public function AESEncrypt256($input)
    {
        return base64_encode(openssl_encrypt($input, "aes-256-cbc", getenv('SECURITY_KEY'), true, str_repeat(chr(0), 16)));
    }

    public function AESDecrypt256($input)
    {
        return openssl_decrypt(base64_decode($input), "aes-256-cbc", getenv('SECURITY_KEY'), true, str_repeat(chr(0), 16));
    }
    
    public function GetCaptchaSiteKey()
    {
        return $this->grecptcha_site_key;
    }
    
    public function GetCaptchaSecretKey()
    {
        return $this->grecaptcha_secret_key;
    }

    public function slugify($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }
        return $text;
    }

    public function getPaging($RecordCount, $RequestPage, $PageSize)

    {
        $j = 0;
        $pagehelper = new PageHelper();

        try {
            $pagehelper->RecordCount = $RecordCount;
            $pagehelper->PageCount = (int)($pagehelper->RecordCount / $PageSize);
            if (($pagehelper->RecordCount % $PageSize) != 0)
                $pagehelper->PageCount++;

            if ($pagehelper->RecordCount > 0) {
                if ($RequestPage <= $pagehelper->PageCount) {
                    $start = (int)(($RequestPage - 1) / 10) * 10 + 1;

                    if ($start > 10)
                        $pagehelper->PreTen = $start - 10;
                    else
                        $pagehelper->PreTen = 0;

                    if ($RequestPage > 1)
                        $pagehelper->prev = $RequestPage - 1;
                    else
                        $pagehelper->prev = 1;

                    for ($k = $start, $j = 0; $k <= $pagehelper->PageCount; $k++) {
                        $j++;
                        $pagehelper->PageRtn[$j] = $k;
                        if ($j >= 10) break;
                    }

                    if ($RequestPage > $pagehelper->PageCount)
                        $pagehelper->next = $RequestPage + 1;
                    else
                        $pagehelper->next = $pagehelper->PageCount;

                    if ($pagehelper->PageCount - $start >= 10)
                        $pagehelper->NextTen = $start + 10;
                    else
                        $pagehelper->NextTen = 0;
                }
            }

            return $pagehelper;
        } catch (Exception $ex) {
            throw new Exception('PageHelper Error : ' . $ex->getMessage());
        }
    }

    function SqlInjection($str)
    {
        $str = str_replace("--", "­­", $str);
        $str = str_replace(" or ", " ｏr ", $str);
        $str = str_replace(" and ", " ａnd ", $str);
        $str = str_replace("select", "ｓelect", $str);
        $str = str_replace("union", "ｕnion", $str);
        $str = str_replace("insert", "ｉnsert", $str);
        $str = str_replace("update", "ｕpdate", $str);
        $str = str_replace("delete", "ｄelete", $str);
        $str = str_replace("create", "ｃreate", $str);
        $str = str_replace("alter", "ａlter", $str);
        $str = str_replace("drop", "ｄrop", $str);
        $str = str_replace("exec", "ｅxec", $str);

        return $str;
    }

    function XSS($str)
    {
        $str = str_ireplace("script", "ｓcript", $str);
        $str = str_ireplace("javascript", "javaｓcript", $str);
        $str = str_ireplace("vbscript", "vbｓcript", $str);
        $str = str_ireplace("onload", "onlａod", $str);
        $str = str_ireplace("onclick", "onｃlick", $str);
        $str = str_ireplace("onsubmit", "onｓubmit", $str);
        $str = str_ireplace("onmouseover", "onmouｓeover", $str);
        $str = str_ireplace("mocha", "mocha", $str);
        $str = str_ireplace("behaviour", "behaviour", $str);
        $str = str_ireplace("binding", "bｉnding", $str);
        $str = str_ireplace("expression", "expreｓsion", $str);
        $str = str_ireplace("document", "ｄocument", $str);

        return $str;
    }

    public function RequestChecker($InputString, $valid, $isHTML)
    {
        $retVal = $InputString;

        try {
            if ($InputString != "" && $InputString != null) {
                switch ($valid) {
                    case 0:
                        if (!is_numeric($InputString))
                            throw new Exception('WebHelper parameter is not a number error');
                        $retVal = $InputString;
                        break;
                    case -1:
                        //$InputString = $this->SqlInjection($InputString);
                        //$InputString = $this->XSS($InputString);
                        $InputString = str_ireplace("'", "\'", $InputString);
                        if (!$isHTML) {
                            //$InputString = str_ireplace("\\", "&quot;", $InputString);
                            $InputString = str_ireplace("<", "&lt;", $InputString);
                            $InputString = str_ireplace(">", "&gt;", $InputString);
                            //$InputString = str_ireplace(" ", "&nbsp;", $InputString);
                        }

                        $retVal = $InputString;
                        break;
                    default:
                        if (strlen($InputString) > $valid) {
                            throw new Exception('WebHelper Error: Input length is too long');
                        } else {
                            //$InputString = $this->SqlInjection($InputString);
                            //$InputString = $this->XSS($InputString);
                            $InputString = str_ireplace("'", "\'", $InputString);

                            if (!$isHTML) {
                                //$InputString = str_ireplace("\\", "&quot;", $InputString);
                                $InputString = str_ireplace("<", "&lt;", $InputString);
                                $InputString = str_ireplace(">", "&gt;", $InputString);
                                //$InputString = str_ireplace(" ", "&nbsp;", $InputString);
                            }

                            $retVal = $InputString;
                        }
                        break;
                }
            }

            return $retVal;
        } catch (Exception $e) {
            $this->AlertMessageAndHistoryBack($e->getMessage());
        }
    }

    public function RequestFilter($name, $size, $isHTML)
    {
        if (isset($_POST[$name])) {
            $retVal = $_POST[$name];
        } else {
            if (!isset($_GET[$name]))
                $retVal = '';
            else
                $retVal = $_GET[$name];
        }

        if ($retVal != null && $retVal != '') {
            $retVal = $this->RequestChecker($retVal, $size, $isHTML);
        }

        return $retVal;
    }

    /**
     * @return bool
     */
    public static function isMobile(): bool
    {
        $useragent = $_SERVER['HTTP_USER_AGENT'];

        return preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i', $useragent) || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i', substr($useragent, 0, 4));
    }

    public function RequestFilterMulti($name, $size, $isHTML)
    {
        $retVal = array();

        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            $retVal = null;
        } else {
            if (!isset($_POST[$name])) {
                $retVal = null;
            } else {

                $retVal = $_POST[$name];

                for ($i = 0, $iMax = count($retVal); $i < $iMax; $i++) {

                    $retVal[$i] = $this->RequestChecker($retVal[$i], $size, $isHTML);
                }
            }
        }
        return $retVal;
    }

    private function utf8_length($str)
    {
        $len = strlen($str);
        for ($i = $length = 0; $i < $len; $length++) {
            $high = ord($str[$i]);
            if ($high < 0x80)
                $i += 1;
            else if ($high < 0xE0)
                $i += 2;
            else if ($high < 0xF0)
                $i += 3;
            else
                $i += 4;
        }
        return $length;
    }

    public function CurRightString($InputString, $MaxLen, $AddString = '...')
    {
        if ($this->utf8_length($InputString) <= $MaxLen)
            $AddString = '';
        else
            $MaxLen -= $this->utf8_length($AddString);

        $len = strlen($InputString);
        for ($i = $adapted = 0; $i < $len; $adapted = $i) {
            $high = ord($InputString[$i]);
            if ($high < 0x80)
                $i += 1;
            else if ($high < 0xE0)
                $i += 2;
            else if ($high < 0xF0)
                $i += 3;
            else
                $i += 4;

            if (--$MaxLen < 0)
                break;
        }

        return trim(substr($InputString, 0, $adapted)) . $AddString;
    }

    public function DateTimeFormat($Date, $Pattern)
    {
        try {
            $date = date_create($Date);
            $Year = $date->format("Y");
            $Month = $date->format("m");
            $MonthName = $date->format("M");
            $Day = $date->format("d");
            $Hour = $date->format("H");
            $Min = $date->format("i");
            $Sec = $date->format("s");

            $retVal = $Pattern;
            $retVal = str_ireplace("yyyy", $Year, $retVal);
            $retVal = str_ireplace("mm", $Month, $retVal);
            $retVal = str_ireplace("M", $MonthName, $retVal);
            $retVal = str_ireplace("dd", $Day, $retVal);
            $retVal = str_ireplace("hh", $Hour, $retVal);
            $retVal = str_ireplace("ii", $Min, $retVal);
            $retVal = str_ireplace("ss", $Sec, $retVal);

            return $retVal;
        } catch (Exception $ex) {
            throw new Exception('WebHelper Error DateTimeFormat');
        }
    }

    public function ReplaceNLtoBR($InputString)
    {
        try {
            return str_ireplace("\n", "<br/>", $InputString);
        } catch (Exception $ex) {
            throw new Exception('WebHelper Error');
        }
    }

    public function ReplaceBRtoNL($InputString)
    {
        try {
            $retVal = str_ireplace("<br/>", "\n", $InputString);

            return retVal;
        } catch (Exception $ex) {
            throw new Exception('WebHelper Error');
        }
    }

    private function FileExe($FileName)
    {
        try {
            $Temp = explode(".", $FileName);

            if (count($Temp) <= 1) {
                $retVal = "";
            } else {
                $retVal = $Temp[count($Temp) - 1];
            }

            return $retVal;
        } catch (Exception $ex) {
            throw new Exception('WebHelper Error FileExe');
        }
    }

    public function FileUpCheck($FileName)
    {
        $Prohibit = explode(",", "exe,bat,com,reg,dll,cgi,asp,aspx,cs,php,jsp,java,sql,swf,vbs,htm,html,css,js,xml,xsd,xsl,htc,class,cer");

        try {
            $FileName = strtolower($FileName);

            $FileExt = $this->FileExe($FileName);

            for ($i = 0, $iMax = count($Prohibit); $i < $iMax; $i++) {
                if ($FileExt == $Prohibit[$i]) {
                    return FALSE;
                }
            }

            return TRUE;
        } catch (Exception $ex) {
            throw new Exception('WebHelper Error FileUpCheck');
        }
    }

    public function ImageFileUpCheck($FileName)
    {
        $ImageFile = explode(",", "jpg,png,bmp,gif,svg");

        try {
            $FileName = strtolower($FileName);

            $FileExt = $this->FileExe($FileName);

            for ($i = 0, $iMax = count($ImageFile); $i < $iMax; $i++) {
                if ($FileExt == $ImageFile[$i]) {
                    return TRUE;
                }
            }

            return FALSE;
        } catch (Exception $ex) {
            throw new Exception('WebHelper Error ImageFileUpCheck');
        }
    }

    public function SetCookie($name, $value)
    {
        //date_default_timezone_set('America/Los_Angeles');
        $now = date("Y-m-d H:i:s");
        $end = strtotime("+" . $this->LoginMinute . " minutes");
        $end = date('Y-m-d H:i:s', $end);

        $EncryptName = $this->AESEncrypt256($name);
        $EncriptValue = $this->AESEncrypt256($value . "&" . $end);

        if (isset($_COOKIE[$EncryptName])) {
            //unset($_COOKIE[$EncryptName]);
            setcookie(urlencode($EncryptName), null, -1, "/", $this->Domain);
        }

        if ($value != "") {
            setcookie(urlencode($EncryptName), urlencode($EncriptValue), 0, "/", $this->Domain);
        }
    }

    public function GetCookie($name)
    {
        //date_default_timezone_set('America/Los_Angeles');

        $value = "";
        $ret = array();
        $now = date("Y-m-d H:i:s");

        $EncryptName = $this->AESEncrypt256($name);

        if (!isset($_COOKIE[$EncryptName])) {
            $EncryptName = urlencode($EncryptName);
        }

        if (isset($_COOKIE[$EncryptName])) {
            $value = $this->AESDecrypt256(urldecode($_COOKIE[$EncryptName]));
            $ret = explode("&", $value);

            $end = $ret[1];
            if ($end >= $now) {
                return $ret[0];
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    public function AlertMessage($msg)
    {
        $ret = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n";
        $ret = $ret . "<html xmlns=\"http://www.w3.org/1999/xhtml\">\n";
        $ret = $ret . "<head>\n";
        $ret = $ret . "   <title></title>\n";
        $ret = $ret . "   <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">";
        $ret = $ret . "</head>\n";
        $ret = $ret . "<body>\n";
        $ret = $ret . "<script type=\"text/javascript\">\n";
        $ret = $ret . "   alert('" . $msg . "');\n";
        $ret = $ret . "</script>\n";
        $ret = $ret . "</body>\n";
        $ret = $ret . "</html>";

        echo $ret;
        exit();
    }

    public function AlertMessageAndGo($msg, $url)
    {
        $ret = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n";
        $ret .= "<html xmlns=\"http://www.w3.org/1999/xhtml\">\n";
        $ret .= "<head>\n";
        $ret .= "<title></title>\n";
        $ret .= '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
        $ret .= "</head>\n";
        $ret .= "<body>\n";
        $ret .= "<script type=\"text/javascript\">\n";

        if ($msg != '') {
            $ret .= 'alert("' . $msg . '");';
        }

        $ret .= '   document.location.href = "' . $url . "\";\n";
        $ret .= "</script>\n";
        $ret .= "</body>\n";
        $ret .= '</html>';

        echo $ret;
        exit();
    }

    public function AlertMessageAndHistoryBack($msg)
    {
        $ret = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n";
        $ret = $ret . "<html xmlns=\"http://www.w3.org/1999/xhtml\">\n";
        $ret = $ret . "<head>\n";
        $ret = $ret . "   <title></title>\n";
        $ret = $ret . "   <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">";
        $ret = $ret . "</head>\n";
        $ret = $ret . "<body>\n";
        $ret = $ret . "<script type=\"text/javascript\">\n";

        if ($msg != "") {
            $ret .= 'alert("' . $msg . '");';
        }

        $ret = $ret . "   history.back();\n";
        $ret = $ret . "</script>\n";
        $ret = $ret . "</body>\n";
        $ret = $ret . "</html>";

        echo $ret;
        exit();
    }

    public function AlertMessageAndPopUpClose($msg)
    {
        $ret = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n";
        $ret = $ret . "<html xmlns=\"http://www.w3.org/1999/xhtml\">\n";
        $ret = $ret . "<head>\n";
        $ret = $ret . "   <title></title>\n";
        $ret = $ret . "   <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">";
        $ret = $ret . "</head>\n";
        $ret = $ret . "<body>\n";
        $ret = $ret . "<script type=\"text/javascript\">\n";

        if ($msg != "") {
            $ret = $ret . "   alert('" . $msg . "');\n";
        }

        $ret = $ret . "   self.close();\n";
        $ret = $ret . "</script>\n";
        $ret = $ret . "</body>\n";
        $ret = $ret . "</html>";

        echo $ret;
        exit();
    }

    public function AlertMessageAndPopUpCloseAndParentReload($msg)
    {
        $ret = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n";
        $ret = $ret . "<html xmlns=\"http://www.w3.org/1999/xhtml\">\n";
        $ret = $ret . "<head>\n";
        $ret = $ret . "   <title></title>\n";
        $ret = $ret . "   <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">";
        $ret = $ret . "</head>\n";
        $ret = $ret . "<body>\n";
        $ret = $ret . "<script type=\"text/javascript\">\n";

        if ($msg != "") {
            $ret = $ret . "   alert('" . $msg . "');\n";
        }

        $ret = $ret . "   self.close();\n";
        $ret = $ret . "   opener.location.reload();\n";
        $ret = $ret . "</script>\n";
        $ret = $ret . "</body>\n";
        $ret = $ret . "</html>";

        echo $ret;
        exit();
    }

    public function AlertMessageAndReload($msg)
    {
        $ret = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n";
        $ret = $ret . "<html xmlns=\"http://www.w3.org/1999/xhtml\">\n";
        $ret = $ret . "<head>\n";
        $ret = $ret . "   <title></title>\n";
        $ret = $ret . "   <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">";
        $ret = $ret . "</head>\n";
        $ret = $ret . "<body>\n";
        $ret = $ret . "<script type=\"text/javascript\">\n";

        if ($msg != "") {
            $msg = str_replace("\n", "\\n", $msg);
            $ret = $ret . "   alert('" . $msg . "');\n";
        }
        $ret = $ret . "   document.location.reload();\n";
        $ret = $ret . "   $(\"#layer_comment\").html('');\n";
        $ret = $ret . "</script>\n";
        $ret = $ret . "</body>\n";
        $ret = $ret . "</html>";

        echo $ret;
        exit();
    }

    public function GetPageHtml($PageList, $CurrentPage, $PageUrl, $Parameter, $PageSize)
    {
        $ret = '';

        if (count($PageList->PageRtn) != 0) {
            $ret = "<div class=\"paginate\">\n";

            if ($CurrentPage != 1) {
                $ret .= "<a href=\"$PageUrl?page=" . ($CurrentPage - 1) . "$Parameter\"><em><i class=\"fas fa-chevron-left\"></i></em></a>\n";
            }

            for ($i = 1, $iMax = count($PageList->PageRtn); $i <= $iMax; $i++) {
                if ($PageList->PageRtn[$i] == $CurrentPage) {
                    $ret = $ret . "<a href=\"" . $PageUrl . "?page=" . $PageList->PageRtn[$i] . $Parameter . "\" class=\"active\">" . $PageList->PageRtn[$i] . "</a>";
                } else {
                    $ret = $ret . "<a href=\"" . $PageUrl . "?page=" . $PageList->PageRtn[$i] . $Parameter . "\">" . $PageList->PageRtn[$i] . "</a>";
                }
            }

            if ($CurrentPage != $PageList->PageCount) {
                $ret .= "<a href=\"$PageUrl?page=" . ($CurrentPage + 1) . "$Parameter\"><em><i class=\"fas fa-chevron-right\"></i></em></a>\n";
            }

            $ret = $ret . "</div>\n";
        }

        return $ret;
    }

    public function GetAdminPageHtml($PageList, $CurrentPage, $PageUrl, $Parameter, $PageSize)
    {
        $ret = "";


        if (count($PageList->PageRtn) != 0) {

            $ret = "<div class=\"pagination\">\n";


            if ($CurrentPage != 1) {

                $ret .= "<a href=\"$PageUrl?page=1$Parameter\">&lt;&lt; first</a>\n";

                $ret .= "<a href=\"$PageUrl?page=" . ($CurrentPage - 1) . "$Parameter\">&lt; prev</a>\n";

            }


            for ($i = 1, $iMax = count($PageList->PageRtn); $i <= $iMax; $i++) {

                if ($PageList->PageRtn[$i] == $CurrentPage) {

                    $ret = $ret . "<a href=\"" . $PageUrl . "?page=" . $PageList->PageRtn[$i] . $Parameter . "\" class=\"is-active\">" . $PageList->PageRtn[$i] . "</a>";
                } else {
                    $ret = $ret . "<a href=\"" . $PageUrl . "?page=" . $PageList->PageRtn[$i] . $Parameter . "\">" . $PageList->PageRtn[$i] . "</a>";
                }
            }

            if ($CurrentPage != $PageList->PageCount) {
                $ret .= "<a href=\"$PageUrl?page=" . ($CurrentPage + 1) . "$Parameter\">next &gt;</a>\n";
                $ret .= "<a href=\"$PageUrl?page=$PageList->PageCount$Parameter\">last &gt;&gt;</a>\n";
            }

            $ret = $ret . "</div>\n";
        }

        return $ret;
    }

    public function CheckPermission()

    {

        $userpkid = $this->GetCookie("frontside_purigenbiosystems_com_frontside_user_pkid");
        $username = $this->GetCookie("frontside_purigenbiosystems_com_frontside_user_name");
        $userid = $this->GetCookie("frontside_purigenbiosystems_com_frontside_user_id");

        if (!$userpkid) {
            $this->AlertMessageAndGo("Please login to access this page.", "/user/sign_register");
        } else {
            $this->SetCookie("frontside_purigenbiosystems_com_frontside_user_pkid", $userpkid);
            $this->SetCookie("frontside_purigenbiosystems_com_frontside_user_name", $username);
            $this->SetCookie("frontside_purigenbiosystems_com_frontside_user_id", $userid);

            $dbhelper = new dbHelper();
            $dbhelper->dbOpen();
            $sql = "select isContentAdmin from member where status = 1 and pkid = $userpkid";
            $member = $dbhelper->RunSQLReturnOneRow($sql);
            $dbhelper->dbClose();

            if ($member["isContentAdmin"] == 0) {
                $this->AlertMessageAndGo("You don\'t have permission.", '/');
            }
        }
    }

    public function CheckLogin($PageCode, $ReturnUrl, $mustLogin = false)

    {
        $userpkid = $this->GetCookie("frontside_purigenbiosystems_com_frontside_user_pkid");
        $username = $this->GetCookie("frontside_purigenbiosystems_com_frontside_user_name");
        $userid = $this->GetCookie("frontside_purigenbiosystems_com_frontside_user_id");

        if (!$userpkid) {
            if ($mustLogin)
                $this->AlertMessageAndGo("Please login to access this page.", "/index.php?returnUrl=" . $ReturnUrl);
        } else {
            $this->SetCookie("frontside_purigenbiosystems_com_frontside_user_pkid", $userpkid);
            $this->SetCookie("frontside_purigenbiosystems_com_frontside_user_name", $username);
            $this->SetCookie("frontside_purigenbiosystems_com_frontside_user_id", $userid);
        }
    }

    public function CheckLoginPopup($mustLogin = false)
    {
        $userpkid = $this->GetCookie("frontside_purigenbiosystems_com_frontside_user_pkid");
        $username = $this->GetCookie("frontside_purigenbiosystems_com_frontside_user_name");
        $userid = $this->GetCookie("frontside_purigenbiosystems_com_frontside_user_id");

        if (!$userpkid) {
            if ($mustLogin)
                $this->AlertMessageAndPopUpClose("Please login to access this page.");
        } else {
            $this->SetCookie("frontside_purigenbiosystems_com_frontside_user_pkid", $userpkid);
            $this->SetCookie("frontside_purigenbiosystems_com_frontside_user_name", $username);
            $this->SetCookie("frontside_purigenbiosystems_com_frontside_user_id", $userid);
        }
    }

    public function GetLoginPkid()

    {
        $retVal = $this->GetCookie("frontside_purigenbiosystems_com_frontside_user_pkid");

        if (!$retVal) {
            return null;
        }

        return $retVal;
    }

    public function GetLoginName()
    {
        $retVal = $this->GetCookie("frontside_purigenbiosystems_com_frontside_user_name");

        if (!$retVal) {
            return null;
        }

        return $retVal;
    }

    public function GetLoginId()
    {
        $retVal = $this->GetCookie("frontside_purigenbiosystems_com_frontside_user_id");

        if (!$retVal) {
            return null;
        }

        return $retVal;
    }

    public function GetRegisterInfo()
    {
        $retVal = $this->GetCookie("frontside_purigenbiosystems_com_frontside_user_register");

        if (!$retVal) {
            return null;
        }

        return $retVal;
    }

    public function CheckAdminLogin($PageCode, $ReturnUrl, $mustLogin = false)
    {
        $userpkid = $this->GetCookie("adminside_purigenbiosystems_com_adminside_user_pkid");
        $userid = $this->GetCookie("adminside_purigenbiosystems_com_adminside_user_id");
        $username = $this->GetCookie("adminside_purigenbiosystems_com_adminside_user_name");
        $isadministrator = $this->GetCookie("adminside_purigenbiosystems_com_adminside_isadministrator");
        $iseditor = $this->GetCookie("adminside_purigenbiosystems_com_adminside_iseditor");
        $iscareers = $this->GetCookie("adminside_purigenbiosystems_com_adminside_iscareers");

        if (!$userid) {
            if ($mustLogin)
                $this->AlertMessageAndGo("Please login to access.", "/admin/index.php?returnUrl=" . $ReturnUrl);
        } else {
            $this->SetCookie("adminside_purigenbiosystems_com_adminside_user_pkid", $userpkid);
            $this->SetCookie("adminside_purigenbiosystems_com_adminside_user_id", $userid);
            $this->SetCookie("adminside_purigenbiosystems_com_adminside_user_name", $username);
            $this->SetCookie("adminside_purigenbiosystems_com_adminside_isadministrator", $isadministrator);
            $this->SetCookie("adminside_purigenbiosystems_com_adminside_iseditor", $iseditor);
            $this->SetCookie("adminside_purigenbiosystems_com_adminside_iscareers", $iscareers);

            if ($isadministrator == "0" && $iseditor == "0" && $iscareers == "1" && $PageCode != "060101" && $PageCode != "060102")
                $this->AlertMessageAndGo("You do not have permission to access this page.", "/admin/company/careers/list.php");
        }
    }

    public function CheckAdminLoginPopup($mustLogin = false)

    {

        $userpkid = $this->GetCookie("adminside_purigenbiosystems_com_adminside_user_pkid");

        $userid = $this->GetCookie("adminside_purigenbiosystems_com_adminside_user_id");

        $username = $this->GetCookie("adminside_purigenbiosystems_com_adminside_user_name");

        $isadministrator = $this->GetCookie("adminside_purigenbiosystems_com_adminside_isadministrator");

        $iseditor = $this->GetCookie("adminside_purigenbiosystems_com_adminside_iseditor");

        $iscareers = $this->GetCookie("adminside_purigenbiosystems_com_adminside_iscareers");


        if (!$userid) {

            if ($mustLogin)

                $this->AlertMessageAndPopUpClose("Please login to access.");

        } else {

            $this->SetCookie("adminside_purigenbiosystems_com_adminside_user_pkid", $userpkid);

            $this->SetCookie("adminside_purigenbiosystems_com_adminside_user_id", $userid);

            $this->SetCookie("adminside_purigenbiosystems_com_adminside_user_name", $username);

            $this->SetCookie("adminside_purigenbiosystems_com_adminside_isadministrator", $isadministrator);

            $this->SetCookie("adminside_purigenbiosystems_com_adminside_iseditor", $iseditor);

            $this->SetCookie("adminside_purigenbiosystems_com_adminside_iscareers", $iscareers);


            if ($isadministrator == "0" && $iseditor == "0" && $iscareers == "1" && $PageCode != "060101" && $PageCode != "060102")

                $this->AlertMessageAndGo("You do not have permission to access this page.", "/admin/company/careers/list.php");

        }

    }


    public function GetAdminLoginName()

    {

        $retVal = $this->GetCookie("adminside_purigenbiosystems_com_adminside_user_name");


        return $retVal;

    }


    public function MakeOption($InputArray, $ColumNameValue, $ColumNameTitle, $SelectedValue)

    {

        $retVal = "";


        foreach ($InputArray as $row) {

            if ($row->GetValue($ColumNameValue) == $SelectedValue)

                $retVal = $retVal . "<option value='" . $row->GetValue($ColumNameValue) . "' selected='selected'>" . $row->GetValue($ColumNameTitle) . "</option>";

            else

                $retVal = $retVal . "<option value='" . $row->GetValue($ColumNameValue) . "'>" . $row->GetValue($ColumNameTitle) . "</option>";

        }


        return $retVal;

    }


    public function MakeOptionArray($InputArray, $SelectedValue)

    {

        $retVal = "";


        foreach ($InputArray as $key => $value) {

            if ($key == $SelectedValue)

                $retVal = $retVal . "<option value='" . $key . "' selected='selected'>" . $value . "</option>";

            else

                $retVal = $retVal . "<option value='" . $key . "'>" . $value . "</option>";

        }


        return $retVal;

    }


    public function MakeLinkString($inputArray)

    {

        $retVal = "";


        if (is_array($inputArray)) {

            for ($i = 0, $iMax = count($inputArray); $i < $iMax; $i++) {

                if ($i == count($inputArray) - 1)

                    $retVal = $retVal . $inputArray[$i];

                else

                    $retVal = $retVal . $inputArray[$i] . "|";

            }

        }


        return $retVal;

    }


    public function MakeSelectedValue($source, $target, $str = "selected")

    {

        if ($source == $target)

            return $str;

        else

            return "";

    }


    public function MakeSelectedValueWithRowHelper($source, $target, $fieldname, $str = "selected")

    {

        $retVal = "";


        if ($target != null) {

            foreach ($target as $row) {

                if ($source == $row[$fieldname]) {

                    $retVal = $str;

                }

            }

        }


        return $retVal;

    }


    public function MakeSelectedValueWithArray($source, $target, $str = "selected")

    {

        $retVal = "";


        if ($target != null) {

            for ($i = 0, $iMax = count($target); $i < $iMax; $i++) {

                if ($source == $target[$i]) {

                    $retVal = $str;

                }


            }

        }


        return $retVal;

    }


    public function isNull($inputVal)

    {

        if ($inputVal == null || $inputVal == "") {

            return true;

        } else {

            return false;

        }

    }


    function HumanTiming($inputstr, $granularity = 2)

    {

        $retval = "";


        $date = strtotime($inputstr);

        $difference = time() - $date;


        $periods = array('decade' => 315360000, 'year' => 31536000, 'month' => 2628000, 'week' => 604800, 'day' => 86400, 'hour' => 3600, 'minute' => 60, 'second' => 1);


        if ($difference < 5) { // less than 5 seconds ago, let's say "just now"

            $retval = "just now";

            return $retval;

        } else {

            foreach ($periods as $key => $value) {

                if ($difference >= $value) {

                    $time = floor($difference / $value);

                    $difference %= $value;

                    $retval .= ($retval ? ' ' : '') . $time . ' ';

                    $retval .= (($time > 1) ? $key . 's' : $key);

                    $granularity--;

                }


                if ($granularity == '0') {
                    break;
                }

            }


            return $retval . ' ago';

        }

    }


    public function GetMonthName($month)

    {

        $retValue = "";


        switch ($month) {

            case "01" :

                $retValue = "January";

                break;

            case "02" :

                $retValue = "February";

                break;

            case "03" :

                $retValue = "March";

                break;

            case "04" :

                $retValue = "April";

                break;

            case "05" :

                $retValue = "May";

                break;

            case "06" :

                $retValue = "June";

                break;

            case "07" :

                $retValue = "July";

                break;

            case "08" :

                $retValue = "August";

                break;

            case "09" :

                $retValue = "September";

                break;

            case "10" :

                $retValue = "October";

                break;

            case "11" :

                $retValue = "November";

                break;

            case "12" :

                $retValue = "December";

                break;

        }


        return $retValue;

    }


    public function GetMonthShortName($month)

    {

        $retValue = "";


        switch ($month) {

            case "01" :

                $retValue = "JAN";

                break;

            case "02" :

                $retValue = "FEB";

                break;

            case "03" :

                $retValue = "MAR";

                break;

            case "04" :

                $retValue = "APR";

                break;

            case "05" :

                $retValue = "MAY";

                break;

            case "06" :

                $retValue = "JUN";

                break;

            case "07" :

                $retValue = "JUL";

                break;

            case "08" :

                $retValue = "AUG";

                break;

            case "09" :

                $retValue = "SEP";

                break;

            case "10" :

                $retValue = "OCT";

                break;

            case "11" :

                $retValue = "NOV";

                break;

            case "12" :

                $retValue = "DEC";

                break;

        }


        return $retValue;

    }


    public function GetWeekName($date)

    {

        $days = array('Sun.', 'Mon.', 'Tue.', 'Wed.', 'Thu.', 'Fri.', 'Sat.');

        $retVal = "";


        $dayofweek = date('w', strtotime($date));

        $retVal = $days[$dayofweek];


        return $retVal;

    }


    public function GetFullWeekName($date)

    {

        $days = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');

        $dayofweek = date('w', strtotime($date));

        return $days[$dayofweek];

    }


    public function UploadFile($elementName, $path, $imageOnly = false)

    {

        $retVal = null;


        if ((!empty($_FILES[$elementName])) && ($_FILES[$elementName]["error"] == 0)) {

            $filename = basename($_FILES[$elementName]["name"]);

            $ext = substr($filename, strrpos($filename, ".") + 1);


            if ($this->FileUpCheck($filename)) {

                if ($imageOnly) {

                    if (!$this->ImageFileUpCheck($filename))

                        $this->AlertMessageAndHistoryBack("File upload fail. Unrecognized image type.");

                }


                $newfilename = date("YmdHis") . uniqid() . "." . $ext;

                $newfilepath = $this->UploadPath . $path . $newfilename;

                if(!is_dir($this->UploadPath . $path)) {
                    mkdir($this->UploadPath . $path, 0777, true);
                }

                if ($status = (move_uploaded_file($_FILES[$elementName]["tmp_name"], $newfilepath))) {

                    $retVal = new RowHelper();

                    $retVal["filename"] = $newfilename;

                    $retVal["orgfilename"] = $filename;

                    $retVal["filetype"] = strtoupper($ext);

                    $retVal["filesize"] = $_FILES[$elementName]["size"];

                }

            } else {

                $this->AlertMessageAndHistoryBack("File upload fail. Please check file type and size.");

            }

        } else {

            if ($_FILES[$elementName]["error"] == 1)

                $this->AlertMessageAndHistoryBack("File upload fail. File size limited to 20 MB.");

        }


        return $retVal;

    }


    public function DeleteFile($path, $filename)

    {

        $filepath = $this->UploadPath . $path . $filename;


        if (file_exists($filepath)) {

            unlink($filepath);

        }

    }


    public function CopyFile($path, $filename)

    {

        $ext = substr($filename, strrpos($filename, ".") + 1);

        $newfilename = date("YmdHis") . uniqid() . "." . $ext;


        $filepath = $this->UploadPath . $path . $filename;

        $newfilepath = $this->UploadPath . $path . $newfilename;


        copy($filepath, $newfilepath);


        return $newfilename;

    }

    public function get_mime_type($filename) {
        $idx = explode( '.', $filename );
        $count_explode = count($idx);
        $idx = strtolower($idx[$count_explode-1]);

        $mimet = array(
            'txt' => 'text/plain',
            'htm' => 'text/html',
            'html' => 'text/html',
            'php' => 'text/html',
            'css' => 'text/css',
            'js' => 'application/javascript',
            'json' => 'application/json',
            'xml' => 'application/xml',
            'swf' => 'application/x-shockwave-flash',
            'flv' => 'video/x-flv',

            // images
            'png' => 'image/png',
            'jpe' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'jpg' => 'image/jpeg',
            'gif' => 'image/gif',
            'bmp' => 'image/bmp',
            'ico' => 'image/vnd.microsoft.icon',
            'tiff' => 'image/tiff',
            'tif' => 'image/tiff',
            'svg' => 'image/svg+xml',
            'svgz' => 'image/svg+xml',

            // archives
            'zip' => 'application/zip',
            'rar' => 'application/x-rar-compressed',
            'exe' => 'application/x-msdownload',
            'msi' => 'application/x-msdownload',
            'cab' => 'application/vnd.ms-cab-compressed',

            // audio/video
            'mp3' => 'audio/mpeg',
            'qt' => 'video/quicktime',
            'mov' => 'video/quicktime',

            // adobe
            'pdf' => 'application/pdf',
            'psd' => 'image/vnd.adobe.photoshop',
            'ai' => 'application/postscript',
            'eps' => 'application/postscript',
            'ps' => 'application/postscript',

            // ms office
            'doc' => 'application/msword',
            'rtf' => 'application/rtf',
            'xls' => 'application/vnd.ms-excel',
            'ppt' => 'application/vnd.ms-powerpoint',
            'docx' => 'application/msword',
            'xlsx' => 'application/vnd.ms-excel',
            'pptx' => 'application/vnd.ms-powerpoint',


            // open office
            'odt' => 'application/vnd.oasis.opendocument.text',
            'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
        );

        if (isset( $mimet[$idx] )) {
            return $mimet[$idx];
        } else {
            return 'application/octet-stream';
        }
    }


    public function DownloadFile($path, $filename, $orgfilename)

    {

        $downloadPath = $this->UploadPath . $path . $filename;

        $mm_type = $this->get_mime_type($filename);
        header("Pragma: public");

        header("Expires: 0");

        header("Content-Type: $mm_type");

        header("Content-Disposition: attachment; filename=\"" . $orgfilename . "\"");

        header("Content-Transfer-Encoding: binary");

        header("Content-Length: " . filesize($downloadPath));


        ob_clean();

        flush();


        readfile($downloadPath);

    }


    public function FormatFileSize($bytes)

    {

        if ($bytes >= 1073741824) {

            $bytes = number_format($bytes / 1073741824, 2) . ' GB';

        } elseif ($bytes >= 1048576) {

            $bytes = number_format($bytes / 1048576, 2) . ' MB';

        } elseif ($bytes >= 1024) {

            $bytes = number_format($bytes / 1024, 2) . ' KB';

        } elseif ($bytes > 1) {

            $bytes = $bytes . ' bytes';

        } elseif ($bytes == 1) {

            $bytes = $bytes . ' byte';

        } else {

            $bytes = '0 bytes';

        }


        return $bytes;

    }


    function GetFileType($filename)

    {

        $ext = substr($filename, strrpos($filename, ".") + 1);

        return strtoupper($ext);

    }


    function GetFileSize($file)

    {

        $bytes = filesize($this->UploadPath . $file);


        return $this->FormatFileSize($bytes);

    }


    function GetRelatedApplications($pkid, $target)

    {

        $retVal = "";

        $dbhelper = new dbHelper();


        $dbhelper->dbOpen();

        $sql = "select c.title from " . $target . "_detail d inner join commoncode c on d.fkcommon = c.pkid where d.type = 1 and fk$target = " . $pkid;

        $List = $dbhelper->RunSQLReturnRows($sql);

        $dbhelper->dbClose();


        if ($List != null && count($List) > 0) {

            foreach ($List as $row) {

                $retVal .= $row["title"] . ",&nbsp;";

            }

        }


        return $retVal;

    }


    function GetRelatedProducts($pkid, $target)

    {

        $retVal = "";

        $dbhelper = new dbHelper();


        $dbhelper->dbOpen();

        $sql = "select c.title from " . $target . "_detail d inner join commoncode c on d.fkcommon = c.pkid where d.type = 2 and fk$target = " . $pkid;

        $List = $dbhelper->RunSQLReturnRows($sql);

        $dbhelper->dbClose();


        if ($List != null && count($List) > 0) {

            foreach ($List as $row) {

                $retVal .= $row["title"] . ",&nbsp;";

            }

        }


        return $retVal;

    }


    function GetJobCategoryName($category)

    {

        $retVale = "";


        switch ($category) {

            case 1:

                $retVale = "Applications";

                break;

            case 2:

                $retVale = "Engineering";

                break;

            case 3:

                $retVale = "Finance";

                break;

            case 4:

                $retVale = "Manufacturing";

                break;

            case 5:

                $retVale = "Marketing";

                break;

            case 6:

                $retVale = "Purchasing";

                break;

            case 7:

                $retVale = "R&amp;D";

                break;

            case 8:

                $retVale = "Sales";

                break;

            case 9:

                $retVale = "Support";

                break;

            case 10:

                $retVale = "Administrative";

                break;

            case 11:

                $retVale = "IT";

                break;

            case 12:

                $retVale = "Human Resources";

                break;

        }


        return $retVale;

    }


    function GetCategoryName($category)

    {

        $retVale = "";


        switch ($category) {

            case 0:

                $retVale = "All";

                break;

            case 1:

                $retVale = "Liquid Handling";

                break;

            case 2:

                $retVale = "Automation";

                break;

            case 3:

                $retVale = "Consumables";

                break;

        }


        return $retVale;

    }


    function GetCommonCodeTitle($list, $key)

    {

        $retVal = "All";


        if ($list != null && count($list) > 0) {

            foreach ($list as $row) {

                if ($row["pkid"] == $key) {

                    $retVal = $row["title"];

                }

            }

        }


        return $retVal;

    }


    function GetEventCategory($type)

    {

        $retVal = "";


        if ($type == 1)

            $retVal = "Conference";

        else if ($type == 2)

            $retVal = "Webinar";

        else if ($type == 3)

            $retVal = "Meeting";

        else if ($type == 4)

            $retVal = "Workshop";


        return $retVal;

    }

    /**
     * @param string $UploadPath
     */
    public function setUploadPath(string $UploadPath): void
    {
        $this->UploadPath = $UploadPath;
    }

    /**
     * @param string $Domain
     */
    public function setDomain(string $Domain): void
    {
        $this->Domain = $Domain;
    }

    public static function sendPost($url, $postData)
    {
        $ch = curl_init($url);
        curl_setopt_array($ch, array(
            CURLOPT_POST => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded; charset=UTF-8'
            ),
            CURLOPT_POSTFIELDS => http_build_query($postData)
        ));

        $response = curl_exec($ch);
    }

    /*
 *
 * @Create an HTML drop down menu
 *
 * @param string $name The element name and ID
 *
 * @param int $selected The month to be selected
 *
 * @return string
 *
 */
    public function monthDropdown($name = 'month', $selected = null)
    {
        $dd = '<select name="' . $name . '" id="' . $name . '">';

        $months = array(
            1 => 'January',
            2 => 'February',
            3 => 'March',
            4 => 'April',
            5 => 'May',
            6 => 'June',
            7 => 'July',
            8 => 'August',
            9 => 'September',
            10 => 'October',
            11 => 'November',
            12 => 'December');
        /*** the current month ***/
        $selected = $selected ?? date('n', time());

        for ($i = 1; $i <= 12; $i++) {
            $dd .= '<option value="' . $i . '"';
            if ($i == $selected) {
                $dd .= ' selected';
            }
            /*** get the month ***/
            $dd .= '>' . $months[$i] . '</option>';
        }
        $dd .= '</select>';
        return $dd;
    }

    public function dayDropdown($name = 'day', $selected = null)
    {
        $dd = '<select name="' . $name . '" id="' . $name . '">';
        $selected = $selected ?? date('j', time());

        for ($i = 1; $i <= 31; $i++) {
            $dd .= '<option value="' . $i . '"';
            if ($i == $selected) {
                $dd .= ' selected';
            }
            /*** get the month ***/
            $dd .= '>' . $i . '</option>';
        }
        $dd .= '</select>';
        return $dd;
    }

    public function subStrWords($text, $maxchar, $end='...'): string
    {
        if (strlen($text) > $maxchar || $text == '') {
            $words = preg_split('/\s/', $text);
            $output = '';
            $i      = 0;
            while (1) {
                $length = strlen($output)+strlen($words[$i]);
                if ($length > $maxchar) {
                    break;
                }
                else {
                    $output .= " " . $words[$i];
                    ++$i;
                }
            }
            $output .= $end;
        }
        else {
            $output = $text;
        }
        return $output;
    }
    
    public function check_recaptcha($response, $ip)
    {
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$this->GetCaptchaSecretKey()."&response=".$response."&remoteip=".$ip);
        $responseKeys = json_decode($response,true);

        if(!$responseKeys["success"]) 
        {
            $this->AlertMessage("Error(recaptcha). Does not allow access.");
        }
    }

    /**
     * @param $response
     * @param $ip
     * @return bool
     */
    public function isSpam($response, $ip)
    {
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$this->GetCaptchaSecretKey()."&response=".$response."&remoteip=".$ip);
        $responseKeys = json_decode($response,true);

        if(!$responseKeys['success'])
        {
            return true;
        }
        return false;
    }
}