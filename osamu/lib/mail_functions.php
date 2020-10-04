<?php
/**  validations  **/

function checkEmail(string $data): bool {
  return (filter_var($data, FILTER_VALIDATE_EMAIL) && ctype_print($data));
}

//reusable regex function
function checkReg(string $data, string $regex): bool {
  if (
    filter_var(
      $data, 
      FILTER_VALIDATE_REGEXP,
      array(
           "options" => array("regexp"=>$regex)
      )
    ) && ctype_print($data)
  ) {
    return true;
  } return false;
      
}
function checkName(string $data): bool {
  return checkReg($data, "/^[a-zA-Z ]*$/");
}

function checkSubject(string $data): bool {
  return checkReg($data, "/^[a-zA-Z0-9\.,\s]*$/");
}
function checkMessage(string $data): bool {
  return checkReg($data, "/^[a-zA-Z0-9\?\.,'\- ]*$/");
}

