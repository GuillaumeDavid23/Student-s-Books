<?php
    //REGEX
    define('TEL_REGEX', '^(?:(?:\+|00)33|0)\s*[1-9](?:[\s.-]*\d{2}){4}$');
    define('LETTER_REGEX', '[A-Za-z]');
    define('NAME_REGEX', '^[A-Za-z]+$');
    define('MAIL_REGEX', '^((\w[^\W]+)[\.\-]?){1,}\@(([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3})|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$');
    define('NUM_REGEX', '^[\d]{1,8}$');
    define('DATE_REGEX', '^\d{4}\-(0?[1-9]|1[012])\-(0?[1-9]|[12][0-9]|3[01])$');
    define('HOUR_REGEX', '^([0-1]?[0-9]|2[0-3]):[0-5][0-9]$');