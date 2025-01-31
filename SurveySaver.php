<?php
class File
{
    public $name;
    private $object, $data = [];
    public function __construct($name)
    {
        $this->name = $name;
    }
    public function read_data($data)
    {
        $this->object = fopen($this->name, 'c');
        $lines = file($this->name, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            list($key, $value) = explode(": ", $line, 2);
            $this->data[$key] = $value;
        }
        foreach ($data as $key => $value) {
            if ($value !== '') {
                $this->data[$key] = $value;
            }
        }
    }
    public function save_data()
    {
        $this->object = fopen($this->name, 'w');
        foreach ($this->data as $key => $value) {
            fwrite($this->object, "$key: $value\n");
        }
    }
}
$newdata = [
    "First name" => filter_input(INPUT_GET, 'first_name') ?: '',
    "Last name" => filter_input(INPUT_GET, 'last_name') ?: '',
    "Email" => filter_input(INPUT_GET, 'email') ?: die("Email is required"),
    "Age" => filter_input(INPUT_GET, 'age') ?: '',
];
$file = new File("./data/$newdata[Email].txt");
$file->read_data($newdata);
$file->save_data();