<?php

/**
 * Set status name
 */
if (! function_exists('isActive')):
  function isActive($status)
  {
    $status_name = '';

    switch($status):
      case 0:
        $status_name = '<span class="badge badge-danger -status">Desativado</span>';
        break;
      case 1:
        $status_name = '<span class="badge badge-success -status">Ativo</span>';
        break;
    endswitch;

    return $status_name;
  }
endif;

/**
 * Set trim reference
 */
if (! function_exists('trimReference')):
  function trimReference($reference)
  {
    $fristStep = trim(preg_replace('#[^0-9]#', '', $reference));
    return ltrim($fristStep, '0');
  }
endif;

/**
 * Set trim reference
 */
if (! function_exists('trimReference')):
  function trimReference($reference)
  {
    $fristStep = trim(preg_replace('#[^0-9]#', '', $reference));
    return ltrim($fristStep, '0');
  }
endif;
/**
 * Set budget status name by color
 */
if (! function_exists('isBudgetStatusColor')):
  function isBudgetStatusColor($status)
  {
    $color = '';

    switch($status):
      case 2:
        $color = '-info text-white';
        break;
      // case 4:
      //   $color = '-success text-white';
      //   break;
    endswitch;

    return $color;
  }
endif;

/**
 * Set budget status name by color
 */
if (! function_exists('isBudgetStyleIcon')):
  function isBudgetStyleIcon($status)
  {
    $icon = '';

    switch($status):
      case 1:
      case 3:
      case 4:
        $icon = 'lg';
        break;
      case 2:
      // case 4:
        $icon = 'lg-white';
        break;
    endswitch;

    return $icon;
  }
endif;

/**
 * Set leads status name
 */
if (! function_exists('isAproved')):
  function isAproved($status)
  {
    $status_name = '';

    switch($status):
      case 1:
        $status_name = '<span class="badge badge-danger -status">Aguardando aprovação</span>';
        break;
      case 2:
        $status_name = '<span class="badge badge-success -status">Aprovado</span>';
        break;
    endswitch;

    return $status_name;
  }
endif;

/**
 * Set mask in string
 */
if (! function_exists('mask')):
  function mask($mask, $value)
  {
    for ($i=0; $i < strlen($value); $i++):
      $mask[strpos($mask,'#')] = $value[$i];
    endfor;

    return $mask;
  }
endif;

/**
 * Set mask phone
 */
if (! function_exists('maskPhone')):
  function maskPhone($phone)
  {
    if(strlen($phone) === 10):
      $phone = mask('(##) ####-####', $phone);
    elseif(strlen($phone) === 11):
      $phone = mask('(##) #####-####', $phone);
    endif;

    return $phone;
  }
endif;

/**
 * Format Ucwords PT-BR
 */
if (! function_exists('titleCaseBR')):
  function titleCaseBR($string)
  {
    $delimiters = [" ", "-", ".", "'", "O'", "Mc"];
    $exceptions = ["e", "o", "a", "é", "á", "de", "da", "dos", "das", "do", "I", "II", "III", "IV", "V", "VI"];

    $string = mb_convert_case($string, MB_CASE_TITLE, 'UTF-8');

    foreach ($delimiters as $dlnr => $delimiter):
      $words = explode($delimiter, $string);
      $newwords = [];
      foreach ($words as $wordnr => $word):
          if (in_array(mb_strtoupper($word, 'UTF-8'), $exceptions)):
            // check exceptions list for any words that should be in upper case
            $word = mb_strtoupper($word, 'UTF-8');
          elseif (in_array(mb_strtolower($word, 'UTF-8'), $exceptions)):
            // check exceptions list for any words that should be in upper case
            $word = mb_strtolower($word, 'UTF-8');
          elseif (!in_array($word, $exceptions)):
            // convert to uppercase (non-utf8 only)
            $word = ucfirst($word);
          endif;
          array_push($newwords, $word);
      endforeach;
      $string = join($delimiter, $newwords);
    endforeach;

    return $string;
  }
endif;

if (! function_exists('parseStringToDecimal')):
    function parseStringToDecimal($value)
    {
        return str_replace(',', '.', str_replace('.', '', $value));
    }
endif;
