<?php
    require_once 'classes/Database.php';
    require_once 'config/config.php';

    $data = [];

    if (!empty($_POST['search'])) {

        $db = initDB();

        $input = ups_not_sanitized($_POST['search']);

        $sql = "SELECT * FROM " . QUERY_TABLE . " WHERE ". QUERY_COLUMN ." LIKE '%$input%'";

        $data = print_res_data($db, $sql);
    }

    /*
     * init test database
     */
    function initDB() {
        $db = new Database();
        $db->connect();

        return $db;
    }

    /*
     * print the data to the screen
     */
    function print_res_data($db, $sql){
        $data = [];

        try {
            foreach ($db->connection->query($sql, PDO::FETCH_ASSOC) as $row) {
                $data[] = $row;
            }
        }catch (Exception $e) {
            $data[] = null;
        }

        return $data;
    }

    /*
     * Sanitize or not sanitize
     */
    function ups_not_sanitized($data) {
        return $data;
    }

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>SQL Injection</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous" />
    </head>
    <body>
        <div class="container">
            <form class="m-5" action="index.php" method="post">
                <h1 class="text-center text-primary m-2">SQL Injection Playground </h1>
                <div class="input-group col-xs-7">
                    <input aria-label="pf" class="form-control m-2" type="text" name="search" required autocomplete="off" placeholder="Search..."/>
                    <button class="btn btn-primary m-2" type="submit">Search</button>
                </div>
            </form>
        </div>
            <div class="container p-3">
                <table class="table">
                    <tbody>
                    <?php if (!is_null($data)){ ?>
                        <?php foreach($data as $row){ ?>
                            <tr>
                                <?php foreach($row as $key=>$column){ ?>
                                    <td><strong><?php echo $key . ":"; ?></strong> <?php echo $column; ?></td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    <?php }?>
                    <?php if (empty($data)){ ?>
                        <h3 class="text-center">Ups, nothing found! </h3>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </body>
</html>
