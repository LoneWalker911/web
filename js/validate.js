function validate()
{
  var uname=document.getElementById('uname').value;
  var password=document.getElementById('password').value;

  document.getElementById('uname').value=uname.trim();

  if(uname.length>0&&psw.length>0)
  return true;
  document.getElementById('info').innerHTML="Invalid Input";
  return false;
}
