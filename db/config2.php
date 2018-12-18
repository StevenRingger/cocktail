<?php
// by Steven Ringger
class Connection
{
    private $id = 'root';
    private $pw = '';
    private $host = 'localhost';
    private $database = 'cocktail';
    private $link;

    public function getConnection(): \mysqli
    {
        $this->link = mysqli_connect($this->host, $this->id, $this->pw) or die ('cannot connect');
		
        mysqli_select_db($this->link, $this->database) or die ('cannot select DB');
        return $this->link;
    }

    public function closeConnection(): bool
    {
      return  mysqli_close($this->link);
    }
}