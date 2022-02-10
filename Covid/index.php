<?php
$from = $_GET['from'] ?? '';
$to = $_GET['to'] ?? '';
$limit = 50;
$offset = $_GET['offset'] ?? 0;
$range = range($from, $to);

$url = json_decode(file_get_contents(
    "https://data.gov.lv/dati/lv/api/3/action/datastore_search?q={$from}&{$to}&offset={$offset}&resource_id=d499d2f0-b1ea-4ba2-9600-2c701b03bd4a&limit={$limit}"));
//echo '<pre>';

$data = $url->result->records;
function dateRange( $first, $last, $step = '+1 day', $format = 'Y/m/d' ):array {
    $dates = [];
    $current = strtotime( $first );
    $last = strtotime( $last );
    while( $current <= $last ) {
        $dates[] = date( $format, $current );
        $current = strtotime( $step, $current );
    }
    return $dates;
}

?>
<h1 style="font-size:30px;">Covid-19 statistika Latvijā</h1>
<form method="get" action="/">
    <label for="date">From:</label>
    <input type= "date" name="from" value = <?php foreach(dateRange($from, $to) as $date){
        echo $date;
    } ?>/>
    <label for="date">To:</label>
    <input type= "date" name="to" value = <?php foreach(dateRange($from, $to) as $date){
        echo $date;
    } ?>/>
    <input type="submit">
</form>

<style>
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
    td {
        background-color: #96D4D4;
    }
    th {
        background-color: #97D4D9;
    }
    td {
        text-align: center;
    }
    th, td {
        padding: 2px;
    }
</style>

<table style="width:50%">
    <caption>Covid-19 statistika Latvijā</caption>
    <thead>
        <th>Datums</th>
        <th>Testu skaits</th>
        <th>Pozitivie gadijumi</th>
    </thead>

    <tbody>
    <?php foreach ($data as $value): ?>
    <tr>
        <td> <?php [$date, $time] = explode('T', $value->Datums);
            echo $date ?> </td>
        <td> <?php echo $value->TestuSkaits ?> </td>
        <td> <?php echo $value->ApstiprinataCOVID19InfekcijaSkaits ?> </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<form method="get" action="/">
    <?php if ($offset > 0): ?>
        <button type="submit" name= "offset" value="<?php echo $offset - $limit; ?>"> << </button>
    <?php endif;?>

    <?php if(count($data) >= $limit): ?>
        <button type="submit" name= "offset" value="<?php echo $offset + $limit; ?>"> >> </button>
    <?php endif;?>
</form>