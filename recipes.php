<?php
$apiKey = "01be09d4575e47679f2bb41141f63e5d";

$ingredient1 = $_POST['ingredient1'];
$ingredient2 = $_POST['ingredient2'];
$ingredient3 = $_POST['ingredient3'];

$recipesWeb = "https://api.spoonacular.com/recipes/findByIngredients?ingredients={$ingredient1},+{$ingredient2},+{$ingredient3}&apiKey={$apiKey}";

$ch = curl_init();

curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $recipesWeb);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_VERBOSE, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);

curl_close($ch);
$recipes = json_decode($response);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipes</title>
    <link rel="stylesheet" href="./style.css" />
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script&family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/402cc49e6e.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="recipy-directory">
        <h1>Recipes with <?php echo $ingredient1 . ", ";
                            echo $ingredient2 . " and ";
                            echo $ingredient3 . " ";  ?> </h1>
        <?php foreach ($recipes as $recipe) {
        ?>
            <div class="row recipe-item">
                <div class="col recipe-item-title">
                <h2><?php echo $recipe->title ?></h2>
                <img src="<?php echo $recipe->image ?>" alt="<?php echo $recipe->title ?>">
                </div>
                <div class="col recipe-item-ingredients">
                <h2>For this recipe you will need:</h2>
                <?php $quant = count($recipe->missedIngredients);?>
                <ul>
                <?php
                for($i = 0; $i<$quant; $i++){?>
                    <li>
                        <?php echo $recipe->missedIngredients[$i]->original ?></li>
                        <?php 
                }?>
                </ul>
                </div>


            </div>

        <?php
        } ?>


    </div>


</body>

</html>