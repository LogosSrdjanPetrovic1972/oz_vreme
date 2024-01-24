<?php
 /*
  @author:   http://develobert.blogspot.com/
  @description :  PHP Function to remove UTF-8 BOM/Signature from the beginning of a file.
  @param $filename: Name of the file a BOM should be looked for and removed from.
  @returns (bool): Returns true if the file didn't, or no longer contain(s) a BOM, false on error.
  
  @example usage:  echo debom_utf8('BOM.txt') ? 'free of BOM' : 'error';
 */
 function debom_utf8($filename = '')
 {
  if($size = filesize($filename) && $size < 3)
  {// BOM not possible
   return true;
  }
  if($fh = fopen($filename, 'r+b'))
  {
    echo bin2hex(fread($fh, 3));
   if(bin2hex(fread($fh, 3)) == 'efbbbf')
   {
    if($size == 3 && ftruncate($fh, 0))
    {// Empty other than BOM
     fclose($fh);
     return true;
    }
    else if($buffer = fread($fh, $size))
    {// Shift file contents to beginning of file
     if(ftruncate($fh, strlen($buffer)) && rewind($fh))
     {
      if(fwrite($fh, $buffer))
      {
       fclose($fh);
       return true;
      }
     }
    }
   }
   else
   {// No BOM found
    fclose($fh);
    return true;
   }
  }
  return false;
 }
 
 debom_utf8('./karticazadrugar.php');
 die('done');
?>