/**
*遍历一月的天数
*/
public function index()
    {       
        $BeginDate=date('Y-m-01', strtotime(date("Y-m-d")));
        $daynum =  date('d', strtotime("$BeginDate +1 month -1 day"));
        for($i = 1; $i<=$daynum;$i++){
            echo date("Y-m").'-'.$i.'<br />';
        }
}
