<?php

$search = $_GET['search'] ?? '';
$limit = 50;
$offset = $_GET['offset'] ?? 0;
$q = json_decode(file_get_contents(
    "https://data.gov.lv/dati/lv/api/3/action/datastore_search?q={$search}&offset={$offset}&resource_id=25e80bf3-f107-4ab4-89ef-251b5b9374e9&limit={$limit}"));

$data = $q->result->records;

?>

<form method="get" action="/">
    <input type= "text" name="search" placeholder="Type Your search"/>
    <button type="submit">Submit</button>
</form>

<table border="dotted">
    <thead>
    <th>Company</th>
    <th>Address</th>
    <th>Registration number</th>
    </thead>

    <tbody>
    <?php foreach ($data as $value): ?>
    <tr>
        <td> <?php echo $value->name ?> </td>
        <td> <?php echo $value->address ?> </td>
        <td> <?php echo $value->regcode ?> </td>
        <?php endforeach; ?>
    </tr>
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
