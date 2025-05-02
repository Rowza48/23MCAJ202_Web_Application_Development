<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Indian Cricket Players</title>
    <style>
        table {
            width: 50%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color:rgb(224, 181, 181);
        }
    </style>
</head>
<body bgcolor="D3D3FF">

    <h2>Indian Cricket Players</h2>

    <table>
        <tr>
            <th>Sr. No</th>
            <th>Player Name</th>
        </tr>
        
        <?php
        // Step 1: Create an array of Indian Cricket Players
        $players = array("Virat Kohli", "Rohit Sharma", "MS Dhoni", "Sachin Tendulkar", "Kapil Dev", 
                         "Rahul Dravid", "Sourav Ganguly", "Yuvraj Singh", "Jasprit Bumrah", "Hardik Pandya");

        // Step 2: Display players inside the table using a loop
        $sr_no = 1;
        foreach ($players as $player) {
            echo "<tr>
                    <td>$sr_no</td>
                    <td>$player</td>
                  </tr>";
            $sr_no++;
        }
        ?>
    </table>

</body>
</html>