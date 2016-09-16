<?php

namespace Chumper\Zipper\Repositories;

use Exception;
use RarArchive;

class RarRepository implements RepositoryInterface
{
  private $archive;
  private $rars;

  function __construct($filePath, $create = false, $archive = null)
  {
    //Check if RarArchive is available
    if (!class_exists('RarArchive')){
      throw new Exception('Error: Your PHP version is not compiled with rar support');
    }

    $this->archive = $archive ? $archive : RarArchive::open($filePath);
  }

  public function getFileContent($pathInArchive)
  {
    $this->rars = $this->archive->getEntries($pathInArchive);

    return $this->rars;
  }

  public function each($callback)
  {
    foreach ($this->rars as $key => $value) {
      call_user_func_array($callback, array(
        'file' => $this->archive->value,
      ));
    }
  }

  public function close()
  {
    @$this->archive->close();
  }

  public function addFile($pathToFile, $pathInArchive){
    # code...
  }

  public function addEmptyDir($dirName){
    # code...
  }

  public function removeFile($pathInArchive){
    # code...
  }

  public function getFileStream($pathInArchive){
    # code...
  }

  public function fileExists($fileInArchive){
    return $this->archive->locateName($fileInArchive) !== false;
  }

  public function usePassword($password){
    # code...
  }

  public function getStatus(){
    # code...
  }
}
