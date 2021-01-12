<?php

  ini_set("session.save_path", "/home/unn_w17021949/sessionData");
  session_start();

?>
<?php
require_once("myFunctions.php");
echo makePageStart ("EVENT LIST", "myCSS.css");

if (check_login(true)) {
  echo makeLogout("North Events");
}

else {
  echo makeLogin("North Events");
}

echo makeNavMenu("NAVIGATION", array("chooseEventPage.php"=>"Events List","bookEventsForm.php"=>"Book Events Form","credits.php"=>"Credits","index.php"=>"Index"));
echo startMain();
      // FUNCTIONS CREATING THE WEB PAGE


require_once("myFunctions.php");
    try {
      $dbConn = getConnection();
      // THIS FUNCTION ESTABLISHES THE CONNECTION TO THE PHYMYADMIN DATABASE
      $sqlQuery = "SELECT eventID, eventTitle, catDesc, venueName, eventStartDate, eventEndDate, eventPrice
      FROM NE_events
      INNER JOIN NE_category ON  NE_category.catID = NE_events.catID
      INNER JOIN NE_venue ON NE_venue.venueID = NE_events.venueID   ";
      // SQL QUERY RETRIEVING SELECTED DATABASE OF CONTENTS
$queryResult = $dbConn->query($sqlQuery);
echo "<table>
  <tr>
    <th>Title</th>
    <th>Category</th>
    <th>Venue</th>
    <th>Start</th>
    <th>End</th>
    <th>Price</th>
  </tr>";
  // CREATES A TABLE OF HEADINGS
while ($rowObj = $queryResult->fetchObject()) {
echo "<tr>
<td> <a href = 'editEventPage.php?eventID={$rowObj->eventID}'>{$rowObj->eventTitle}</a></td>
<td>{$rowObj->catDesc}</td>
<td>{$rowObj->venueName}</td>
<td>{$rowObj->eventStartDate}</td>
<td>{$rowObj->eventEndDate}</td>
<td>{$rowObj->eventPrice}</td>
</tr>";
}
  // RETRIEVES THE SELECTED CONTENTS OF THE SQL QUERY AND PLACES THEM INTO THE ASSIGNED TITLES IN ORDER
echo "</table>";
} // THIS BRINGS UP THE CREATED TABLE ABOVE
catch (Exception $e){
echo "<p>Query failed: ".$e->getMessage()."</p>\n";
}
  // CATCH FUNCTION WHICH WILL CATCH ANY FAILED QUERIES AND RETURN AN ERROR



    echo endMain();
    echo makeFooter("Luke Renwick - w17021949");
    echo makePageEnd();
  // FUNCTIONS CREATING THE WEB PAGE
    ?>
