
<div class="searchresults">
<h3>Search Results</h3>
<ul>
<li>
<?php

search();
?>
</li>
</ul>
</div>

<?php
function search()
{
    //search for any games that matches the input by users
    
    global $sport, $time, $loc, $gameid;
    
    $query_sport = htmlspecialchars($_GET['sport']);
    $query_start = htmlspecialchars($_GET['start']);
    $query_end = htmlspecialchars($_GET['end']);
    $query_location = htmlspecialchars($_GET['location']);
  
    
    $search_query = "select sport, date, time, location from game where sport='$query_sport'";
    
    if (isset($_GET['start']) && $_GET['start']!='')
    {
        $search_query.= "and date>= '$query_start'";
    }
    if (isset($_GET['end']) && $_GET['end']!='')
    {
        $search_query.= "and date<= '$query_end'";
    }
    if (isset($_GET['location']) && $_GET['location']!='')
    {
        $search_query.= "and location like '%$query_location%'";
    }
    
    $search_query.=";";
    echo $search_query;
    
    $connstr = "host=dbsrv1 dbname=csc309g9 user=csc309g9 password=ohs7ohd4";
    $conn = pg_connect($connstr);
    $result = pg_query($search_query);
    
    $num = pg_num_rows($result);
    $result_array = pg_fetch_all($result);
    
    for ($i=0; $i<$num; $i++)
    {
        $sport = $result_array[$i]['sport'];
        $date = $result_array[$i]['date'];
        $time = $result_array[$i]['time'];
        $loc = $result_array[$i]['location'];
        //$sport = $result[$i]['sport'];
        
        include 'includes/gamebox.php';
    }
    
    
}










?>
