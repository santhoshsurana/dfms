<?php 
include ('dumper.class.php');
try {
    $world_dumper = Shuttle_Dumper::create(array(
        'host' => 'localhost',
        'username' => 'root',
        'password' => 'root',
        'db_name' => 'daily_finance',
    ));

    // dump the database to gzipped file
    //$world_dumper->dump('tom_db.sql.gz');

    // dump the database to plain text file
    $backup_file_name = '../backup/daily_finance_backup_' . date('d-m-Y').'.sql';
    $world_dumper->dump($backup_file_name);



    // $wp_dumper = Shuttle_Dumper::create(array(
    //  'host' => '',
    //  'username' => 'root',
    //  'password' => '',
    //  'db_name' => 'tom_db',
    // ));

    // // Dump only the tables with wp_ prefix
    // $wp_dumper->dump('tom_db.sql', 'wp_');
    
    // $countries_dumper = Shuttle_Dumper::create(array(
    //  'host' => '',
    //  'username' => 'root',
    //  'password' => '',
    //  'db_name' => 'tom_db',
    //  'include_tables' => array('country', 'city'), // only include those tables
    // ));
    // $countries_dumper->dump('tom_db.sql.gz');

    // $world_dumper = Shuttle_Dumper::create(array(
    //  'host' => '',
    //  'username' => 'root',
    //  'password' => '',
    //  'db_name' => 'tom_db',
    //  'exclude_tables' => array('city'), 
    // ));
    // $world_dumper->dump('world-no-cities.sql.gz');

} catch(Shuttle_Exception $e) {
    echo "Couldn't dump database: " . $e->getMessage();
}
?>
<h3>Back Up!</h3>
<p>Your backup file has been created in your documents folder under reports folder please secure the folder for data recovery incase of data lost.</p>