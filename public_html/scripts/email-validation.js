function checkEmail(email)
{
    if (email.search(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/) != -1)
    {
        return true;
    } else
    {
        return false;
    }
}
function checkEmailAdd(email)
{
    if(email.indexOf("@gmail.") >= 0)
    {
        return false;
    }
    if(email.indexOf("@yahoo.") >= 0)
    {
        return false;
    }
    if(email.indexOf("@hotmail.") >= 0)
    {
        return false;
    }
    if(email.indexOf("@outlook.") >= 0)
    {
        return false;
    }
    if(email.indexOf("@icloud.") >= 0)
    {
        return false;
    }
    if(email.indexOf("@aol.") >= 0)
    {
        return false;
    }
    return true;
}
function checkFooterMailFrm()
{
    var f = document.footermailFrm;
    var isOk = true;
    $("#footer_firstname").css("border", "");
    $("#footer_lastname").css("border", "");
    $("#footer_email").css("border", "");
    if(f.firstname.value == "")
    {
        $("#footer_firstname").css("border", "1px solid #ff0000");
        isOk = false;
    }
    if(f.lastname.value == "")
    {
        $("#footer_lastname").css("border", "1px solid #ff0000");
        isOk = false;
    }
    if(f.email.value == "")
    {
        $("#footer_email").css("border", "1px solid #ff0000");
        isOk = false;
    }
    if(!checkEmail(f.email.value))
    {
        $("#footer_email").css("border", "1px solid #ff0000");
        isOk = false;
    }
    if(!checkEmailAdd(f.email.value))
    {
        showEmailDiv();
        isOk = false;
    }
    if(isOk)
    {
        f.submit();
    }
}
function showEmailDiv()
{
    $("#error-email").show();
}
function hideEmailDiv()
{
    $("#error-email").hide();
}