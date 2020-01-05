<?php
    $flag = "";
    $error = "";

    function trim_value(&$value) 
    { 
        $value = trim($value); 
    }

    if(isset($_GET['country'])){
        trim_value($_GET['country']);
    }

    if(isset($_GET['country'])) {

    
    
    $country = str_replace(' ', '_', $_GET['country']);

    $country = implode('_', array_map('ucfirst', explode('_', $country)));


    if (strpos($country, 'The') !== false) {

        $country = lcfirst($country);

    }
    
    
    
    // $country = strtolower($country);

        if($country){

            $page = file_get_contents("https://en.wikipedia.org/wiki/File:Flag_of_".$country.".svg");

            $pageArray = explode('<div class="fullImageLink" id="file">', $page);

            $secondPageArray = explode('<div class="mw-filepage-resolutioninfo">', $pageArray[1]);

            $flag =  $secondPageArray[0];

        }

        $country = str_replace('_', ' ', $_GET['country']);

        $country = ucwords($country);
        

    }

       
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Flags!</title>

    <style type="text/css">

        html { 
            background: url(worldPic2.jpg) no-repeat center center fixed; 
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        } 
        body{
            background: none;
        }
        h1{
            text-align: center;
            color: white;
            background-color: black;
            padding-top: 1.5%;
            padding-bottom: 1.5%;
            margin-top: 2%;
            margin-bottom: 0px;
        }
        #credit{

            
        }
        nav{
            background-color: transparent;

        }
        form{
            text-align: center;
            background-color: black;
            padding-bottom: 2%;
            
        }
        button{
            display: block !important;
            border-radius: 0;
            background-color: black;
            color: white;
            margin: 0 auto;
            width: 50%;
            border: 1px solid white !important;
            font-size: 16px !important;
            font-weight: bold;
            font-family: arial;
            
        }
        button:hover{
            background-color: white;
            color: black;
            
        }
        input{
            width: 50%;
            padding: 1% 1%;
            margin-bottom: 0.5%;
        }
        h6{
            color: white;
            text-align: left;
            margin-left: 1.5%;
        }
        a{
            /* display: none; */
        }

        a.image{
            display: inline;
        }
        #flag{
            text-align: center;
            margin-top: 5%;
        }
        img{
           
            border: 7px solid black;
            border-top: 5px solid black;
            margin-bottom: 2%;
            /* width: 20%;
            height: 20%; */

        }
        #countryA{
            font-weight: bold;
        }
        .alert{
            width: 75%;
            margin: 0 auto;
        }
        #countryName{
            color: white;
            background-color: black;
            margin: 0 auto;
            margin-bottom: 0%;
            width: 52.2%;
            /* margin-left: 0.3%; */

        }
        #example2{
            margin-bottom: 1.8%;
        }
        #example1{
                margin-top: 1%;
        }
        img{
                width: 100%;
                height: 100%;
        }
     
 
        form{
            /* margin-n: 6%; */
        }

        @media (max-width: 1199.98px) { 
            
            #countryName{
                
                width: 62.4%;

            }


        }

        @media (max-width: 991.98px) { 

            input{
                width: 75%;
            }
            button{
                width: 75%;
                color: black;
                background-color: white;
                font-weight: bold;
                font-family: arial;
            }
            #countryName{
        
                width: 84%;

            }



        }
        @media (max-width: 767.98px) { 

            input{
                width: 90%;
            }
            button{
                width: 90%;
            }
            img{
                width: 100%;
                height: 100%;
            }
            #example1{
                margin-top: 4%;
            }
            #countryName{
                /* color: white;
                background-color: black;
                margin: 0 auto;
                margin-bottom: 0px; */
                width: 100%;

            }
            #example2{
                margin-top: 2%;
                margin-bottom: 4%;
            }


        }

        @media (max-width: 575.98px) { 
            h1{
                padding-right: 2%;
                padding-left: 2%;
            }

        }

        @media (min-width: 992px) { 

            /* #flag{
                width: 60%;
                margin: 30px auto;
            } */
         }
         #countryName{
            /* color: white;
            background-color: black;
            margin: 0 auto;
            margin-bottom: 0px; */
            width: 100%;
            /* margin-bottom: 5%; */

        }
    </style>


</head>
<body>
    <div class="container">
        
        <h1>Enter a Country, US State, or State of Another Country to See its Flag!</h1>

        <form>

            <input type="text" id="country" name="country" placeholder='Eg. The United States' value="<?php $country ?>">
            <h6 id="example1">*Make sure to include "The" if it is in the name. E.g "The Vatican City," "The United Kingdom."</h6>
            <h6 id="example2">*Do not write out full name. E.g "The United States of America" is not okay, just write "The United States."</h6>
            
            <!-- <button type="submit" class="btn">Go!</button> -->
            <a class="" href="#flag" role="button"><button type="submit" class="btn">Go!</button></a>

            
 
        </form>

        
        <div id="flag">
            
            <?php
                
                if ($flag) {
                    echo "<h2 id='countryName'>".$country."</h2>";
                    echo $flag;

                } else if (isset($_GET['country']) == "") {

                    echo '<div class="alert alert-primary d-none" role="alert">Sorry, we could not find <span id="countryA">'.isset($_GET['country']).'</span></div>';
                
                } else if(!$flag) {

                    echo '<div class="alert alert-danger" role="alert">Sorry, we could not find <span id="countryA">'.$_GET['country']."</span>. ".'</div>';
                } 

 

            ?>
        
        </div>
    
    </div>
    <nav class="navbar fixed-bottom navbar-light justify-content-end">
        <a id="credit" style="background-color:black;color:white;text-decoration:none;padding:4px 6px;font-family:-apple-system, BlinkMacSystemFont, &quot;San Francisco&quot;, &quot;Helvetica Neue&quot;, Helvetica, Ubuntu, Roboto, Noto, &quot;Segoe UI&quot;, Arial, sans-serif;font-size:12px;font-weight:bold;line-height:1.2;display:inline-block;border-radius:3px" href="https://unsplash.com/@iambrettzeck?utm_medium=referral&amp;utm_campaign=photographer-credit&amp;utm_content=creditBadge" target="_blank" rel="noopener noreferrer" title="Download free do whatever you want high-resolution photos from Brett Zeck"><span style="display:inline-block;padding:2px 3px"><svg xmlns="http://www.w3.org/2000/svg" style="height:12px;width:auto;position:relative;vertical-align:middle;top:-2px;fill:white" viewBox="0 0 32 32"><title>unsplash-logo</title><path d="M10 9V0h12v9H10zm12 5h10v18H0V14h10v9h12v-9z"></path></svg></span><span style="display:inline-block;padding:2px 3px">Brett Zeck</span></a>
    </nav>
    
</body>
</html>