<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
table, tbody , tr, td{
    border: 1px solid black;
}
</style>

<body>

    <table>
        <tbody>
        <?php
        for($i=0; $i<5; $i++){
            echo"<tr><td>Section $i</td></tr>";
        }
        ?>
        </tbody>
    </table>
</body>

</html>
